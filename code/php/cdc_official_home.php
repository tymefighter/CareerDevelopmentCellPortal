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
        <title>CDC Official Home Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/common_home.css">
        <link rel="stylesheet" href="../css_files/login_style.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
        <?php
			include('header.php');
		?>

        <div class="sidenav">
            <br>
            <a href="../php/cdc_official_profile.php"><> Profile</a>
        </div>

        <div class="main">
            <br>
            <h2>CDC Official</h2>
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
            <a class="main_link" href="../php/browse_all_students.php">Browse Students</a>
            <br><br>
            <a class="main_link" href="../php/browse_all_volunteers.php">Browse Volunteers</a>
            <br><br>
            <a class="main_link" href="../php/edit_content.php">Edit Content</a>
        </div>
   
</body>
</html> 
            
    </body>
</html>
