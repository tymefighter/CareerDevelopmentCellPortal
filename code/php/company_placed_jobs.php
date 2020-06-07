<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'company') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }
?>

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

<html>
    <head>
        <title>Company Placed Jobs</title>
        <link rel="stylesheet" href="../css_files/common_home.css">
        <link rel="stylesheet" href="../css_files/table.css">
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
            <h2>Placed Jobs</h2>
            <a class="main_link" href="../php/company_add_job.php">Add Job</a>
            <br><br>
            <?php
                
                // Try to establish connection to cdc database
		$db = new mysqli ($server, $user, $pass, $database);
                    
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(company_placed_internship.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                if($_SESSION['company_id'] == null)
                    exit('Huge Error Occurred');

                $query = 'call get_all_jobs(?)';
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $_SESSION['company_id']);
                $stmt->execute();
                $stmt->store_result();
                
                $stmt->bind_result($job_id, $name, $description, $CTC, $perks, $min_cgpa, $date_of_placing);

                echo '<table>';
                echo '<tr>
                        <th>Job Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>CTC</th>
                        <th>Perks</th>
                        <th>Min CGPA</th>
                        <th>Date of Placing</th>
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
                    echo '<td>'. htmlspecialchars($perks) .'</td>';
                    echo '<td>'. htmlspecialchars($min_cgpa) .'</td>';
                    echo '<td>'. htmlspecialchars($date_of_placing) .'</td>';
                    echo '</tr>';
                }

                echo '</table>';

            ?>
        </div>

    </body>
</html>
