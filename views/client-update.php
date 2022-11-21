<?php
    if(!isset($_SESSION['loggedin'])){
        header('Location: /phpmotors');
    }
?><!DOCTYPE html>
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
    <main id="client-update">
        <h1>Manage Account</h1>
        <section>
            <h2>Update Account</h2>
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?>
            <form id="form-reg" method="post" action="/phpmotors/accounts/index.php">
            <label class="userinfo" for="firstName">
                First Name:
                <input type="text" name="clientFirstname" id="firstName" <?php if(isset($_SESSION['clientData']['clientFirstname'])) {echo "value=".$_SESSION['clientData']['clientFirstname']; } ?> required>
            </label>
            <label class="userinfo" for="lastName">
                Last Name:
                <input type="text" name="clientLastname" id="lastName" <?php if(isset($_SESSION['clientData']['clientLastname'])) {echo "value=".$_SESSION['clientData']['clientLastname']; } ?> required>
            </label>
            <label class="userinfo" for="userEmail">
                Email:
                <input type="email" name="clientEmail" id="userEmail" <?php if(isset($_SESSION['clientData']['clientEmail'])) {echo "value=".$_SESSION['clientData']['clientEmail']; } ?> required>
            </label>
            <input type="submit" name="submit" id="btn" value="Update Info">
            <input type="hidden" name="action" value="userUpdate">
            <input type="hidden" name="clientId" value="<?php 
            if(isset($_SESSION['clientData'])){ echo $_SESSION['clientData']['clientId'];} ?>">
        </form>
        </section>
        
        <section>
            <h2>Update Password</h2>
            <?php
                if (isset($message2)){
                    echo $message2;
                }
            ?>
            <form id="form-reg" method="post" action="/phpmotors/accounts/index.php">
            <p><span>Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span></p>
            <p><span>*note your original password will be changed.</span></p>
            <label class="userinfo" for="userPassword">
                Password:
                <input type="password" name="clientPassword" id="userPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            </label>
            <input type="submit" name="submit" id="btn" value="Update Password">
            <input type="hidden" name="action" value="passChange">
            <input type="hidden" name="clientId" value="<?php 
            if(isset($_SESSION['clientData'])){ echo $_SESSION['clientData']['clientId'];} ?>">
        </form>
        </section>

    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>