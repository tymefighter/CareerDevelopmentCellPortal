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

    if($_SESSION['roll_number'] == null)
        exit('Huge Error Occurred');
?>

<html>
<head>
        <title>Student Verification</title>
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
            <h2>Verification</h2>
            <?php
		// Try to establish connection to cdc database
		$db = new mysqli ($server, $user, $pass, $database);
                
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(send_verification_req.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                $query_check = 'select roll_number from verification_req where verification_req.roll_number = ?';
                $stmt_check = $db->prepare($query_check);
                $stmt_check->bind_param('s', $_SESSION['roll_number']);
                $stmt_check->execute();
                $stmt_check->store_result();

                if($stmt_check->num_rows == 1) {
                    $stmt_check->close();
                    echo '<h3>Verification Request Already Sent</h3>';
                    exit('');
                }
                $stmt_check->close();

                $query = 'insert into verification_req values (?)';
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $_SESSION['roll_number']);
                $stmt->execute();
                $stmt->close();

                echo '<h3>Verification Request Sent</h3>'
            ?>
        </div>
   
</body>
</html> 
            
    </body>
</html>
