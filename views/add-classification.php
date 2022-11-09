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
    <main id="classification">
        <h1>Add Car Classification</h1>
        <?php
        if (isset($message)){
            echo $message;
        }
        ?>
        <form id="form-classif" action="/phpmotors/vehicles/index.php" method="post">
            <p><span class="warning">*Only 30 characters allowed.</span></p>
            <label for="classifName">
                Classification name
                <input type="text" id="classifName" name="classificationName" <?php if(isset($classificationName)){echo "value='$classificationName'";} ?> required pattern="{,30}" maxlength="30">
            </label>
            
            <input type="submit" id="btn" value="Add Classification">
            <input type="hidden" name="action" value="add-classification">
        </form>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>