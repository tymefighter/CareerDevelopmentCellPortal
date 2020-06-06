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
        <title>Student Applications</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/common_home.css">
        <link rel="stylesheet" href="../css_files/table.css">
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
		// Try to establish connection to cdc database
		$db = new mysqli ($server, $user, $pass, $database);
                    
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(student_applications.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                if($_SESSION['roll_number'] == null)
                    exit('Huge Error Occurred');
                
                // Internships Applied
                echo '<h2>Internships</h2><br><br>';
                $query = 'call get_applied_internships(?)';
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $_SESSION['roll_number']);
                $stmt->execute();
                $stmt->store_result();
                
                $stmt->bind_result($internship_id, $name, $description, $stipend, $duration, $min_cgpa, $date_of_application);

                echo '<table>';
                echo '<tr>
                        <th>Internship Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Stipend</th>
                        <th>Duration</th>
                        <th>Min CGPA</th>
                        <th>Date of Application</th>
                    </tr>';

                while($stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . '<a class="simple_link" href="internship_detail.php?internship_id=' . $internship_id . '">'
                        . htmlspecialchars($internship_id) 
                        . '</a>'
                        . '</td>';
                    echo '<td>'. htmlspecialchars($name) .'</td>';
                    if(strlen($description) <= 70)
                        echo '<td>'. htmlspecialchars($description) .'</td>';
                    else
                        echo '<td>'. htmlspecialchars(substr($description, 0, 70)) .'</td>';
                    echo '<td>'. htmlspecialchars($stipend) .'</t>';
                    echo '<td>'. htmlspecialchars($duration) .'</td>';
                    echo '<td>'. htmlspecialchars($min_cgpa) .'</td>';
                    echo '<td>'. htmlspecialchars($date_of_application) .'</td>';
                    echo '</tr>';
                }

                echo '</table>';
                $stmt->close();
                
                // Jobs Applied
                echo '<h2>Jobs</h2><br><br>';
                $query = 'call get_applied_jobs(?)';
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $_SESSION['roll_number']);
                $stmt->execute();
                $stmt->store_result();
                
                $stmt->bind_result($job_id, $name, $description, $CTC, $perks, $min_cgpa, $date_of_application);

                echo '<table>';
                echo '<tr>
                        <th>Job Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>CTC</th>
                        <th>Perks</th>
                        <th>Min CGPA</th>
                        <th>Date of Application</th>
                    </tr>';

                while($stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . '<a class="simple_link" href="job_detail.php?job_id=' . $job_id . '">'
                        . htmlspecialchars($job_id) 
                        . '</a>'
                        . '</td>';
                    echo '<td>'. htmlspecialchars($name) .'</td>';
                    if(strlen($description) <= 70)
                        echo '<td>'. htmlspecialchars($description) .'</td>';
                    else
                        echo '<td>'. htmlspecialchars(substr($description, 0, 70)) .'</td>';
                    
                    echo '<td>'. htmlspecialchars($CTC) .'</t>';
                    if(strlen($perks) <= 70)
                        echo '<td>'. htmlspecialchars($perks) .'</td>';
                    else
                        echo '<td>'. htmlspecialchars(substr($perks, 0, 70)) .'</td>';
                    echo '<td>'. htmlspecialchars($min_cgpa) .'</td>';
                    echo '<td>'. htmlspecialchars($date_of_application) .'</td>';
                    echo '</tr>';
                }

                echo '</table>';
                $stmt->close();

            ?>
        </div>

    </body>
</html>
