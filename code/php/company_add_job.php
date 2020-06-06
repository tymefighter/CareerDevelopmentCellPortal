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
        <link rel="stylesheet" href="../css_files/login_style.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
        <?php
			include('header.php');
		?>

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

                <div align="left" style = "font-size: 20px;">
                    <h3>Allowed Branches</h3>
                    <input type="checkbox" name="civil_eng" value="civil_eng">
                    <label for="civil_eng">Civil Engg.</label><br>
                    
                    <input type="checkbox" name="comp_sc" value="comp_sc">
                    <label for="comp_sc">Computer Sc. and Engg.</label><br>

                    <input type="checkbox" name="elec_eng" value="elec_eng">
                    <label for="elec_eng">Electrical Engg.</label><br>

                    <input type="checkbox" name="mech_eng" value="mech_eng">
                    <label for="mech_eng">Mechanical Engg.</label><br>
                </div>
                
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
