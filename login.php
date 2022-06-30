<?php
    session_start();

    if ( isset($_POST['submit']) ) {
        if ( validateUser($_POST['email'], md5($_POST['password'])) ) {
            echo '
                <script>
                    alert("Login successful.");
                    location.replace("home.php");
                </script>
            ';
        } else {
		    echo '
                <script>
                    alert("Wrong email or password! Please try again!");
                    location.replace("login.php");
                </script>
            ';
		} 
    }

    function validateUser($email, $password) {
        include 'config/dbconnect.php';

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
		$result = mysqli_query( $conn, $sql );
		$num = mysqli_num_rows( $result );

		if( $num == 1 ) {
            $_SESSION['logged-in'] = 1;
            $_SESSION['email'] = $email;

            return true; 
		} 

        return false;
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
    <link rel="stylesheet" href="css/start.css">
    <title>PhotoGallery Log in</title>
</head>
<body style="overflow: hidden;">
    <!-- short navbar -->
    <?php include 'includes/short_navbar.php'; ?>

    <!-- form -->
    <div class="container">
        <div class="form-container">
            <p class="md">Log in to PhotoGallery</p>
            <form action="" method="POST">
                <input class="input gap" type="email" name="email" placeholder="Email" required> <br>
                <input class="input gap" type="password" name="password" placeholder="Password" required>

                <!-- captcha -->
                <button class="btn gap" name="submit" type="submit">Log in</button>
            </form>
    
            <p class="sm gap">Not a PhotoGallery member? <a href="signup.php" class="a">Sign up here.</a></p>
        </div>
    </div>

    <script src="background.js"></script>
</body>
</html>