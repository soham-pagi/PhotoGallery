<?php
    session_start();
    
    if (!isset($_SESSION['logged-in'])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en" style="overflow-Y: hidden">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/authors-profile.css">
    <link rel="stylesheet" href="css/start.css">
    <link rel="icon" href="imgs/favicon-32x32.png">
    <title>My Profile</title>
</head>
<body>
    <!-- navbar -->
    <?php include 'includes/nav2.php'; ?>

    <div style="" class="main-container">
        <div class="posts-container">
            <?php
                $email = $_SESSION['email'];
                include 'config/dbconnect.php';

                $sql = "SELECT * FROM posts WHERE email='$email' ORDER BY date DESC";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)) {
                    $title = $row['title'];
                    $caption = $row['caption'];
                    $post_src = $row['post_src'];
    
                    echo 
                    '<div class="post" style="border-radius: 5px; width: 450px; height: 520px; margin-bottom: ">
                        <div class="user" style="border-top-left-radius: 10px; border-top-right-radius: 10px; height: 60px; display: flex; justify-content: space-between; align-items: center">
                            <p style="margin-left: 15px">' . $title . '</p>
                        </div>
                        <img style="width: 100%; height: 400px; border-radius: 10px" src="'. $post_src . '" alt="post image" >
                        <article style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px" class="description">
                            <p style="padding: 0 10px;">' . $caption . '</p>
                        </article>
                    </div>
                    ';
                }

                mysqli_close($conn);
            ?>
            <br><br><br><br><br><br>
        </div>

        <!-- profile -->
        <div class="profile-section">
            <?php
                $email = $_SESSION['email'];
                include 'config/dbconnect.php';

                $sql = "SELECT * FROM users WHERE email='$email'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $profile_src = $row['profile_src'];
                // print_r($row);

                echo '
                <div class="profile-photo-container">
                    <img class="profile-photo" src="' . $profile_src . '" alt="profile photo">
                </div>
                <div class="user-details">
                    <div>
                        <h2>Personal info</h2>
                        <h4>Name: ' . $row['firstname'] . " " . $row['lastname'] . '</h4>
                        <h4>Email: ' . $row['email'] . '</h4>
                        <h4>Age: ' . $row['age'] . '</h4>
                        <h4>Gender: ' . $row['gender'] .'</h4>
                    </div>
                </div>
                ';

                mysqli_close($conn);
            ?>
            <div>
                <div class="edit-btn">
                    <button class="btn">Edit Profile</button>
                </div>
                <div class="edit-btn">
                    <button style="background-color: red " class="btn" onclick="location.replace('logout.php')">Logout</button>
                </div>
            </div>
    </div>
</body>
</html>