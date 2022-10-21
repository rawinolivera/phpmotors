<?php

//This is the Account Controller for the side

// Get data connection file
require_once '../libraries/connections.php';
// Get the PHP motors model for use as needed 
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';

$classifications = getClassifications();
//var_dump($classifications);
//exit;

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' tittle='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification){
    $navList .="<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .='</ul>';
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

    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        $clientPassword = filter_input(INPUT_POST, 'clientPassword');

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/registration.php';
            exit;
        }

        // Send the data to the model if no errors exist
        $regOutcome = RegClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

        // Check and report the results
        if($regOutcome === 1){
            $message = "<p>Thanks for registering $clientFirstname. Please use to email and password to login.</p>";
            include '../views/login.php';
            exit;
        }else{
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../views/registration.php';
            exit;
        }
        break;

        include '../views/registration.php';
        break;
    case 'home':
    default: 
        include '../views/login.php';

    break;

    
}
