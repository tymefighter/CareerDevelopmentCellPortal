<?php
    session_start();
    if($_SESSION['logged_in'] != null && $_SESSION['logged_in'] == true) {

        $user_type = $_SESSION['user_type'];

        if($user_type == 'student')
            header('Location: student_home.php');       // Redirect to student home page
        else if($user_type == 'student_vol')
            header('Location: student_vol_home.php');   // Redirect to student volunteer home page
        else if($user_type == 'company')
            header('Location: company_home.php');       // Redirect to company home page
        else
            header('Location: cdc_official_home.php');   // Redirect to cdc offical home page
    }
?>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/login_style.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
        <ul class="nav">
            <li class="nav"><a href='../php/home.php' class="nav">Home</a></li>
            <li class="nav"><a href='https://iitpkd.ac.in' class="nav">IIT Palakkad</a></li>
            <li class="nav"><a href="../php/companies.php" class="nav">Companies</a></li>
            <li class="nav"><a href="../php/projects.php" class="nav">Projects</a></li>
            <li class="nav"><a href="../php/research.php" class="nav">Research</a></li>
            <li class="nav"><a href="../php/news.php" class="nav">News</a></li>
            <?php
                if($_SESSION['logged_in'] != null && $_SESSION['logged_in'] == true) {
                    echo '<li class="nav"><a href="../php/logout.php" class="nav">Logout</a></li>';
                }
                else {
                    echo '<li class="nav"><a href="../php/login.php" class="nav">Login</a></li>';
                    echo '<li class="nav"><a href="../php/register.php" class="nav">Register</a></li>';
                }
            ?>
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
        <a href="../php/home.php" id="cancel_button">Cancel</a>
        <br><br><br>
        <a href="../php/register.php" id="register_button">Register ?</a>
        <br><br>
        <div class="container" style="background-color:#f1f1f1">
            <br><br>
        </div>
    </body>
</html>