<?php
    // Search Model

    //Function gets all vehicles according to search word
    function getSearchResults($searchString)
    {
        $db = phpmotorsConnect();
       // $sql = ' SELECT * FROM inventory WHERE invMake LIKE :searchString OR invModel LIKE :searchString OR invDescription LIKE :searchString OR invColor LIKE :searchString';
        $sql = "SELECT inventory.invId, inventory.invYear, inventory.invMake, inventory.invModel, inventory.invDescription, inventory.invPrice, images.imgPath FROM (inventory INNER JOIN images ON images.invId = inventory.invId AND images.imgPath LIKE '%tn%') WHERE  inventory.invMake LIKE :searchString OR inventory.invModel LIKE :searchString OR inventory.invDescription LIKE :searchString OR inventory.invColor LIKE :searchString ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':searchString', '%' . $searchString . '%', PDO::PARAM_STR);
        $stmt->execute();
        $invSearch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invSearch;
    }

    // Function gets number of vehicles per page
    function paginate($searchString, $page, $limit)
    {
        $db = phpmotorsConnect();
        //$sql = "SELECT * FROM inventory WHERE invMake LIKE :searchString OR invModel LIKE :searchString OR invDescription LIKE :searchString OR invColor LIKE :searchString LIMIT " . $page . ',' . $limit;
        $sql = "SELECT inventory.invId, inventory.invYear, inventory.invMake, inventory.invModel, inventory.invDescription, inventory.invPrice, images.imgPath FROM (inventory INNER JOIN images ON images.invId = inventory.invId AND images.imgPath LIKE '%tn%') WHERE  inventory.invMake LIKE :searchString OR inventory.invModel LIKE :searchString OR inventory.invDescription LIKE :searchString OR inventory.invColor LIKE :searchString  LIMIT " . $page . ',' . $limit;
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':searchString', '%' . $searchString . '%', PDO::PARAM_STR);
        $stmt->bindValue(':page', $page, PDO::PARAM_INT);
        $stmt->bindValue(':limit',  $limit, PDO::PARAM_INT);
        $stmt->execute();
        $currentPageSearch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $currentPageSearch;
    }

?>