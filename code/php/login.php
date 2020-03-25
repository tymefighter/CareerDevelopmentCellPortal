<?php
    session_start();
?>
<html>
    <head>
        <title>CDC Home Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/login_style.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
        <ul class="nav">
            <li class="nav"><a href='home.html' class="nav">Home</a></li>
            <li class="nav"><a href='https://iitpkd.ac.in' class="nav">IIT Palakkad</a></li>
            <li class="nav"><a href="companies.html" class="nav">Companies</a></li>
            <li class="nav"><a href="projects.html" class="nav">Projects</a></li>
            <li class="nav"><a href="research.html" class="nav">Research</a></li>
            <li class="nav"><a href="news.html" class="nav">News</a></li>
            <li class="nav"><a href="../php/login.php" class="nav">Login</a></li>
            <li class="nav"><a href="../php/register.php" class="nav">Register</a></li>
            <li id="nav_button">
                <div class="cont" onclick="clickMenuButton(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </li>
        </ul>
        <h2 class="heading_common">Login</h2>

        <form action="../php/process_login.php" method="post" id="login_form">
          
            <div class="container">
              <label for="username"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="username" required>
          
              <label for="password"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>
                  
              <button type="submit" id="login_button">Login</button>
            </div>
            
        </form>
        <a href="home.html" id="cancel_button">Cancel</a>
        <br>
        <br>
        <?php
            if($_SESSION['invalid_login'] != null && $_SESSION['invalid_login'] > 0) // There was an invalid login
            {
                echo "<p id ='invalid_login'>Invalid Login</p>";
                echo "<br>";
            }
        ?>
        <a href="register.php" id="register_button">Register ?</a>
        <br>
        <br>
        <div class="container" style="background-color:#f1f1f1">
            <br>
            <br>
        </div>
    </body>
</html>