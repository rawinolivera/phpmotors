<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <title>Search</title>
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'?>
    <nav>
        <?php // require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
        echo $navList 
        ?>
    </nav>
    <main id="search">
        <h1>Search</h1>
        <?php
        if (isset($message)){
            echo $message;
        }
        ?>
        <section id=search-form>
            <form id="" action="/phpmotors/search/index.php" method="post">
                <label for="searchBar">
                    What are you looking for today?
                    <input id="search-bar" type="text" name="searchBar" <?php if(isset($searchBar)){echo "value='$searchBar'";} ?> required pattern="{,30}" maxlength="30">
                </label>
                
                <input type="submit" id="btn" value="Search">
                <input type="hidden" name="action" value="search">
            </form>
        </section>

        <?php 
        if(isset($searchBar)){
            echo $result_msg;
        }
        if(isset($searchDisplay)){
            echo $searchDisplay;
        }
        if(isset($paginationBar)){
            echo $paginationBar;
        }
        ?>
        
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>