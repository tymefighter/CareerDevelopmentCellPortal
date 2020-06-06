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
        error_log("error conn(internship_student_applied.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }

    $query = 'select i.internship_id from internship as i, placed_internship as p_i where i.internship_id = ? and p_i.company_id = ? and i.internship_id = p_i.internship_id';
    $stmt = $db->prepare($query);
    $stmt->bind_param('ss', $_SESSION['internship_id'], $_SESSION['company_id']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows == 0) {
        exit('Huge Error Occurred');
    }
?>

<html>
<head>
        <title>Students Applied for Job</title>
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
            <a href="../php/company_profile.php"><> Profile</a>
            <br>
            <a href="../php/company_placed_internships.php">Placed Internships</a>
            <br>
            <a href="../php/company_placed_jobs.php">Placed Jobs</a>
        </div>

        <div class="main">
            <br>
            <h2>Applied Students</h2>
            <?php

                $query = 'call get_applied_students_job(?)';
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $_SESSION['internship_id']);
                $stmt->execute();
                $stmt->bind_result($roll_number, $name, $cgpa, $branch, $batch);

                echo '<table>';
                echo '<tr>
                        <th>Roll Number</th>
                        <th>Name</th>
                        <th>CGPA</th>
                        <th>Branch</th>
                        <th>Batch</th>
                    </tr>';

                while($stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . '<a class="simple_link" href="student_detail.php?roll_number=' . $roll_number . '">'
                        . htmlspecialchars($roll_number) 
                        . '</a>'
                        . '</td>';

                    echo '<td>'. htmlspecialchars($name) .'</td>';
                    echo '<td>'. htmlspecialchars($cgpa) .'</td>';
                    echo '<td>'. htmlspecialchars($branch) .'</td>';
                    echo '<td>'. htmlspecialchars($batch) .'</td>';
                    echo '</tr>';
                }

                echo '</table>';
                $stmt->close();
            ?>
            <br><br>
        </div>
   
</body>
</html> 
            
    </body>
</html>
