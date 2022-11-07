<header>
    <img src="/phpmotors/images/site/logo.png" alt="Website Logo">
    <h2><?php if(isset($cookieFirstname)){
        echo "<span>Welcome $cookieFirstname</span>";
    } ?> <a href="/phpmotors/accounts">My account</a></h2>
</header>