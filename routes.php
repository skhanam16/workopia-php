<?php



$router->get('/', 'HomeController@index');
$router->get('/listings', 'ListingController@index');
$router->get('/listings/create', 'ListingController@create');
$router->get('/listings/{id}', 'ListingController@show');

// POST request
$router->post('/listings', 'ListingController@store');
$router->delete('/listings/{id}', 'ListingController@destroy');

// $router->error('404', 'ErrorController@notFound');
// $router->get('/', 'controllers/home.php');
// $router->get('/listings', 'controllers/listings/index.php');
// $router->get('/listings/create', 'controllers/listings/create.php');
// $router->get("/listing", 'controllers/listings/show.php');
