<?php
/*
 * Accounts Model
 */

 // Register a new client
function RegClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    $db = phpmotorsConnect();
    // The SQL Statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the sql
    // Statement with the actual values in the variables and tell the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changes as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//Check for an existing email address
    function checkExistingEmail($clientEmail){
        $db = phpmotorsConnect();
        $sql = 'SELECT clientEmail from clients WHERE clientEmail = :clientEmail';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->execute();
        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if(empty($matchEmail)){
            return 0;
        } else {
            return 1;
        }
    }

// Get the client data based on the email address
    function getClient($clientEmail){
        $db = phpmotorsConnect();
        $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->execute();
        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $clientData;
    }

    function updateUser($clientId, $clientFirstname, $clientLastname, $clientEmail){
        $db = phpmotorsConnect();
        $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
        $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount($stmt);
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function getDataclient($clientId){
        $db = phpmotorsConnect();
        $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
        $stmt->execute();
        $fullClient = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $fullClient;

    }

    function changePassword($clientId, $clientPassword){
        $db = phpmotorsConnect();
        $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount($stmt);
        $stmt->closeCursor();
        return $rowsChanged;
    }



?>