<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'company') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }
?>

<html>
<head>
        <title>Add Internship</title>
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
            <a href="../php/company_profile.php"><> Profile</a>
            <br>
            <a href="../php/company_placed_internships.php">Placed Internships</a>
            <br>
            <a href="../php/company_placed_jobs.php">Placed Jobs</a>
        </div>

        <div class="main">
            <br>
            <h2>Add Jobs</h2>
            <form name="add_job" action="../php/process_company_add_job.php" method="post" id="login_form">
          
            <div class="container">
                
                <label for="name"><b>Name of Job</b></label>
                <input type="text" placeholder="Enter Job Name" name="name" required>

                <label for="description"><b>Job Description</b></label>
                <textarea class="txtArea" rows="10" cols="50" name="description" form="login_form">Write Description Here</textarea>

                <label for="CTC"><b>CTC (Monthly - Rupees)</b></label>
                <input type="number" placeholder="Enter CTC" name="CTC" min="0" max="500000" class="number" step="1" required>

                <label for="perks"><b>Job Perks</b></label>
                <textarea class="txtArea" rows="10" cols="50" name="perks" form="login_form">Perks</textarea>

                <br>
                <label for="min_cgpa"><b>Minimum CGPA Allowed</b></label>
                <input type="number" placeholder="Enter CGPA" name="min_cgpa" min="0" max="10" class="number" step="0.01" required>
                
                <button type="submit" id="login_button">Add Job</button>
            </div>
            
        </form>
        <div class="container" style="background-color:#f1f1f1">
            <br>
            <br>
        </div>
        </div>
   
</body>
</html> 
            
    </body>
</html>