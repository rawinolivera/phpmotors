<?php
    if(!isset($_SESSION['loggedin'])){
        header('Location: /phpmotors');
    }else if($_SESSION['clientData']['clientLevel'] == 1){
        header('Location: /phpmotors');
    }
?><?php
// Build the selesct list
$classificationList = '<select id="list" name="classificationId" required>';
$classificationList .='<option value="">Choose from the List</option>';
foreach ($classLists as $classList){
    $classificationList .="<option value='$classList[classificationId]'";
        if(isset($classificationId)){
            if($classList['classificationId'] === $classificationId){
                $classificationList .= ' selected ';
            }
        } elseif(isset($invInfo['classificationId'])){
            if($classList['classificationId'] === $invInfo['classificationId']){
                $classificationList .= 'selected ';
            }
        }
    $classificationList .=">$classList[classificationName]</option>";
}
$classificationList .='</select>';

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'?>
    <nav>
        <?php // require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
            echo $navList;
        ?>
    </nav>
    <main id="vehicle">
        <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) {
                    echo "Modify$invMake $invModel"; }?></h1>
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
                <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?> required>
            </label>
            <label for="invModel">
                Model
                <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?> required>
            </label>
            <label for="invDescription">
                Description
                <textarea name="invDescription" id="invDescription" cols="30" rows="2" required><?php if(isset($invDescription)){echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea>
            </label>
            <label for="invImage">
                Image Path
                <input type="text" id="invImage" name="invImage" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } ?> required>
            </label>
            <label for="invThumbnail">
                Thumbnail Path
                <input type="text" id="invThumbnail" name="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } ?> required>
            </label>
            <label for="invPrice">
                Price
                <input type="number" id="invPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } ?> required>
            </label>
            <label for="invStock">
                # In Stock
                <input type="text" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; } ?> required>
            </label>
            <label for="invColor">
                Color
                <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?> required>
            </label>
            <input type="submit" id="btn" value="Update Vehicle">
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="<?php 
            if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ 
                echo $invId; } ?>">
        </form>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>