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
                if($_SESSION['user_type'] == 'student')
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
