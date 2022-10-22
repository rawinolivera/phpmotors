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
    <main id="vehicle">
        <h1>Add Vehicle</h1>
        <p>*Note all Fields are Required</p>
        <form action="">
            <select name="" id=""> <!--This is temporal, will be replace by the database-->
                <option value="">Choose car Classification</option>
            </select>
            <label for="">
                Make
                <input type="text">
            </label>
            <label for="">
                Model
                <input type="text">
            </label>
            <label for="">
                Description
                <textarea name="" id="" cols="30" rows="10"></textarea>
            </label>
            <label for="">
                Image Path
                <input type="text">
            </label>
            <label for="">
                Thumbnail Path
                <input type="text">
            </label>
            <label for="">
                Price
                <input type="text">
            </label>
            <label for="">
                # In Stock
                <input type="text">
            </label>
            <label for="">
                Color
                <input type="text">
            </label>
            <input type="submit" id="btn" value="Add Vehicle">
        </form>
    </main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
    <script src="/phpmotors/js/motors.js"></script>
</body>
</html>