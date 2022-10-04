<?php 
/*
*Proxy connection to the phpmotors database
*/

function phpmotorsConnect(){
    $server = 'localhost';
    $dbname = 'phpmotors';
    $username = 'iClient';
    $password = '-Milexa2910';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try{
        $link = new PDO($dsn, $username, $password, $options);
        //if(is_object($link)){
        //    echo 'It worked';
        //}
        return $link;
    }catch(PDOException $e){
        //echo "It didn't work, error: " . $e->getMessage();
        header('location: /phpmotors/views/500.php');
    }

}

phpmotorsConnect();
?>