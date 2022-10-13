<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <title>Registration</title>
</head>

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php' ?>
    <main id="registration">
        <h1>Register</h1>
        <form id="form-reg" action="">
            <label class="userinfo" for="firstName">
                First Name:
                <input type="text" name="firstName" id="firstName" required>
            </label>
            <label class="userinfo" for="lastName">
                Last Name:
                <input type="text" name="lastName" id="lastName" required>
            </label>
            <label class="userinfo" for="userEmail">
                Email:
                <input type="text" name="userEmail" id="userEmail" required>
            </label>
            <p>Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character </p>
            <label class="userinfo" for="userPassword">
                Password:
                <input type="password" name="userPassword" id="userPassword" required>
            </label>
            <p id="showBtn">Show Password</p>
            <button>Register</button>
        </form>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>

</html>