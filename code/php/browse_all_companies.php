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
        <title>Volunteer Browse Companies</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/common_home.css">
        <link rel="stylesheet" href="../css_files/table.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
        <ul class="nav">
            <li class="nav"><a href='../php/home.php' class="nav">Home</a></li>
            <li class="nav"><a href='https://iitpkd.ac.in' class="nav">IIT Palakkad</a></li>
            <li class="nav"><a href="../php/companies.php" class="nav">Companies</a></li>
            <li class="nav"><a href="../php/projects.php" class="nav">Projects</a></li>
            <li class="nav"><a href="../php/research.php" class="nav">Research</a></li>
            <li class="nav"><a href="../php/news.php" class="nav">News</a></li>
            <?php
                if($_SESSION['logged_in'] != null && $_SESSION['logged_in'] == true) {
                    echo '<li class="nav"><a href="../php/logout.php" class="nav">Logout</a></li>';
                }
                else {
                    echo '<li class="nav"><a href="../php/login.php" class="nav">Login</a></li>';
                    echo '<li class="nav"><a href="../php/register.php" class="nav">Register</a></li>';
                }
            ?>
            <li id="nav_button">
                <div class="cont" onclick="clickMenuButton(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </li>
        </ul>

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
            <h2>Browse All Companies</h2>
            <?php

                // Try to establish connection to cdc database
                $db = new mysqli ($server, $user, $pass, $database);
                
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(browse_all_companies.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                $query = 'select company_id, name, company_overview, company_website from company';
                $stmt = $db->prepare($query);
                $stmt->execute();
                $stmt->bind_result($company_id, $company_name, $company_overview, $company_website);

                echo '<table>';
                echo '<tr>
                        <th>Company Id</th>
                        <th>Name</th>
                        <th>Company Overview</th>
                        <th>Company Website</th>
                    </tr>';

                while($stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . '<a class="simple_link" href="company_profile.php?company_id=' . $company_id . '">'
                        . htmlspecialchars($company_id) 
                        . '</a>'
                        . '</td>';

                    echo '<td>'. htmlspecialchars($company_name) .'</td>';
                    if(strlen($company_overview) <= 120)
                        echo '<td>'. htmlspecialchars($company_overview) .'</td>';
                    else
                        echo '<td>'. htmlspecialchars(substr($company_overview, 0, 120)) .'</td>';
                    echo '<td>'. htmlspecialchars($company_website) .'</t>';
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
