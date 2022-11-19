<?php
    if(!isset($_SESSION['loggedin'])){
        header('Location: /phpmotors');
    }else if($_SESSION['clientData']['clientLevel'] == 1){
        header('Location: /phpmotors');
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <title>Document</title>
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'?>
    <nav>
        <?php // require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
            echo $navList;
        ?>
    </nav>
    <main>
        <h1>Vehicle Management</h1>
        <ul>
            <li><a href="index.php?action=add-classif-page">Add Classification</a></li>
            <li><a href="index.php?action=add-vehicle-page">Add Vehicle</a></li>
        </ul>
        <?php 
            if(isset($message)){
                echo $message;
            }
            if(isset($classificationList)){
                echo '<h2>Vehicles by classification</h2>';
                echo '<p>Choose a classification to see those vehicles</p>'
                echo $classificationList;
            }
        ?>
        <noscript>
            <p>Javascript Must Be Enabled To Use This Page.</p>
        </noscript>
        <table id='inventoryDisplay'></table>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
    <script src="../js/inventory.js"></script>
</body>
</html>