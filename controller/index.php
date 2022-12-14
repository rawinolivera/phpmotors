<?php
    /*************************
   * Search Controller
   * Final Project End Code
   ************************/

    session_start();
     // Get the database connection file
      require_once '../library/connections.php';
      // Get the PHP Motors model for use as needed
      require_once '../model/main-model.php';
      // Get the accounts model
      require_once '../model/accounts-model.php';
      // Get the vehicle model
      require_once '../model/vehicles-model.php';
      // Get the functions library
      require_once '../library/functions.php';
      //get functions uploads
      require_once '../model/uploads-model.php';
      //get search functions
      require_once '../model/search-model.php';
  
     // Get the array of classifications
      $classifications = getClassifications();
      // Build a navigation bar using the $classifications array
      $navList = navBarPopulate($classifications);
  
  
      $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      if ($action == NULL) {
          $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }  
  

    switch ($action) {
    //Searching a vehicle
    case 'searchPage':
        $title = 'Search';
        include '../view/search.php';
        exit;
        break;


    case 'searchItem':
       // Filter and store the data
       $searchString = trim(filter_input(INPUT_GET, 'searchString', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
       $searchString = strip_tags(html_entity_decode($searchString));

       // Check for missing data
       if (empty($searchString)) {
           $message = '<p>You must provide a search string.</p>';
           include '../view/search.php';
           exit;
       }

       //Check if we are in the correct URL page
       if (!isset($_GET['page'])) {
           $current_page = 1;
       } else {
           // get current number page of URL
           $current_page = $_GET['page'];
       }

       $limit = 10;
       // start from to search and get 10 results
       $page = ($current_page - 1) * $limit;
       $invSearch = getSearchResults($searchString);
       $currentPageSearch = paginate($searchString, $page, $limit);

       // Check and get the result
       if (!count($invSearch)) {
           $searchResults = buildResultsString($searchString, $invSearch);
           $message = "<p id='text'>Sorry, there are no results were found to match $searchString.</p>";
       } else {
           $searchResults = buildResultsString($searchString, $invSearch);
           $searchList = buildSearchResults($currentPageSearch);
       }


       // get the searchString from url
       if (!isset($_GET['searchString'])) {
           $urlSearchString = "";
       } else {
           $urlSearchString = $_GET['searchString'];
       }

       // limits the list in the number of pages
       $totalPages = ceil(count($invSearch) / $limit);
       $previous = $current_page - 1;
       $next = $current_page + 1;


       // 1 page result
       if ($totalPages <= 1) {
           $num = "";
       }
       // 1+ page result
       else {
           // Div with page numbers
           $num = '<div id="pagination">';

           // if current page is > 1, show the previous link
           if ($current_page > 1) {
               $num .= "<a></a>";
               $num .=  '<a title="Previous page" href = "/phpmotors/search/index.php?action=searchItem&page=' . $previous . '&searchString=' . $urlSearchString . '">' . 'Previous' . ' </a>';
           }

           // Create page numbers link
           for ($page_number = 1; $page_number <= $totalPages; $page_number++) {
               $num .= '<a title="Page ' . $page_number . '" href = "/phpmotors/search/index.php?action=searchItem&page=' . $page_number . '&searchString=' . $urlSearchString . '">' . $page_number . ' </a>';

               if ($page_number != $current_page) {
                   $num .= "";
               } else {
                   $num .= '<a style="pointer-events: none;" href = "/phpmotors/search/index.php?action=searchItem&page=' . $page_number . '">' . $page_number . ' </a>';
               }
           };


           // if current page is < total pages, show the next link
           if ($current_page < $totalPages) {
               $num .= "<a></a>";
               $num .=  '<a title="Next page" href = "/phpmotors/search/index.php?action=searchItem&page=' . $next . '&searchString=' . $urlSearchString . '">' . 'Next' . '</a>';
           }
           $num .= '</div>';
       }

       //$title = 'Search';

        include '../view/search.php';
        break;


    default:
        include '../view/search.php';
        break;
}



?>