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
        <title>Browse All Internships</title>
        <link rel="stylesheet" href="../css_files/common_home.css">
        <link rel="stylesheet" href="../css_files/table.css">
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
            <h2>Browse Internships</h2>
            <?php

                // Try to establish connection to cdc database
                $db = new mysqli ($server, $user, $pass, $database);
                
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(browse_all_internships.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                $query = 'select i.internship_id, i.name, c.name, 
                        i.description, i.stipend, i.duration, i.min_cgpa, p_i.date
                    from internship as i, placed_internship as p_i, company as c
                    where 
                        i.internship_id = p_i.internship_id
                        and p_i.company_id = c.company_id';
                $stmt = $db->prepare($query);
                $stmt->execute();
                $stmt->bind_result($internship_id, $internship_name, $company_name, $description,
                    $stipend, $duration, $min_cgpa, $date);

                echo '<table>';
                echo '<tr>
                        <th>Internship Id</th>
                        <th>Internship Name</th>
                        <th>Company Name</th>
                        <th>Description</th>
                        <th>Stipend</th>
                        <th>Duration</th>
                        <th>Min CGPA</th>
                        <th>Date of Placing</th>
                    </tr>';

                while($stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . '<a class="simple_link" href="internship_detail.php?internship_id=' . $internship_id . '">'
                        . htmlspecialchars($internship_id) 
                        . '</a>'
                        . '</td>';

                    echo '<td>'. htmlspecialchars($internship_name) .'</td>';
                    echo '<td>'. htmlspecialchars($company_name) .'</td>';
                    if(strlen($description) <= 40)
                        echo '<td>'. htmlspecialchars($description) .'</td>';
                    else
                        echo '<td>'. htmlspecialchars(substr($description, 0, 40)) .'</td>';
                    echo '<td>'. htmlspecialchars($stipend) .'</t>';
                    echo '<td>'. htmlspecialchars($duration) .'</t>';
                    echo '<td>'. htmlspecialchars($min_cgpa) .'</t>';
                    echo '<td>'. htmlspecialchars($date) .'</t>';
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
