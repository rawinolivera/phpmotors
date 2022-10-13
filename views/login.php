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
    <main id="login">
        <h1>Sign in</h1>
        <form action="">
                <label class="userinfo" for="userEmail">
                    Email:
                    <input type="text" name="userEmail" id="userEmail" required>
                </label>
                <label class="userinfo" for="userPassword">
                    Password:
                    <input type="password" name="userPassword" id="userPassword" required>
                </label>
                <button>Sign-in</button>
        </form>
        <p><a href="index.php?action=register">Not a member yet?</a></p>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>