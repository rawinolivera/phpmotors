<?php
//custom functions

function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function checkClasslist($classificationId){
    if($classificationId ==! 0){
        $classificationId === "";
    }
    return $classificationId;
}

function navList($classifications){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php'>Home</a></li>";
    foreach ($classifications as $classification){
        $navList .="<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .='</ul>';
    return $navList;
}

function buildClassificationList($classLists){
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose  a Classification</option>";
    foreach ($classLists as $classification){
        $classificationList .= "<option value = '$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

function getInventoryByClassification($classificationId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}

// display of vehicles
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle){
        $dv .= '<li>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicle-detail&vehicleId=$vehicle[invId]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
    $dv .= "<span>$". number_format($vehicle['invPrice']) ."</span></a>";
    $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

function buildVehicleSelectedDisplay($vehicleSelected){
    
    foreach($vehicleSelected as $vehicleData){
        $dvs = "<h1>$vehicleData[invMake] $vehicleData[invModel]</h1>";
        $dvs .= "<section>";
        $dvs .= "<img src='$vehicleData[invImage]' alt='Image of $vehicleData[invMake] $vehicleData[invModel] on phpmotors.com'></img>";
        $dvs .= "<p class='price'>Price: $". number_format($vehicleData['invPrice']) ."<span></span></p>";
        $dvs .= "<h2>$vehicleData[invMake] $vehicleData[invModel] Detail</h2>";
        $dvs .= "<p class='description'>$vehicleData[invDescription]</p>";
        $dvs .= "<p class='color'>Color: <span>$vehicleData[invColor]</span></p>";
        $dvs .= "<p class='stock'># In Stock: <span>$vehicleData[invStock]</span></p>";
    }
    $dvs .= "</section>";
    return $dvs;

}

?>