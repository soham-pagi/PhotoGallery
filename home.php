<?php
    session_start();
    
    if (!isset($_SESSION['logged-in'])) {
        echo '
            <script>
                alert("Please log in to continue!");
                location.replace("login.php");
            </script>
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
    <link rel="stylesheet" href="css/start.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="icon" href="imgs/favicon-32x32.png">
    <link rel="stylesheet" href="css/grid-content.css">
    <link rel="stylesheet" href="css/authors-profile.css">
    <title>Photography Changes Everything - PhotoGallery</title>
</head>
<body>
    <!-- navbar -->
    <?php include 'includes/nav2.php'; ?>

    <!-- sort -->
    <!-- <div class="sort-box">
        <select name="" id="sort">
            <option value="">Trending</option>
            <option value="">Popular</option>
            <option value="">Most Viewed</option>
        </select>
    </div> -->

    <div class="post-btn">
        <button style="position: fixed; margin-top: 5px; background-color: #0080ff; left: 40%" class="btn"
        onclick="location.replace('upload.php')">
            Post Your Collection
        </button>
    </div>

    <!-- grid photos -->
    <div class="grid-container" style="margin-top: 60px">
        <?php
            $email = $_SESSION['email'];
            include 'config/dbconnect.php';
            
            $sql = "SELECT * FROM posts ORDER BY RAND()";
            $result = mysqli_query($conn, $sql);            

            foreach( $result as $row ) {
                $title = $row['title'];
                $caption = $row['caption'];
                $post_src = $row['post_src'];
                $email = $row['email'];

                $sql2 = "SELECT * FROM users WHERE email='$email'";
                $r = mysqli_query($conn, $sql2);
                $row = mysqli_fetch_assoc($r);
                $profile_src = $row['profile_src'];

                echo 
                '<div class="posts-card box-shadow" style="height: 520px; border-radius: 10px;">
                    <div class="user" style="border-top-left-radius: 10px; border-top-right-radius: 10px; height: 60px; display: flex; justify-content: space-between; align-items: center">
                        <p style="margin-left: 15px">' . $title . '</p>
                        <img style="width: 40px; height: 40px" src="' . $profile_src . '" alt="" class="pfp c">
                    </div>
                    <div style="height: 400px">
                        <img style="width: 100%; height: 100%;" src="' . $post_src .'" alt="post">
                        <article style="min-height: 60px; margin-top: -5px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px" class="description">
                            <p style="margin: 0 10px; padding: 10px 5px">' . $caption . '</p>
                        </article>
                    </div>
                </div>
                ';
            }

            mysqli_close($conn);
        ?>
        <br><br>
    </div>
    
    <script src="background.js">
    </script>
</body>
</html>