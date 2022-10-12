<header>
    <img src="/phpmotors/images/site/logo.png" alt="Website Logo">
    <h2>My account</h2>
    <nav>
        <?php // require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
        require_once '../libraries/connections.php';
        require_once '../model/main-model.php';
        
        $classifications = getClassifications();
        //var_dump($classifications);
        //exit;
        
        // Build a navigation bar using the $classifications array
        $navList = '<ul>';
        $navList .= "<li><a href='/phpmotors/index.php' tittle='View the PHP Motors home page'>Home</a></li>";
        foreach ($classifications as $classification){
            $navList .="<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
        }
        $navList .='</ul>';
        echo $navList 
        ?>
    </nav>
</header>