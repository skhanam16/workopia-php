
<?php

use Framework\Database;

$config = require basePath('config/db.php');

//instance of Database
$db = new Database($config);

// now call the query method from the Database class

$listings = $db->query('SELECT* FROM listings')->fetchAll();
loadView('listings/index', [
    'listings' => $listings,
]);
// echo $listings;
// inspect($listings);
// inspect('home');
