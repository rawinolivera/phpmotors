<header>
    <img id="logo" src="/phpmotors/images/site/logo.png" alt="Website Logo">
        <?php if(!isset($_SESSION['clientData'])){
            echo '<h2 id=top-mark><a href="/phpmotors/accounts">My account</a></h2>';
        } else {
            echo '<h2 id=top-mark><span><a href="/phpmotors/accounts/?action=user">Welcome '.$_SESSION['clientData']['clientFirstname'].'</a> | </span><a href="/phpmotors/accounts/?action=logout">Logout</a></h2>';
        }?>
        <a href="/phpmotors/search"><img id="lupa" src="/phpmotors/images/site/buscar.png" alt="magnifying glass"></a>
</header>