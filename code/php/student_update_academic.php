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
        <title>Update Academic Details</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/common_home.css">
        <link rel="stylesheet" href="../css_files/register_common.css">
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
            <h2>Update Academic Details</h2>
            <?php
                if($_SESSION['roll_number'] == null)
                    exit('Huge Error Occurred');

                $roll_number = $_SESSION['roll_number'];

                // Try to establish connection to cdc database via tymefighter@localhost user
                $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
                                
                // Connection error, hence place error in log file
                $error_num = mysqli_connect_errno();
                if($error_num) {
                    error_log("error conn(student_update_academic.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
                    exit('');
                }

                // Check if student has applied for an internship or job
                $query = 'select apply_internship.roll_number from apply_internship, apply_job
                    where apply_internship.roll_number = ? or apply_job.roll_number = ?';
                $stmt = $db->prepare($query);
                $stmt->bind_param('ss', $roll_number, $roll_number);
                $stmt->execute();
                $stmt->store_result();

                // Student has applied for an internship or job, so she/he
                // cannot update her/his academic details now.
                if($stmt->num_rows > 0) {
                    exit('<h3>Since you have applied for an internship/job you cannot update
                        academic performance now</h3>');
                }

                $stmt->close();

                // Get previous academic performance values
                $query = 'select sem1, sem2, sem3, sem4, sem5, sem6, sem7, sem8
                    from academic_performance where roll_number = ?';
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $roll_number);
                $stmt->execute();
                $stmt->bind_result($sem1, $sem2, $sem3, $sem4, $sem5, $sem6, $sem7, $sem8);
                $stmt->fetch();
            ?>

            <form name="student_update_academic" action="../php/process_update_academic.php" method="post" id="login_form">
          
                <div class="container">
                <br><br>
                
                    <label for="sem1"><b>Sem1 GPA</b></label>
                    <input type="number" value = <?php echo $sem1 ?> name="sem1" min="0" max="10" class="number" step="0.01">

                    <label for="sem2"><b>Sem2 GPA</b></label>
                    <input type="number" value = <?php echo $sem2 ?> name="sem2" min="0" max="10" class="number" step="0.01">

                    <label for="sem3"><b>Sem3 GPA</b></label>
                    <input type="number" value = <?php echo $sem3 ?> name="sem3" min="0" max="10" class="number" step="0.01">

                    <label for="sem4"><b>Sem4 GPA</b></label>
                    <input type="number" value = <?php echo $sem4 ?> name="sem4" min="0" max="10" class="number" step="0.01">

                    <label for="sem5"><b>Sem5 GPA</b></label>
                    <input type="number" value = <?php echo $sem5 ?> name="sem5" min="0" max="10" class="number" step="0.01">

                    <label for="sem6"><b>Sem6 GPA</b></label>
                    <input type="number" value = <?php echo $sem6 ?> name="sem6" min="0" max="10" class="number" step="0.01">

                    <label for="sem7"><b>Sem7 GPA</b></label>
                    <input type="number" value = <?php echo $sem7 ?> name="sem7" min="0" max="10" class="number" step="0.01">

                    <label for="sem8"><b>Sem8 GPA</b></label>
                    <input type="number" value = <?php echo $sem8 ?> name="sem8" min="0" max="10" class="number" step="0.01">

                    <button type="submit" id="login_button">Update Information</button>
                </div>
            </form>
            <a href="../php/student_profile.php" id="cancel_button">Cancel</a>
            <br>
            <br>
            <div class="container" style="background-color:#f1f1f1">
                <br>
                <br>
            </div>
        </div>
   
</body>
</html> 
            
    </body>
</html>