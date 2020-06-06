<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'company') {
        if($_SESSION['user_type'] == 'student')
            exit('This webpage cannot be accessed by a student');
        else if($_GET['company_id'] == null)
            exit('Huge Problem Occurred');
        else
            $company_id = $_GET['company_id'];
    }
    else
        $company_id = $_SESSION['company_id'];
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
        <title>Company Profile</title>
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
            if($_SESSION['user_type'] == 'company')
                echo '<div class="sidenav">
                    <br>
                    <a href="../php/company_profile.php"><> Profile</a>
                    <br>
                    <a href="../php/company_placed_internships.php">Placed Internships</a>
                    <br>
                    <a href="../php/company_placed_jobs.php">Placed Jobs</a>
                    </div>';
            else if($_SESSION['user_type'] == 'student_vol')
                echo '<div class="sidenav">
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
            <h2>Company Profile</h2>

            <?php

		// Try to establish connection to cdc database
		$db = new mysqli ($server, $user, $pass, $database);
                                
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(company_profile.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                if($company_id == null)
                    exit('Huge Error Occurred');

                $query = 'select company_id, name, email_id_1, email_id_2, phone_1, phone_2, is_startup, company_overview,
                        hq_bldg_name, hq_street_name, hq_city, hq_state, hq_country, hq_pincode, company_website
                    from company where company_id = ?';

                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $company_id);
                $stmt->execute();
                $stmt->bind_result($company_id, $name, $email_id_1, $email_id_2, $phone_1, $phone_2, $is_startup, $company_overview,
                    $hq_bldg_name, $hq_street_name, $hq_city, $hq_state, $hq_country, $hq_pincode, $company_website);
                $stmt->store_result();

                if($stmt->num_rows == 0)
                    exit('Company Does Not Exist');

                $stmt->fetch();
                $stmt->close();
            ?>

            <br><br>
            <table>
            <tr>
                <th>Company Id</th>
                <td><?php echo $company_id; ?></td>
            </tr>
            <tr>
                <th>Company Name</th>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <th>Email Id</th>
                <td><?php echo $email_id_1; ?></td>
            </tr>
            <tr>
                <th>Other Email Id</th>
                <td><?php echo $email_id_2; ?></td>
            </tr>
            <tr>
                <th>Contact No.</th>
                <td><?php echo $phone_1; ?></td>
            </tr>
            <tr>
                <th>Another Contact No.</th>
                <td><?php echo $phone_2; ?></td>
            </tr>
            <tr>
                <th>Is a Startup ?</th>
                <td><?php echo $is_startup; ?></td>
            </tr>
            <tr>
                <th>Company Overview</th>
                <td><?php echo $company_overview; ?></td>
            </tr>
            <tr>
                <th>Headquarters Building Name</th>
                <td><?php echo $hq_bldg_name; ?></td>
            </tr>
            <tr>
                <th>Headquarters Street Name</th>
                <td><?php echo $hq_street_name; ?></td>
            </tr>
            <tr>
                <th>Headquarters City</th>
                <td><?php echo $hq_city; ?></td>
            </tr>
            <tr>
                <th>Headquarters State</th>
                <td><?php echo $hq_state; ?></td>
            </tr>
            <tr>
                <th>Headquarters Country</th>
                <td><?php echo $hq_country; ?></td>
            </tr>
            <tr>
                <th>Headquarters Pincode</th>
                <td><?php echo $hq_pincode; ?></td>
            </tr>
            <tr>
                <th>Company Website</th>
                <td><?php echo $company_website; ?></td>
            </tr>
            </table>
            <br>
        </div>
   
</body>
</html> 
            
    </body>
</html>
