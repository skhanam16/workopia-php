<?php
require '../helpers.php';

// Connect to Database Class
require basePath('Database.php');
$config = require basePath('config/db.php');
require basePath('Router.php');
$db = new Database($config);


// Instantiating the router
$router = new Router;

// get routes
$routes = require basePath('routes.php');

//Get the current request URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Get the current request Method i.e GET, POST
$method = $_SERVER['REQUEST_METHOD'];

//Route the request
$router->route($uri, $method);
