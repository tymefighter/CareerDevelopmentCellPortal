<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }
?>

<html>
<head>
        <title>Student Resume</title>
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
            <h2>Student Resume</h2>
            <?php
                if($_SESSION['roll_number'] == null)
                    exit('Huge Error Occurred');

                $roll_number = $_SESSION['roll_number'];

                $fp = fopen('../resumes/' . $roll_number . '.pdf', 'r');

                // Resume is already uploaded, so display it, one cannot download this resume
                if($fp != false) {
                    echo '<iframe src="../resumes/' . $roll_number . '.pdf#toolbar=0" width="100%" height="800px">
                        </iframe>';
                    fclose($fp);
                }

                // If user is a student, then she/he can upload a new resume
                echo '<form action="upload_resume.php" method="post" enctype="multipart/form-data">
                        <h3 style="color:goldenrod;">Upload Resume</h3>
                        <input type="file" name="resumeFile" accept=".pdf">
                        <button type="submit" id="login_button">Upload</button>
                    </form>';
            ?>

        </div>
   
</body>
</html> 
            
    </body>
</html>