<?php


$config = require basePath('config/db.php');

//instance of Database
$db = new Database($config);

// now call the query method from the Database class

$listings = $db->query('SELECT* FROM listings LIMIT 6')->fetchAll();
loadView('home', [
    'listings' => $listings,
]);
// echo $listings;
// inspect($listings);
// inspect('home');
