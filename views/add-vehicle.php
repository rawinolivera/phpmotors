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
    <main id="vehicle">
        <h1>Add Vehicle</h1>
        <?php
        if (isset($message)){
            echo $message;
        }
        ?>
        <p>*Note all Fields are Required</p>
        <form action="/phpmotors/vehicles/index.php" method="post">
            <?php
                echo $classificationList;
            ?>
       <!--     <select name="" id="list"> 
                <option value="">Choose car Classification</option>
            </select> -->
            <label for="invMake">
                Make
                <input type="text" id="invMake" name="invMake">
            </label>
            <label for="invModel">
                Model
                <input type="text" id="invModel" name="invModel">
            </label>
            <label for="invDescription">
                Description
                <textarea name="invDescription" id="invDescription" cols="30" rows="2"></textarea>
            </label>
            <label for="invImage">
                Image Path
                <input type="text" id="invImage" name="invImage">
            </label>
            <label for="invThumbnail">
                Thumbnail Path
                <input type="text" id="invThumbnail" name="invThumbnail">
            </label>
            <label for="invPrice">
                Price
                <input type="text" id="invPrice" name="invPrice">
            </label>
            <label for="invStock">
                # In Stock
                <input type="text" id="invStock" name="invStock">
            </label>
            <label for="invColor">
                Color
                <input type="text" id="invColor" name="invColor">
            </label>
            <input type="submit" id="btn" value="Add Vehicle">
            <input type="hidden" name="action" value="add-vehicle">
        </form>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>