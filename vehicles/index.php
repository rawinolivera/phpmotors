<?php

//This is the main controller for vehicles

// Create or access a Session
session_start();

require_once '../libraries/connections.php';
require_once '../model/vehicles-model.php';
require_once '../model/main-model.php';
require_once '../libraries/functions.php';
//arrays
$classifications = getClassifications();
$classLists = getClassList();
//var_dump($classifications);
//exit;

// Build a navigation bar using the $classifications array
$navList = navList($classifications);
//echo $navList;

//Build a dynamic drop-down select-list using $classificacion array

//echo $classificationList;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'template':
        include '../views/template.php';
        break;

    case 'add-classif-page':
        include '../views/add-classification.php';
        break;

    case 'add-vehicle-page':
        include '../views/add-vehicle.php';
        break;

    case 'add-classification':
        $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(empty($classificationName)){
            $message = '<p>Please provide the classification name.</p>';
            include '../views/add-classification.php';
            exit;
        }

        $regNewClassifName = regClassif($classificationName);

        if($regNewClassifName === 1){
            $message = "<p>$classificationName has been added successfully to the Classification List.</p>";
            header('Location: /phpmotors/vehicles/index.php');
            exit;
        }else{
            $message = "<p>Sorry $classificationName, but the registration failed. Please try again.</p>";
            include '../views/add-classification.php';
            exit;
        }
        break;

    case 'add-vehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(($classificationId === "") || empty($invMake || $invModel || $invDescription || $invImage || $invThumbnail || $invPrice || $invStock || $invColor)){
            $message = '<p>Please provide informarion in all the fields.</p>';
            include '../views/add-vehicle.php';
            exit;
        }

        $regNewVehicle = regVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);

        if($regNewVehicle === 1){
            $message = "<p>The vehicle $invMake model $invModel color $invColor has been added to the inventory.</p>";
            include '../views/add-vehicle.php';
            exit;
        }else{
            $message = "<p>Sorry the vehicle $invMake model $invModel color $invColor, could not be registered. Please try again.</p>";
            include '../views/add-vehicle.php';
            exit;
        }
        break;

    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems':

        $classificationId = filter_input(INPUT_GET, '$classificationId', FILTER_SANITIZE_NUMBER_INT);
        $inventoryArray = getInventoryByClassification($classificationId);
        echo json_encode($inventoryArray);

        break;

    default: 
        $classificationList = buildClassificationList($classificacion);


    include '../views/vehicle-man.php';
}

?>