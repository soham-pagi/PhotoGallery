<?php
    if (isset($_POST['submit'])) {
        $passwordHash = md5($_POST['password']);
        $confirmPasswordHash = md5($_POST['confirmpassword']);

        $file = $_FILES['pfp'];
        // print_r($file);
        $path = "uploads/profiles/";
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        // echo $path;
        $img_name = uniqid("pic", true) . "." . $extension;
        $target_path = $path . $img_name;
        // echo $target_path;

        // echo $img_name;
        move_uploaded_file($_FILES['pfp']['tmp_name'], $target_path);

        if (matchPassword($passwordHash, $confirmPasswordHash)) {
            if (!duplicate($_POST['email'])) {
                registerUser(
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['age'],
                    $_POST['gender'],
                    $_POST['email'],
                    $passwordHash,
                    $target_path
                );
            } else {
                echo '
                    <script>
                        alert("Email already exists! Please Log in to continue!");
                        location.replace("login.php");
                    </script>
                ';
            }
        } else {
            echo '
                <script>
                    alert("Password mismatch! Try again");
                    location.replace("signup.php");
                </script>
            ';
        }
    }

    function matchPassword($password, $confirmPassword) {
        return $password == $confirmPassword;
    }

    function duplicate($email) {
        include 'config/dbconnect.php';
        $check_query = mysqli_query($conn, "SELECT * FROM users where email ='$email'");
        $rowCount = mysqli_num_rows($check_query);
        mysqli_close($conn);
        
        if ($rowCount > 0) return true;

        return false;
    }

    function registerUser($firstname, $lastname, $age, $gender, $email, $password, $profile_pic) {
        // echo "$firstname $lastname $age $gender $email $password";
        include 'config/dbconnect.php';
        $default_profile = "imgs/default_profile.png";
        $sql = "INSERT INTO users VALUES(
                '$firstname',
                '$lastname',
                '$age',
                '$gender',
                '$email',
                '$password',
                '$profile_pic'
            )";

        if (mysqli_query($conn, $sql)) {
            echo '
                <script>
                    alert("Registered successfully. Please login to continue.");
                    window.location.replace("login.php");
                </script>
            ';		
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
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
    <link rel="stylesheet" href="css/common.css">
    <link rel="icon" href="imgs/favicon-32x32.png">
    <title>Sign up</title>
</head>
<body>
    <!-- short navbar -->
    <?php include 'includes/short_navbar.php'; ?>

    <div class="container">
        <div class="form-container">
            <p class="md">Sign up for PhotoGallery</p>
            <form action="" method="POST" enctype="multipart/form-data">
                <input class="input gap" type="text" name="firstname" placeholder="First name" required> <br>
                <input class="input gap" type="text" name="lastname" placeholder="Last name" required> <br>
                <input class="input gap" type="number" name="age" min="1" placeholder="Age" required> <br>
                <fieldset class="fs">
                    <legend>Profile Picture</legend>
                    <input type="file" name="pfp" id="file" accept=".jpg, .jpeg, .png" required>
                </fieldset>
                <fieldset class="fs">
                    <legend>Gender</legend>
                    <div class="flexbox">
                        <div>
                            <input name="gender" value="Male" type="radio" id="male">
                            <label for="male">Male</label>
                        </div>
                        <div>
                            <input value="female" name="gender" type="radio" id="Female">
                            <label for="female">Female</label>
                        </div>
                        <div>
                            <input name="gender" value="other" type="radio" id="Other">
                            <label for="other">Other</label>
                        </div>
                    </div>
                </fieldset>
                <input class="input gap" type="email" name="email" placeholder="Email" required> <br>
                <input class="input gap" type="password" name="password" placeholder="Password" required> <br>
                <input class="input gap" type="password" name="confirmpassword" placeholder="Confirm password" required> <br>

                <!-- captcha -->
                
                <button name="submit" class="btn gap" type="submit">Sign up</button>
            </form>
    
            <p class="sm gap">Already a PhotoGallery member? <a href="login.php" class="a">Log in here.</a></p>
        </div>
    </div>

    <script src="background.js"></script>
</body>
</html>