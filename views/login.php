<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <title>Login</title>
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'?>
    <nav>
        <?php // require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
            echo $navList;
        ?>
    </nav>
    <main id="login">
        <h1>Sign in</h1>
        <?php
        if (isset($message)){
            echo $message;
        }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post">
                <label class="userinfo" for="userEmail">
                    Email:
                    <input type="email" name="clientEmail" id="userEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
                </label><p><span>*Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span></p>
                <label class="userinfo" for="userPassword">
                    Password:
                    <input type="password" name="clientPassword" id="userPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                </label>
                <input type="submit" name="submit" id="btn" value="Sign-in">
                <input  type="hidden" name="action" value="Login">
        </form>
        <p><a href="index.php?action=not-register">Not a member yet?</a></p>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>