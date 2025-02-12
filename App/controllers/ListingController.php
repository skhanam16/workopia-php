<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class ListingController
{
    protected $db;

    /**
     * Contructor
     * @return void
     */
    public function __construct()
    {
        $config = require basePath('config/db.php');

        //instance of Database
        $this->db = new Database($config);
    }

    /**
     * index method
     * @return void
     */
    public function index()
    {

        $listings = $this->db->query('SELECT* FROM listings')->fetchAll();

        loadView('listings/index', [
            'listings' => $listings,
        ]);
    }



    /**
     * Show the create listings
     * @return void
     */

    public function create()
    {
        loadView('listings/create');
    }


    /**
     * Show the latest listing
     * @params array $params
     * @return void
     */


    public function show($params)
    {
        $id = $params['id'];

        $params = [
            'id' => $id,
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        // Check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        loadView('listings/show', [
            'listing' => $listing,
        ]);
    }

    /**
     * Store data in database
     * 
     * @return void
     */

    public function store()
    {

        // inspectAndDie($_POST);
        // adding extra layer security by allow only the following fields to be submitted
        $allowedFields = [
            "title",
            "description",
            "salary",
            "requirements",
            "benefits",
            "tags",
            "company",
            "address",
            "city",
            "state",
            "phone",
            "email"
        ];
        // $newListingData this is the data comming from Form submission after sanitization
        // inspectAndDie($_POST);
        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));
        // inspectAndDie($newListingData);
        $newListingData['user_id'] = 1;
        //Adding another layer of security by array_map
        $newListingData = array_map('sanitize', $newListingData);

        // adding validation for not to submit empty required fileds. 
        $requiredFields = ["title", "description", "salary", "city", "state", "email"];
        // if any of the required fields are emppty then it will add to the errors array
        $errors = [];
        foreach ($requiredFields as $field) {
            //$newListingData[$field] $fields are keys
            if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }
        if (!empty($errors)) {
            // Reload view with errors and passing $errors and $newLisgtingData
            loadView('listings/create', [
                'errors' => $errors,
                'listing' => $newListingData
            ]);
        } else {
            // submit data

            // initialize the fields array as an empty array
            $fields = [];

            foreach ($newListingData as $field => $value) {
                $fields[] = $field;
            }
            $fields = implode(', ', $fields);
            // inspectAndDie($fields);
            $values = [];
            foreach ($newListingData as $field => $value) {
                //convert empty strings to null
                if ($value == '') {
                    $newLisgtingData[$field] = null;
                }
                $values[] = ':' . $field;
            }
            $values = implode(', ', $values);
            // inspectAndDie($values);
            $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";
            $this->db->query($query, $newListingData);
            redirect('/listings');
        }
    }

    /**
     * Delete a listing
     * @params array $params. So, We can get the listing id from the url
     * @return void
     */

    public function destroy($params)
    { {
            $id = $params['id'];

            $params = [
                'id' => $id,
            ];

            $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

            // Check if listing exists
            if (!$listing) {
                ErrorController::notFound('Listing not found');
                return;
            }

            // inspectAndDie($listing);
            $this->db->query('DELETE FROM listings WHERE id= :id', $params);

            // Set flash message
            $_SESSION['success_message'] = 'Listing deleted successfully';
            // $_SESSION['error_message'] = 'Unable to delete listing';

            redirect('/listings');
        }
    }

    /**
     * Show the listing edit form
     * @params array $params
     * @return void
     */


     public function edit($params)
     {
         $id = $params['id'];
 
         $params = [
             'id' => $id,
         ];
 
         $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
 
         // Check if listing exists
         if (!$listing) {
             ErrorController::notFound('Listing not found');
             return;
         }
//  inspectAndDie($listing);
         loadView('listings/edit', [
             'listing' => $listing,
         ]);
     }

    /**
     * Update a listing
     * 
     * @params array $params
     * @return void
     */

     public function update($params){
        $id = $params['id'];
 
        $params = [
            'id' => $id,
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        // Check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }
        $allowedFields = [
            "title",
            "description",
            "salary",
            "requirements",
            "benefits",
            "tags",
            "company",
            "address",
            "city",
            "state",
            "phone",
            "email"
        ];

        // inspectAndDie($allowedFields);
        $updatedValues = [];
        $updatedValues =array_intersect_key($_POST, array_flip($allowedFields));
        $updatedValues = array_map('sanitize',  $updatedValues);
        $requiredFields =['title', 'description', 'salary', 'email', 'city' ,'state'];
        $errors = [];
       foreach($requiredFields as $field){
        if(empty($updatedValues[$field]) || !Validation::string($updatedValues[$field])){
            $errors[$field] =ucwords($field) . " is required";
        }
       }
       if(!empty($errors)){
        loadView('listing/edit', [
            'listing' =>$listing,
            'errors' =>$errors
        ]);
        exit;
       }
       inspectAndDie( $errors);
     }
}
// end of class
