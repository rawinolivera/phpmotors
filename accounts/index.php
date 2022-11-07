<?php

//This is the Account Controller for the side

// Create or access a Session
session_start();

// Get data connection file
require_once '../libraries/connections.php';
// Get the PHP motors model for use as needed 
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the function library
require_once '../libraries/functions.php';

$classifications = getClassifications();
//var_dump($classifications);
//exit;

// Build a navigation bar using the $classifications array
$navList = navList($classifications);
//echo $navList;
//exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}
switch ($action){
    case 'not-register':
        include '../views/registration.php';
        break;

    case 'register': //registration process
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for an existing email address
        $existingEmail = checkExistingEmail($clientEmail);

        if($existingEmail){
            $message = '<p>The email address already exists. Do you want to login instead?</p>';
            include '../views/login.php';
            exit;
        }

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/registration.php';
            exit;
        }

        //Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model if no errors exist
        $regOutcome = RegClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the results
        if($regOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../views/login.php';
            exit;
        }else{
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../views/registration.php';
            exit;
        }
        break;

    case 'Login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        
        // Check for missing data
        if(empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/login.php';
            exit;
        }
        
        break;
        
    case 'home':
    default: 
        include '../views/login.php';

    break;

    
}
