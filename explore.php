<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/grid-content.css">
    <link rel="stylesheet" href="css/authors-profile.css">
    <link rel="stylesheet" href="css/start.css">
    <link rel="stylesheet" href="css/explore.css">
    <link rel="icon" href="imgs/favicon-32x32.png">
    <title>Explore PhotoGallery</title>
</head>
<body>
    <?php include 'includes/nav2.php'; ?>
    
    <div class="topbar">
        <button class="btn" style="width: 100px; height: 40px; margin-right: 20px;"
        onclick="location.replace('explore.php?q=latest')">Latest</button>
        <button class="btn" style="width: 100px; height: 40px; margin-right: 100px;"
        onclick="location.replace('explore.php?q=oldest')">Oldest</button>
        <form action="" method="GET">
            <input style="padding-left: 10px" name="q" type="text" id="searchbar" required>
            <button type="submit" class="btn" style="width: 100px; height: 40px">Search</button>
        </form>
    </div>

    <div class="grid-container" style="margin-top: 55px">
    <?php
            $email = $_SESSION['email'];
            include 'config/dbconnect.php';

            $sql = "SELECT * FROM posts ORDER BY RAND()";

            if ( isset($_GET['q']) ) {
                $q = trim($_GET['q']);

                if ($q != '') {
                    if ($q == 'latest') {
                        $sql = "SELECT * FROM posts ORDER BY date DESC";
                    } else if ($q == 'oldest') {
                        $sql = "SELECT * FROM posts ORDER BY date ASC";
                    } else {
                        $sql = "SELECT * FROM posts WHERE title LIKE'$q%'";
                    }
                } else {
                    header("Location: explore.php");
                }
            }

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

        <script src="background.js"></script>
    </div>
    
</body>
</html>