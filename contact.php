<?php
    session_start();
    if (!isset($_SESSION['logged-in'])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/start.css">
    <link rel="stylesheet" href="css/common.css">
    <title>Contact Us</title>
</head>
<body>
    <?php include 'includes/nav2.php'; ?>

    <div class="flex-col box" style="padding-top: 0;">
        <div class="contact-us">
            <h1 class="md">Contact Us</h1>
            <p class="sm">Swing by for a cup of coffee, or leave us a message</p>
        </div>
        <div class="form-group">
            <form action="" method="POST" class="form">
                <input class="input gap" type="email" name="email" placeholder="Email" required> <br>
                <textarea class="textarea" placeholder="Write something..."></textarea> <br>
                <button type="submit" class="btn">Send</button>
            </form>
        </div>
    </div>


    <script src="background.js"></script>
</body>
</html>