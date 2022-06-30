<?php
    $conn = mysqli_connect('localhost', 'root', '', 'photogallery');

    if ($conn) {
        // echo '<script>alert("connected to database successfully");</script>';
    } else {
        die('Failed to connect');
    }
?>