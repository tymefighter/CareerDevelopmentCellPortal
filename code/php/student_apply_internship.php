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

    if($_SESSION['user_type'] != 'student') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }
?>

<html>
<head>
        <title>Apply For Internship Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/common_home.css">
        <link rel="stylesheet" href="../css_files/login_style.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
        <?php
			include('header.php');
		?>

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
            <?php
                if($_SESSION['roll_number'] == null || $_SESSION['internship_id'] == null)
                    exit('Huge Error Occurred');
                $roll_number = $_SESSION['roll_number'];
                $internship_id = $_SESSION['internship_id'];

		// Try to establish connection to cdc database
		$db = new mysqli ($server, $user, $pass, $database);
                    
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(student_apply_internship.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                $query = 'select roll_number from apply_internship where roll_number = ? and internship_id = ?';
                $stmt = $db->prepare($query);
                $stmt->bind_param('ss', $roll_number, $internship_id);
                $stmt->execute();
                $stmt->store_result();

                if($stmt->num_rows > 0)
                    echo '<h3>You have already applied for this internship</h3>';
                else {
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y-m-d', time());

                    $stmt->close();
                    $query = 'call apply_internship(?, ?, ?)';
                    $stmt = $db->prepare($query);
                    $stmt->bind_param('sss', $roll_number, $internship_id, $date);
                    $stmt->execute();
                    echo '<h3 style="color:goldenrod;">You have succesfully applied for this internship</h3>';
                }

                $stmt->close();
            ?>
        </div>
   
</body>
</html> 
            
    </body>
</html>
