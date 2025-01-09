<?php

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
     * @params string $controller
     * return void
     */

    public function registerRoute($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }


    /**
     * Add a GET route
     * @params string $uri
     * @params string $controller
     * return void
     */
    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }
    /**
     * Add a POST route
     * @params string $uri
     * @params string $controller
     * return void
     */
    public function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }
    /**
     * Add a PUT route
     * @params string $uri
     * @params string $controller
     * return void
     */
    public function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }
    /**
     * Add a  route
     * @params string $uri
     * @params string $controller
     * return void
     */
    public function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }


    /**
     * Load Error page
     * @params int $httpcode
     * return void
     */

    public function error($httpCode = 404)
    {
        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit();
    }

    /**
     * Route the request
     * @params string $uri
     * @params string $method
     * @return void
     */

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {

                require basePath($route['controller']);
                return;
            }
        }
        $this->error(404);
    }
}
