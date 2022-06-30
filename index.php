<?php
    session_start();
    
    if (isset($_SESSION['logged-in'])) {
        echo '
            <script>location.replace("home.php");</script>
        ';
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
    <link rel="icon" href="imgs/favicon-32x32.png">
    <title>Photography Changes Everything - PhotoGallery</title>
</head>
<body>
    <!-- navbar -->
    <?php include 'includes/nav2.php'; ?>

    <!-- quote -->
    <div class="welcome-msg">
        <h1 class="text-shadow">Find your inspiration.</h1>
        <h3 class="text-shadow">Join the PhotoGallery community, home to tens of billions of photos.</h3>
        <a href="signup.php" class="a-btn hover box-shadow a">Get Started</a>
    </div>

    <script src="background.js"></script>
</body>
</html>