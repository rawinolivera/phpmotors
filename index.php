<?php

//This is the main controller for the side

require_once 'libraries/connections.php';
require_once 'model/main-model.php';
require_once 'libraries/functions.php';

$classifications = getClassifications();
//var_dump($classifications);
//exit;

 //Build a navigation bar using the $classifications array
 $navList = navList($classifications);
//echo $navList;
//exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'template':
        include 'views/template.php';

        break;

    case 'error':
        include 'views/500.php';

        break;

    default: 
    include 'views/home.php';
}

?>