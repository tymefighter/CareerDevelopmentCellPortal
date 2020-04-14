<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'student') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }
?>
<html>
    <head>
        <title>Student Browse Internship</title>
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
            <h2>Internships</h2>
            <br><br>
            <?php
                
                // Try to establish connection to cdc database via tymefighter@localhost user
                $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
                    
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(student_browse_internship.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                if($_SESSION['roll_number'] == null)
                    exit('Huge Error Occurred');

                $query = 'call get_allowed_internships(?)';
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $_SESSION['roll_number']);
                $stmt->execute();
                $stmt->store_result();
                
                $stmt->bind_result($internship_id, $name, $company_name, $description, $stipend, $duration, $min_cgpa, $date_of_placing);

                echo '<table>';
                echo '<tr>
                        <th>Internship Id</th>
                        <th>Name</th>
                        <th>Company name</th>
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
                    echo '<td>'. htmlspecialchars($name) .'</td>';
                    echo '<td>'. htmlspecialchars($company_name) .'</td>';
                    if(strlen($description) <= 70)
                        echo '<td>'. htmlspecialchars($description) .'</td>';
                    else
                        echo '<td>'. htmlspecialchars(substr($description, 0, 70)) .'</td>';
                    echo '<td>'. htmlspecialchars($stipend) .'</t>';
                    echo '<td>'. htmlspecialchars($duration) .'</td>';
                    echo '<td>'. htmlspecialchars($min_cgpa) .'</td>';
                    echo '<td>'. htmlspecialchars($date_of_placing) .'</td>';
                    echo '</tr>';
                }

                echo '</table>';

            ?>
        </div>

    </body>
</html>