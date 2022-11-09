<header>
    <img src="/phpmotors/images/site/logo.png" alt="Website Logo">
    <?php if(!isset($_SESSION['clientData'])){
        echo '<h2><a href="/phpmotors/accounts">My account</a></h2>';
    } else {
        echo '<h2><span><a href="/phpmotors/accounts/?action=user">Welcome '.$_SESSION['clientData']['clientFirstname'].'</a> | </span><a href="/phpmotors/accounts/?action=logout">Logout</a></h2>';
    }?> 
</header>