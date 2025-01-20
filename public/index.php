<?php

session_start();
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helpers.php';

use Framework\Router;
use Framework\Database;

// Connect to Database Class
// require basePath('Framework/Database.php');
// require basePath('Framework/Router.php');

// spl_autoload_register(
//     function ($class) {
//         $path = basePath('Framework/' . $class . '.php');
//         if (file_exists($path)) {
//             require $path;
//         }
//     }

// );



$config = require basePath('config/db.php');

$db = new Database($config);

$router = new Router();
// Instantiating the router


// get routes
$routes = require basePath('routes.php');

//Get the current request URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);



//Passing the $method fot current Route the request
$router->route($uri);
