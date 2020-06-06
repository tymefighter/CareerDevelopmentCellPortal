<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'student_vol' && $_SESSION['user_type'] != 'cdc_official') {
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
        <title>Browse All Jobs</title>
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

        <?php
            if($_SESSION['user_type'] == 'student_vol')
                echo'<div class="sidenav">
                        <br>
                        <a href="../php/student_vol_profile.php"><> Profile</a>
                        <br>
                        <a href="../php/student_vol_contribution.php">My Contribution</a>
                    </div>';
            else
                echo '<div class="sidenav">
                        <br>
                        <a href="../php/cdc_official_profile.php"><> Profile</a>
                    </div>';
        ?>

        <div class="main">
            <br>
            <h2>Browse Jobs</h2>
            <?php

                // Try to establish connection to cdc database
                $db = new mysqli ($server, $user, $pass, $database);
                
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(browse_all_jobs.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                $query = 'select j.job_id, j.name, c.name, j.description, j.CTC, j.perks, j.min_cgpa, p_j.date
                    from job as j, company as c, placed_job as p_j
                    where j.job_id = p_j.job_id and c.company_id = p_j.company_id';
                $stmt = $db->prepare($query);
                $stmt->execute();
                $stmt->bind_result($job_id, $name, $company_name, $description, $CTC, $perks, $min_cgpa, $date_of_placing);

                echo '<table>';
                echo '<tr>
                        <th>Job Id</th>
                        <th>Name</th>
                        <th>Company name</th>
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
                    echo '<td>'. htmlspecialchars($company_name) .'</td>';
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
                    echo '<td>'. htmlspecialchars($date_of_placing) .'</td>';
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
