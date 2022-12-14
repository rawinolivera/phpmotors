<?php

//This is the main controller for vehicles

// Create or access a Session
session_start();

require_once '../libraries/connections.php';
require_once '../model/vehicles-model.php';
require_once '../model/search-model.php';
require_once '../model/main-model.php';
require_once '../libraries/functions.php';
//arrays
$classifications = getClassifications(); //query the name
$classLists = getClassList();   //query the whole data
//var_dump($classifications);

// Build a navigation bar using the $classifications array
$navList = navList($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'search':
      // This allows me to use a form with method="post" as well as pull the query from the pagination links
      $searchBar = trim(filter_input(INPUT_POST, 'searchBar', FILTER_SANITIZE_SPECIAL_CHARS)) ?: trim(filter_input(INPUT_GET, 'searchBar', FILTER_SANITIZE_SPECIAL_CHARS));
      if (empty($searchBar)) {
        $message = '<p class="notice">You must provide a search string.</p>';
        include '../views/search.php';
        exit;
      }

      // page is always pulled from the pagination links, so no need to look at the INPUT_POST
      $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
      if (empty($page)) {
        $page = 1;
      }

      $sResults = getSearchResults($searchBar);
      
    
      $srNum = count($sResults);
      $result_msg = "";
      if ($srNum < 0) {
        $result_msg = "<p>Returned 0 results for: " . $searchBar . " </p>";
      } else {
        $result_msg = "<p>Returned $srNum results for: " . $searchBar . " </p>";
      }

      if ($srNum < 1) {
        $searchDisplay = '<h3 class="notice">Sorry, no results were found to match ' . $searchBar . '.</h3>';
  /*    } elseif ($srNum > 10) {
        // invoke pagination
        //Calculate number of pages needed
        $displayLimit = 10; // ENTRIES PER PAGE
        $totalPages = ceil($srNum / $displayLimit);

        $paginatedResults = paginate($search, $page, $displayLimit);

        // This is the pagination bar (e.g. the HTML that goes under your search results)
        $paginationBar = pagination($totalPages, $page, $search);

        // Using the same function, but using the paginatedResults instead of all the results
*/  //  $searchDisplay = buildSearchResults($paginatedResults);
      } else {
        echo "aqui voy";
        $searchDisplay = buildSearchResults($sResults);
      }

      include '../views/search.php';
      break;
    default:
      include '../views/search.php';
      break;
}

?>