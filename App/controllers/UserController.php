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
 
    // Validate email
    if(!Validation::email($email, 2, 50)){
       $errors['email'] = 'Please enter a valid email address';
    }
 
    // Validate name
    if(!Validation::string($name)){
       $errors['name'] = 'Name must be between 2 and 50 characters';
    }
 
    // Validate password
    if(!Validation::string($password ,6, 50)){
       $errors['password'] = 'Password must be at least 6 characters';
    }
 
    // Check password confirmation
    if(!Validation::match($password, $passwordConfirmation)){
       $errors['password_confirmation'] = "Passwords do not match";
    }
 
    // If there are validation errors, reload the form with errors
    if(!empty($errors)){
       loadView('users/create', [
           'errors' => $errors,
           'user' => [
               'name' => $name,
               'email' => $email,
               'city' => $city,
               'state' => $state,
           ]
       ]);
       exit;
    }
 
    // Check if the email already exists in the database
    $params = ['email' => $email];
    $user = $this->db->query('SELECT * FROM users WHERE email=:email', $params)->fetch();
 
    // If a user is found, return an error
    if ($user) {
       $errors['email'] = 'That email already exists';
       loadView('users/create', [
           'errors' => $errors,
           'user' => [
               'name' => $name,
               'email' => $email,
               'city' => $city,
               'state' => $state,
           ]
       ]);
       exit; 
    }
 
    // Create user account (no need to include password_confirmation)
    $params = [
        'name' => $name,
        'email' => $email,
        'city' => $city,
        'state' => $state,
        'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password before storing
    ];
 
    // Use prepared statements to safely insert data into the database
    $this->db->query('INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)', $params);
 
    // Redirect to the homepage or another page after successful insertion
    redirect('/');
 }


}