<?php


require __DIR__ . '/../vendor/autoload.php';


use Framework\Router;
use Framework\Database;
use Framework\Session;

Session::start();
require __DIR__ . '/../helpers.php';

// inspectAndDie(session_status());

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
