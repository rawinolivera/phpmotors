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
            echo $navList;
        ?>
    </nav>
    <main id="home">
        <h1>Welcome to PHP Motors!</h1>
        <section id="dmc">
        <h2>DMC Delorean</h2>
            <div class="list">
                <p>3 Cup Holder</p>
                <p>Superman doors</p>
                <p>Fuzzy dice!</p>
                <button id="btn1">Own Today</button>
            </div>
                <img src="/phpmotors/images/vehicles/1982-dmc-delorean.jpg" alt="1982 DMC Delorean">
                <div class="button">
                    <button>Own Today</button>
                </div>
        </section>
        <section id="reviews">
            <h2>DMC Delorean Reviews</h2>
                <ul>
                    <li>"So fast is almost like traveling in time" (4/5)</li>
                    <li>"Coolest ride on the rode." (4/5)</li>
                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
        </section>
        <section id="upgrades">
            <h2>Delorean Upgrades</h2>
            <div class="flux">
                <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">
                <h3>Flux Capacitor</h3>
            </div>
            <div class="flame">
                <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decals">
                <h3>Flame Decals</h3>
            </div>
            <div class="bumper">
                <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
                <h3>Bumper Stickers</h3>
            </div>
            <div class="hub">
                <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Caps">
                <h3>Hub Caps</h3>
            </div>
        </section>

    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>