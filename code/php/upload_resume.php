<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'student') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }

    // Try to establish connection to cdc database via tymefighter@localhost user
    $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
    
    // Connection error, hence place error in log file
    $error_num = mysqli_connect_errno();
    if($error_num) {
        error_log("error conn(upload_resume.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }
?>

<html>
<head>
        <title>Upload Resume</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/common_home.css">
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
            <h2>Upload Resume</h2>
            <?php
                if($_SESSION['roll_number'] == null)
                    exit('Huge Error Occurred');

                $roll_number = $_SESSION['roll_number'];

                $imageFileType = strtolower(pathinfo($_FILES["resumeFile"]["name"],PATHINFO_EXTENSION));
                if($imageFileType != 'pdf')
                    exit('Uploaded file is not a PDF');

                // File Size Cannot be more than 2MB
                if ($_FILES["resumeFile"]["size"] > 2097152) {
                    exit('File Size greater than 2MB');
                }

                // We must now unverify the student, then upload the document
                $query = 'call unverify_student(?)';
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $roll_number);
                $stmt->execute();

                if(move_uploaded_file($_FILES["resumeFile"]["tmp_name"], '../resumes/' . $roll_number . '.pdf') == false)
                    exit('Error in uploading resume');
            ?>

            <h3 style='color:goldenrod;'>Resume has been uploaded</h3>
        </div>
   
</body>
</html> 
            
    </body>
</html>