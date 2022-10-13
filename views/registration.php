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
    <main id="registration">
        <h1>Register</h1>
        <form id="form-reg" action="">
                <label class="userinfo" for="">
                    First Name:
                    <input type="text">
                </label>
                <label class="userinfo" for="">
                    Last Name:
                    <input type="text">
                </label>
                <label class="userinfo" for="">
                    Email:
                    <input type="text">
                </label>
                <label class="userinfo" for="">
                    Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character <br>
                    Password:
                    <input type="password">
                </label>
                <p>Show Password</p>
                <button>Register</button>
        </form>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>