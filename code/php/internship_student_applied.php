<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'company') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }

    if($_SESSION['internship_id'] == null || $_SESSION['company_id'] == null)
        exit('Huge Error Occurred');

    // Try to establish connection to cdc database via tymefighter@localhost user
    $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
                
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
        <title>Students Applied for Internship</title>
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

                $query = 'call get_applied_students_internship(?)';
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
                    echo '<td>' . '<a class="simple_link" href="student_profile.php?roll_number=' . $roll_number . '">'
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