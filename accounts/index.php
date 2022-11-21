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
        
        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/registration.php';
            exit;
        }

        // Check for an existing email address
        $existingEmail = checkExistingEmail($clientEmail);

        if($existingEmail){
            $message = '<p>The email address already exists. Do you want to login instead?</p>';
            include '../views/login.php';
            exit;
        }

        //Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model if no errors exist
        $regOutcome = RegClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the results
        if($regOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
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

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
        $message = '<p>Please check your password and try again.</p>';
        include '../views/login.php';
        exit;
        }

        // a valid user exists, log them in
        $_SESSION['loggedin'] = true;
        //Removes the password from the array
        array_pop($clientData);
        // Store the arrey into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin byu
        include '../views/admin.php';
        exit;
        break;
        
    case 'login':
        include '../views/login.php';
        break;

    case 'logout':
        session_destroy();
        header('location: /phpmotors');
        break;

    case 'user':
        include '../views/admin.php';
        break;

    case 'accountUpdate':
        include '../views/client-update.php';
        break;

    case 'userUpdate':
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/client-update.php';
            exit;
        }

        $userUpdate = updateUser($clientId, $clientFirstname, $clientLastname, $clientEmail);
        if($userUpdate === 1){
            
            $fullClient = getDataclient($clientId);
            array_pop($fullClient);
            // Store the array into the session
            $_SESSION['clientData'] = $fullClient;
            $message = "<p>User information has been updated successfully.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/?action=user');
            exit;
        }else{
            $message = "<p>Sorry, user information could not be updated. Please try again.</p>";
            include '../views/client-update.php';
            exit;
        }
        break;


    case 'passChange':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $checkPassword = checkPassword($clientPassword);

        if(empty($checkPassword)){
            $message2 = '<p>Please provide a valid password.</p>';
            include '../views/client-update.php';
            exit;
        }

        //Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $passChanged = changePassword($clientId, $hashedPassword);
        if($passChanged === 1){
            $message = "<p>Client Password has been updated successfully.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/?action=user');
            exit;
        }else{
            $message2 = "<p>Sorry, Client Password could not be updated. Please try again.</p>";
            include '../views/client-update.php';
            exit;
        }
        break;

    default: 
        include '../views/login.php';
    break;

    
}
?>