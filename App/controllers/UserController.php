<?php


namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class UserController{
protected $db;

public function __construct(){
    $config = require basePath('config/db.php');
$this->db = new Database($config);
}


public function login(){
    loadView('users/login');
}

public function create(){
    loadView('users/create');
}

/**
 * Store user in database
 * 
 * @return void
 */


public function store(){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $password = $_POST['password'];
   $passwordConfirmation = $_POST['password_confirmation'];

   $errors = [];

   if(!Validation::email($email, 2, 50)){
    $errors['email'] = 'Please enter a valid email address';
   }

   if(!Validation::string($name)){
    $errors['name'] = 'Name must be between 2 and 50 characters';
   }

   if(!Validation::string($password ,6, 50)){
    $errors['password'] = 'Password must be at least 6 characters';
   }

   if(!Validation::match($password, $passwordConfirmation)){
$errors['password_confirmation'] = "Passwords do not match";
   }

   if(!empty($errors)){
    loadView('users/create', [
        'errors' => $errors,
        'user' =>[
            'name' =>$name,
            'email' =>$email,
            'city' =>$city,
            'state' =>$state,


        ]
    ]);
    exit;
   }
   else{
       inspectAndDie('success');
   }

}

}