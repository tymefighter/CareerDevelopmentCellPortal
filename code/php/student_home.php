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
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'student') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }

    if($_SESSION['roll_number'] == null) {
        exit('Huge Error Occurred');
    }

    // Try to establish connection to cdc database
    $db = new mysqli ($server, $user, $pass, $database);
    // Connection error, hence place error in log file
    $error_num = mysqli_connect_errno();
    if($error_num) {
        error_log("error conn(student_home.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }

    # Check if student has got an internship
    $query = 'select internship_id from accept_internship where roll_number = ?';
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $_SESSION['roll_number']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($internship_id);
    $stmt->fetch();

    $accept_internship = $stmt->num_rows > 0;
    $stmt->close();

    # Check if student has got a job
    $query = 'select job_id from accept_job where roll_number = ?';
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $_SESSION['roll_number']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($job_id);
    $stmt->fetch();

    $accept_job = $stmt->num_rows > 0;
    $stmt->close();

    # Student cannot have both job and internship at a time
    if($accept_intership && $accept_job)
        exit('Huge Error Occurred');
?>
<html>
<head>
        <title>Student Home Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/common_home.css">
        <script src="../javascript/validate.js"></script>
        <script>
        	function logout_confirm() {
				if (confirm('Confirm logout ?'))
					return true;
				return false;
			}
		</script>
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
                    echo '<li class="nav"><a href="../php/logout.php" class="nav" onclick="return logout_confirm();">Logout</a></li>';
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
            <?php
                if($accept_internship)
                    echo '<a href="../php/internship_detail.php?internship_id=' . $internship_id . '">My Internship</a> <br>';
                else if($accept_job)
                    echo '<a href="../php/internship_detail.php?job_id=' . $job_id . '">My Job</a> <br>';
                else
                    echo '<a href="../php/student_applications.php">Applications</a> <br>';
            ?>
            <a href="../php/student_verification.php">Verification</a>
        </div>

        <div class="main">
            <br>
            <h2>Student Home</h2>
            <h3>Latest Feed</h3>
            <div id="latest_feed">
                <?php
                ?>
            </div>
            <br><br>
            <?php
                if($accept_internship == false && $accept_job == false)
                    echo '
                            <a class="main_link" href="../php/student_browse_internships.php">Browse Internships</a>
                            <br><br>
                            <a class="main_link" href="../php/student_browse_jobs.php">Browse Jobs</a>
                        ';
            ?>
        </div>
   
</body>
</html> 
            
    </body>
</html>
