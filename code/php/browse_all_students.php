<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'cdc_official') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }
?>

<html>
<head>
        <title>Browse All Students</title>
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
            <a href="../php/cdc_official_profile.php"><> Profile</a>
        </div>

        <div class="main">
            <br>
            <h2>Browse Students</h2>
            <?php

                // Try to establish connection to cdc database via tymefighter@localhost user
                $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
                
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(browse_all_students.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                $query = 'call get_all_student_info()';
                $stmt = $db->prepare($query);
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