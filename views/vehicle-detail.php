<!DOCTYPE html>
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
        echo $navList 
        ?>
    </nav>
    <main>
        <?php if(isset($message)){
            echo $message;
        }
        ?>
        <?php if(isset($vehicleSelectedDisplay)){
            echo $vehicleSelectedDisplay;
        } ?>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>