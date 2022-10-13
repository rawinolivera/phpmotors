<?php

//This is the Account Controller for the side

require_once '../libraries/connections.php';
require_once '../model/main-model.php';

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
<<<<<<< HEAD
    default: 
    include '../views/login.php';

    break;
=======

    default: 
    include '../views/login.php';
>>>>>>> 0330b7daa7233113b7581d16c97d447653a1eccb
}
