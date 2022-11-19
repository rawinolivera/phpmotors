<?php
    if($_SESSION['clientData']['clientLevel'] < 2){
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
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
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
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) {
                    echo "Delete $invMake $invModel"; }?></h1>
        <?php
        if (isset($message)){
            echo $message;
        }
        ?>
        <p>Confirm Vehicle Deletion. The delete is permanent.</p>
        <form action="/phpmotors/vehicles/index.php" method="post">
            <?php
                echo $classificationList;
            ?>
       <!--     <select name="" id="list"> 
                <option value="">Choose car Classification</option>
            </select> -->
            <label for="invMake">
                Make
                <input type="text" id="invMake" name="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?> readonly>
            </label>
            <label for="invModel">
                Model
                <input type="text" id="invModel" name="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?> readonly>
            </label>
            <label for="invDescription">
                Description
                <textarea name="invDescription" id="invDescription" cols="30" rows="2" readonly><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea>
            </label>
            <input type="submit" id="btn" value="Delete Vehicle">
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php 
            if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ 
                echo $invId; } ?>">
        </form>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>