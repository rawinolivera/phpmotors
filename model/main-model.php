<?php

//This is the Main PHP Motors Model

function getClassifications() {
    $db = phpmotorsConnect();
    $sql = 'SELECT classificationName FROM carclassification ORDER BY classificationName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $classification = $stmt->fetchAll();
    $stmt->closeCursor();
    return $classification;
}

?>