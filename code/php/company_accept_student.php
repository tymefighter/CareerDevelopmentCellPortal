<?php

    session_start();
    if ($_SESSION['login_info'] == null) {
		$line = file_get_contents("../login_info.txt") or die("Unable to open file!");
		$lines = explode("\n", $line);
		if (count($lines) < 4)
	   		die("Some login information are missing!");
       	$_SESSION['server']   = $lines[0];
       	$_SESSION['user']     = $lines[1];
       	$_SESSION['pass']     = $lines[2];
       	$_SESSION['database'] = $lines[3];
       	$_SESSION['login_info'] = TRUE;
    }
    
    $server	= $_SESSION['server'];
    $user	= $_SESSION['user'];
    $pass	= $_SESSION['pass'];
    $database	= $_SESSION['database'];
?>

<?php

    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'company') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }

    if($_SESSION['internship_id'] == null || $_SESSION['company_id'] == null)
        exit('Huge Error Occurred');

    // Try to establish connection to cdc database
    $db = new mysqli ($server, $user, $pass, $database);

    // Connection error, hence place error in log file
    $error_num = mysqli_connect_errno();
    if($error_num) {
        error_log("error conn(company_accept_student.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }

    if(($_SESSION['internship_applied'] != true || $_SESSION['internship_id'] == null)
        && ($_SESSION['job_applied'] != true || $_SESSION['job_id'] == null))
        exit('Huge Error Occurred');

    if($_SESSION['roll_number'] == null)
        exit('Huge Error');
?>

<html>
<head>
        <title>Accept Student</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/common_home.css">
        <link rel="stylesheet" href="../css_files/table.css">
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
            <a href="../php/company_profile.php"><> Profile</a>
            <br>
            <a href="../php/company_placed_internships.php">Placed Internships</a>
            <br>
            <a href="../php/company_placed_jobs.php">Placed Jobs</a>
        </div>

        <div class="main">
            <br>
            <h2>Accept Student</h2>
            <?php
                if($_SESSION['internship_applied'] == true) {
                    $query = 'call accept_student_internship(?, ?)';
                    $stmt = $db->prepare($query);
                    $stmt->bind_param('ss', $_SESSION['roll_number'], $_SESSION['internship_id']);
                    if($stmt->execute() != true)
                        exit('Some Error Occurred');
                }
                else {
                    $query = 'call accept_student_job(?, ?)';
                    $stmt = $db->prepare($query);
                    $stmt->bind_param('ss', $_SESSION['roll_number'], $_SESSION['job_id']);
                    if($stmt->execute() != true)
                        exit('Some Error Occurred');
                }
            ?>

            <h3>Student Accepted</h3>
            <br><br>
        </div>
   
</body>
</html> 
            
    </body>
</html>
