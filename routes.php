<?php



$router->get('/', 'HomeController@index');
$router->get('/listings', 'ListingController@index');
$router->get('/listings/create', 'ListingController@create');
$router->get('/listings/edit/{id}', 'ListingController@edit');
$router->get('/listings/{id}', 'ListingController@show');

// POST request
$router->post('/listings', 'ListingController@store');
$router->put('/listings/{id}', 'ListingController@update');
$router->delete('/listings/{id}', 'ListingController@destroy');

//Users controller

$router->get('/auth/create', 'UserController@create');
$router->get('/auth/login', 'UserController@login');

$router->post('/auth/register', 'UserController@store');

