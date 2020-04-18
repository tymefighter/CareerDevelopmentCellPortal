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

    // Try to establish connection to cdc database
	$db = new mysqli ($server, $user, $pass, $database);
                    
    // Connection error, hence place error in log file
    $error_num = mysqli_connect_errno();
    if($error_num) {
        error_log("error conn(student_profile.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }
    
    if($_SESSION['user_type'] == 'student')
        $roll_number = $_SESSION['roll_number'];
    else
        $roll_number = $_GET['roll_number'];

    if($_SESSION['user_type'] == 'company') {
        if($roll_number == null || $_SESSION['company_id'] == null
            || ($_SESSION['internship_id'] == null && $_SESSION['job_id'] == null))
            exit('Huge Error Occurred');

        if($_SESSION['internship_id'] == null)
            $internship_id = '';
        else
            $internship_id = $_SESSION['internship_id'];
        
        if($_SESSION['job_id'] == null)
            $job_id = '';
        else
            $job_id = $_SESSION['job_id'];
        
        $query = 'select ai.roll_number
            from apply_internship as ai, apply_job as aj
            where ai.roll_number = ? and (ai.internship_id = ? or aj.job_id = ?)';
        $stmt = $db->prepare($query);
        $stmt->bind_param('sss', $roll_number, $internship_id, $job_id);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows == 0)
            exit('Huge Error Occurred');

        $stmt->close();
    }
?>

<html>
<head>
        <title>Student Profile</title>
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
            if($_SESSION['user_type'] == 'company')
            echo '<div class="sidenav">
                <br>
                <a href="../php/company_profile.php"><> Profile</a>
                <br>
                <a href="../php/company_placed_internships.php">Placed Internships</a>
                <br>
                <a href="../php/company_placed_jobs.php">Placed Jobs</a>
                </div>';
        else if($_SESSION['user_type'] == 'student')
            echo '<div class="sidenav">
                <br>
                <a href="../php/student_profile.php"><> Profile</a>
                <br>
                <a href="../php/student_resume.php">My Resume</a>
                <br>
                <a href="../php/student_applications.php">Applications</a>
                <br>
                <a href="../php/student_verification.php">Verification</a>
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
            <h2>Student Profile</h2>
            <?php

                if($roll_number == null)
                    exit('Huge error occurred');

                $image_extensions = array('.jpg', '.jpeg', '.png');
                $picture_is_present = false;

                foreach($image_extensions as $ext) {
                    $img_path = '../profile_images/' . $roll_number . $ext;

                    $fp = fopen($img_path, 'r');
                    if($fp == false)
                        continue;

                    $picture_is_present = true;
                    
                    echo '<img border="0" alt="profile_picture" src="' . $img_path . '" width="300" height="200">';

                    fclose($fp);
                    break;
                }

                if($picture_is_present == false) {
                    echo '<a href="add_profile_picture.php">
                        <img border="0" alt="profile_picture_default" src="../profile_images/default.jpg" width="300" height="200">
                        </a>';
                }

                // General Student Details
                $query = 'SELECT name, nationality, dob, gender, tenth_percentage, tenth_board,
                        twelfth_percentage, twelfth_board, JEE_main_rank, JEE_advanced_rank, bldg_name,
                        street_name, city, state, country, phone_1, phone_2
                    FROM student
                    WHERE roll_number = ?';

                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $roll_number);
                $stmt->execute();
                $stmt->bind_result($name,  $nationality, $dob, $gender, $tenth_percentage, $tenth_board,
                $twelfth_percentage, $twelfth_board, $JEE_main_rank, $JEE_advanced_rank, $bldg_name,
                $street_name, $city, $state, $country, $phone_1, $phone_2);
                $stmt->store_result();

                if($stmt->num_rows == 0)
                    exit('Student Does Not Exist');

                $stmt->fetch();
                $stmt->close();
            ?>

            <br><br>
            <table>
            <tr>
                <th>Roll Number</th>
                <td><?php echo $roll_number; ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td><?php echo $nationality; ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?php echo $dob; ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo $gender; ?></td>
            </tr>
            <tr>
                <th>Tenth Percentage</th>
                <td><?php echo $tenth_percentage; ?></td>
            </tr>
            <tr>
                <th>Tenth Board</th>
                <td><?php echo $tenth_board; ?></td>
            </tr>
            <tr>
                <th>Twelfth Percentage</th>
                <td><?php echo $twelfth_percentage; ?></td>
            </tr>
            <tr>
                <th>Twelfth Board</th>
                <td><?php echo $twelfth_board; ?></td>
            </tr>
            <tr>
                <th>JEE Main Rank</th>
                <td><?php echo $JEE_main_rank; ?></td>
            </tr>
            <tr>
                <th>JEE Advanced Rank</th>
                <td><?php echo $JEE_advanced_rank; ?></td>
            </tr>
            <tr>
                <th>Building Name</th>
                <td><?php echo $bldg_name; ?></td>
            </tr>
            <tr>
                <th>Street Name</th>
                <td><?php echo $street_name; ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo $city; ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?php echo $state; ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo $country; ?></td>
            </tr>
            <tr>
                <th>Phone No.</th>
                <td><?php echo $phone_1; ?></td>
            </tr>
            <tr>
                <th>Alternate Phone No.</th>
                <td><?php echo $phone_2; ?></td>
            </tr>
            </table>

            <?php
                // Academic Performance
                $query = 'SELECT sem1, sem2, sem3, sem4, sem5, sem6, sem7, sem8, cgpa
                    FROM academic_performance, cgpa
                    WHERE cgpa.roll_number = ? and academic_performance.roll_number = cgpa.roll_number';

                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $roll_number);
                $stmt->execute();
                $stmt->bind_result($sem1, $sem2, $sem3, $sem4, $sem5, $sem6, $sem7, $sem8, $cgpa);
                $stmt->store_result();
                $stmt->fetch();
                $stmt->close();
            ?>

            <h3>Academic Performance</h3>
            <table>
            <tr>
                <th>Sem1 GPA</th>
                <td><?php echo $sem1; ?></td>
            </tr>
            <tr>
                <th>Sem2 GPA</th>
                <td><?php echo $sem2; ?></td>
            </tr>
            <tr>
                <th>Sem3 GPA</th>
                <td><?php echo $sem3; ?></td>
            </tr>
            <tr>
                <th>Sem4 GPA</th>
                <td><?php echo $sem4; ?></td>
            </tr>
            <tr>
                <th>Sem5 GPA</th>
                <td><?php echo $sem5; ?></td>
            </tr>
            <tr>
                <th>Sem6 GPA</th>
                <td><?php echo $sem6; ?></td>
            </tr>
            <tr>
                <th>Sem7 GPA</th>
                <td><?php echo $sem7; ?></td>
            </tr>
            <tr>
                <th>Sem8 GPA</th>
                <td><?php echo $sem8; ?></td>
            </tr>
            <tr>
                <th>CGPA</th>
                <td><?php echo $cgpa; ?></td>
            </tr>
            </table>
            <br>
            <a class="main_link" href="../php/student_resume.php">Resume</a>
            <br><br>
            <?php
                if($_SESSION['user_type'] == 'student_vol') {
                    
                    $_SESSION['roll_number'] = $roll_number;
                    echo '<a class="main_link" href="../php/verify_student.php">Verify Student</a>
                        <br><br>';
                }
                else if($_SESSION['user_type'] == 'student')
                    echo '<a class="main_link" href="../php/student_update_academic.php">Update Academic Details</a>
                        <br><br>'
            ?>
            <div class="container" style="background-color:#f1f1f1">
                <br><br><br>
            </div><br>
        </div>
   
</body>
</html> 
            
    </body>
</html>
