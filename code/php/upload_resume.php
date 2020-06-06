<?php
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

    // Try to establish connection to cdc database
	$db = new mysqli ($server, $user, $pass, $database);
    
    // Connection error, hence place error in log file
    $error_num = mysqli_connect_errno();
    if($error_num) {
        error_log("error conn(upload_resume.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }
?>

<html>
<head>
        <title>Upload Resume</title>
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
            <h2>Upload Resume</h2>
            <?php
                if($_SESSION['roll_number'] == null)
                    exit('Huge Error Occurred');

                $roll_number = $_SESSION['roll_number'];

                $imageFileType = strtolower(pathinfo($_FILES["resumeFile"]["name"],PATHINFO_EXTENSION));
                if($imageFileType != 'pdf')
                    exit('Uploaded file is not a PDF');

                // File Size Cannot be more than 2MB
                if ($_FILES["resumeFile"]["size"] > 2097152) {
                    exit('File Size greater than 2MB');
                }

                // We must now unverify the student, then upload the document
                $query = 'call unverify_student(?)';
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $roll_number);
                $stmt->execute();

                if(move_uploaded_file($_FILES["resumeFile"]["tmp_name"], '../resumes/' . $roll_number . '.pdf') == false)
                    exit('Error in uploading resume');
            ?>

            <h3 style='color:goldenrod;'>Resume has been uploaded</h3>
        </div>
   
</body>
</html> 
            
    </body>
</html>
