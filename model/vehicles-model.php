<?php

// Vehicles Model

function getClassList() {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM carclassification ORDER BY classificationName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $classList = $stmt->fetchAll();
    $stmt->closeCursor();
    return $classList;
}

function regClassif($classificationName) {
    $db = phpmotorsConnect();
    // The SQL Statement
    $sql = 'INSERT INTO carclassification (classificationName)
        VALUES (:classificationName)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the sql
    // Statement with the actual values in the variables and tell the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changes as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

?>