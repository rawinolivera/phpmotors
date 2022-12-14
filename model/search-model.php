<?php
  /* **********************************
   * Search Model
  ********************************** */
  function getSearchResults($searchBar){
    // THIS FUNCTION DOES A SEARCH BASED ON THE $search VALUE PASSED IN.
    $db = phpmotorsConnect();
    $sql = "SELECT inventory.invId, inventory.invYear, inventory.invMake, inventory.invModel, inventory.invDescription, images.imgPath 
    FROM (inventory 
          INNER JOIN images ON images.invId = inventory.invId AND images.imgName LIKE '%tn%') 
          WHERE inventory.invColor LIKE '%$searchBar%' OR inventory.invMake LIKE '%$searchBar%' OR inventory.invModel LIKE '%$searchBar%' OR inventory.invDescription LIKE '%$searchBar%' OR inventory.invPrice LIKE '%$searchBar%' OR inventory.invMiles LIKE '%$searchBar%' OR inventory.invColor LIKE '%$searchBar%' ORDER BY inventory.invModel ASC";
    $stmt = $db->prepare($sql);
    $stmt->bindValue('searchBar', $searchBar, PDO::PARAM_STR);
    $stmt->execute();
    $sResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $sResults;
  }
    
  

  function paginate($search, $page, $displayLimit){
    // THIS FUNCTION DOES THE SAME AS ABOVE EXCEPT IT USES THE $page and $displayLimit TO CONSTRAIN THE RESULTS (e.g. if I'm on page 2, I should only see results 11 through 20)
  }

  ?>