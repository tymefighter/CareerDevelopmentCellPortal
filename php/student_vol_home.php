<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'student_vol') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }
?>

<html>
<head>
        <title>Volunteer Home Page</title>
        <link rel="stylesheet" href="../css_files/common_home.css">
    </head>
    <body>
        <?php
			include('header.php');
		?>

        <div class="sidenav">
            <br>
            <a href="../php/student_vol_profile.php"><> Profile</a>
            <br>
            <a href="../php/student_vol_contribution.php">My Contribution</a>
        </div>

        <div class="main">
            <br>
            <h2>Volunteer Home</h2>
            <h3>Latest Feed</h3>
            <div id="latest_feed">
                <?php
                ?>
            </div>
            <br><br>
            <a class="main_link" href="../php/browse_all_companies.php">Browse Companies</a>
            <br><br>
            <a class="main_link" href="../php/browse_all_internships.php">Browse Internships</a>
            <br><br>
            <a class="main_link" href="../php/browse_all_jobs.php">Browse Jobs</a>
            <br><br>
            <a class="main_link" href="../php/verification_list.php">Verification Applicant List</a>
            <br><br>
            <a class="main_link" href="../php/edit_content.php">Edit Content</a>
            <br><br>
        </div>
   
</body>
</html> 
            
    </body>
</html>
