<?php
    session_start();
    date_default_timezone_set("Asia/Kolkata");
    
    if (!isset($_SESSION['logged-in']) && $_SESSION['logged-in'] != 1) {
        header("Location: login.php");
    }

    if ( isset($_POST['submit']) ) {
        
        $file = $_FILES['pic'];
        // print_r($file);
        $path = "uploads/posts/";
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        // echo $path;
        $img_name = uniqid("post", true) . "." . $extension;
        $target_path = $path . $img_name;
        // echo $target_path;

        // echo $img_name;
        move_uploaded_file($_FILES['pic']['tmp_name'], $target_path);

        uploadImage($_POST['title'], $_SESSION['email'], $_POST['caption'], $target_path);
    }

    function uploadImage($title, $email, $caption, $post_src) {
        
	    $datetime = date('Y-m-d H:i:s');
        include 'config/dbconnect.php';
        $sql = "INSERT INTO posts VALUES(
                '$title',
                '$email',
                '$caption',
                '$post_src',
                '$datetime'
            )";

        if (mysqli_query($conn, $sql)) {
            echo '
                <script>
                    alert("Image uploaded successfully.");
                    location.replace("profile.php");
                </script>
            ';		
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
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
    <link rel="stylesheet" href="css/common.css">
    <link rel="icon" href="imgs/favicon-32x32.png">
    <title>Upload</title>
</head>
<body style="overflow-Y: show">

    <!-- short navbar -->
    <?php include 'includes/nav2.php'; ?>

    <div class="container">
        <div class="form-container">
            <p class="md">Upload Your Collection</p>
            <form action="" method="POST" enctype="multipart/form-data">
                <input class="input gap" type="text" name="title" placeholder="Title" required>
                <fieldset class="fs">
                    <legend>Select Picture</legend>
                    <input type="file" name="pic" id="file" accept=".jpg, .jpeg, .png" required>
                </fieldset>
                <textarea name="caption" class="textarea" placeholder="Captioin..."></textarea> <br>
                <button style="margin-bottom: 30px" name="submit" class="btn gap" type="submit">Post</button>
            </form>
        </div>
    </div>

    <script src="background.js"></script>
</body>
</html>