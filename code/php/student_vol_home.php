<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'student_vol') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }
?>

<html>
<head>
        <title>Volunteer Home Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/common_home.css">
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

        <div class="sidenav">
            <br>
            <a href="../php/student_vol_profile.php"><> Profile</a>
            <br>
            <a href="../php/student_vol_contribution.php">My Contribution</a>
        </div>

        <div class="main">
            <br>
            <h2>Volunteer Home</h2>
            <h3>Information</h3>
            <div id="latest_feed">
                <?php
                ?>
            </div>
            <br><br>
            <a class="main_link" href="../php/student_vol_browse_companies.php">Browse Companies</a>
            <br><br>
            <a class="main_link" href="../php/student_vol_browse_internships.php">Browse Internships</a>
            <br><br>
            <a class="main_link" href="../php/student_vol_browse_jobs.php">Browse Jobs</a>
            <br><br>
            <a class="main_link" href="../php/student_vol_verification.php">Verification Applicant List</a>
            <br><br>
            <a class="main_link" href="../php/student_vol_add_content.php">Add Content</a>
            <br><br>
        </div>
   
</body>
</html> 
            
    </body>
</html>