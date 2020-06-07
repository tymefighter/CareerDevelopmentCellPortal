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
        <title>Process Update Academic</title>
        <link rel="stylesheet" href="../css_files/common_home.css">
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
            <h2>Updating Details</h2>
            <?php

                if($_SESSION['roll_number'] == null)
                    exit('Huge Error Occurred');

                $roll_number = $_SESSION['roll_number'];

                // Try to establish connection to cdc database
                $db = new mysqli ($server, $user, $pass, $database);
                            
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(process_update_academic.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                for($i = 1;$i <= 8;$i ++) {
                    $sem_no = 'sem' . $i;

                    if($_POST[$sem_no] == '')
                        $_POST[$sem_no] = null;
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
