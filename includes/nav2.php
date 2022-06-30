<nav class="navbar" style="z-index: 2">
        <div class="logo">
            <a href="home.php">
                <img src="imgs/logo.png" class="hover" width="200px" alt="logo">
            </a>
        </div>
        <div class="nav-links">
            <ul>
                <li><a href="home.php" class="hover">Home</a></li>
                <li><a href="explore.php" class="hover">Explore</a></li>
                <li><a href="contact.php" class="hover">Contact</a></li>
                <li><a href="about.php" class="hover">About</a></li>
            </ul>
        </div>

        <!-- make dynamic login or profile -->
        <?php
            if ( isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == 1 ) {
                include 'config/dbconnect.php';
                $email = $_SESSION['email'];
                $sql = "select * from users where email='$email' ";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
    
                $profile = $row['profile_src'];
                $profie_page = 'profile.php';
    
                echo 
                '<script>
                    function openProfile() {
                        location.replace("profile.php");
                    }
                </script>
                ';
    
                echo '
                    <div>
                        <div style="display: block;" class="profile" onclick="openProfile()">
                            <img style="width: 50px; height: 50px" src="' . $profile . '" alt="profile">
                        </div>
                    </div>
                ';
                mysqli_close($conn);
            } else {
                echo '
                    <div class="login-signup-links" >
                        <a href="login.php" id="login" class="hover">Log In</a>
                        <a href="signup.php" id="signup" class="hover">Sign Up</a>
                    </div>
                ';
            }
        ?>        
    </nav>