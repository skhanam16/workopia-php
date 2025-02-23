<?php

namespace Framework;

use App\Controllers\ErrorController;
use Framework\Middleware\Authorize;


// $routes = require basename('routes.php');
// if (array_key_exists($uri, $routes)) {
//     require basePath($routes[$uri]);
// } else {
//     http_response_code(404);
//     require basePath($routes['404']);
// }

class Router
{
    protected $routes = [];

    /**
     * Add a new route
     * @params string $uri
     * @params string $method
     * @params array  $middleware
     * @params string $action
     * separeted by the @ symbol
     * return void
     */

    public function registerRoute($method, $uri, $action, $middleware = [])
    {

        $arr =  explode('@', $action);
        list($controller, $controllerMethod) =  $arr;
        // inspectAndDie($controllerMethod);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod,
            'middleware' =>$middleware,
        ];
    }


    /**
     * Add a GET route
     * @params string $uri
     * @params array  $middleware
     * @params string $controller
     * return void
     */
    public function get($uri, $controller, $middleware = [])
    {
        $this->registerRoute('GET', $uri, $controller, $middleware);
    }
    /**
     * Add a POST route
     * @params string $uri
     * @params array  $middleware
     * @params string $controller
     * return void
     */
    public function post($uri, $controller, $middleware = [])
    {
        $this->registerRoute('POST', $uri, $controller, $middleware);
    }
    /**
     * Add a PUT route
     * @params string $uri
     * @params array  $middleware
     * @params string $controller
     * return void
     */
    public function put($uri, $controller, $middleware = [])
    {
        $this->registerRoute('PUT', $uri, $controller, $middleware);
    }
    /**
     * Add a  route
     * @params string $uri
     * @params array  $middleware
     * @params string $controller
     * return void
     */
    public function delete($uri, $controller, $middleware = [])
    {
        $this->registerRoute('DELETE', $uri, $controller, $middleware);
    }



    /**
     * Route the request
     * @params string $uri
     * @params string $method
     * @return void
     */

    public function route($uri)
    {
        // Get the current request Method i.e GET, POST
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // check for _method input
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {

            // Override the request meethod with the value of _method
            $requestMethod = strtoupper($_POST['_method']);
        }
        foreach ($this->routes as $route) {
            // Split the URI into segments
            $uriSegments = explode('/', trim($uri, '/'));

            // Split the route URI into segments
            $routeSegments = explode('/', trim($route['uri'], '/'));

            // Check if the number of segments matches
            if (count($uriSegments) === count($routeSegments) && strtoupper($route['method']) === $requestMethod) {
                $params = [];

                // Compare each segment
                $match = true;

                for ($i = 0; $i < count($uriSegments); $i++) {
                    if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        $match = false;
                        break;
                    }
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        // This segment is a parameter, so store it
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }

                if ($match) {
                    foreach($route['middleware'] as $middleware){
                        (new Authorize())->handle($middleware);
                    }
                    // Extract controller and method from route
                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    // Instantiate the controller and call the method, passing parameters
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }

        ErrorController::notFound();
    }
}
