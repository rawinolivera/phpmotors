<?php

//This is the main controller for vehicles

require_once '../libraries/connections.php';
require_once '../model/vehicles-model.php';
require_once '../model/main-model.php';

$classifications = getClassifications();
$classLists = getClassList();
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

//Build a dynamic drop-down select-list using $classificacion array
$classificationList = '<select id="list" name="classificationId">';
$classificationList .="<option value=''>Choose from the List</option>";
foreach ($classLists as $classList){
    $classificationList .="<option value=".urlencode($classList['classificationId']).">$classList[classificationName]</option>";
}
$classificationList .='</select>';
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
        $classificationName = filter_input(INPUT_POST, 'classificationName');

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
        $classificationId = filter_input(INPUT_POST, 'classificationId');
        $invMake = filter_input(INPUT_POST, 'invMake');
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');

        if(empty($classificationId || $invMake || $invModel || $invDescription || $invImage || $invThumbnail || $invPrice || $invStock || $invColor)){
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

    default: 
    include '../views/vehicle-man.php';
}

?>