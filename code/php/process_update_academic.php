<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'student') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }
?>

<html>
<head>
        <title>Process Update Academic</title>
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
            <a href="../php/student_profile.php"><> Profile</a>
            <br>
            <a href="../php/student_resume.php">My Resume</a>
            <br>
            <a href="../php/student_applications.php">Applications</a>
            <br>
            <a href="../php/student_verification.php">Verification</a>
        </div>

        <div class="main">
            <br>
            <h2>Updating Details</h2>
            <?php

                if($_SESSION['roll_number'] == null)
                    exit('Huge Error Occurred');

                $roll_number = $_SESSION['roll_number'];

                // Try to establish connection to cdc database via tymefighter@localhost user
                $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
                            
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(process_update_academic.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                $query = 'call update_academic_details(?, ?, ?, ?, ?, ?, ?, ?, ?)';
                $stmt = $db->prepare($query);
                $stmt->bind_param('sdddddddd', $roll_number, $_POST['sem1'], $_POST['sem2'], $_POST['sem3'], 
                    $_POST['sem4'], $_POST['sem5'], $_POST['sem6'], $_POST['sem7'], $_POST['sem8']);
                $stmt->execute();
                $stmt->close();
            ?>

            <h3>Academic Details Successfully Changed</h3>
            <a class="main_link" href="../php/student_profile.php">Profile</a>
        </div>
   
</body>
</html> 
            
    </body>
</html>