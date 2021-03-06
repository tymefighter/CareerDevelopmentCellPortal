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
        <link rel="stylesheet" href="../css_files/common_home.css">
        <link rel="stylesheet" href="../css_files/register_common.css">
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
            <h2>Add Internships</h2>
            <form name="add_internship" action="../php/process_company_add_internship.php" method="post" id="login_form">
          
            <div class="container">
                
                <label for="name"><b>Name of Internship</b></label>
                <input type="text" placeholder="Enter Internship Name" name="name" required>

                <label for="description"><b>Internship Description</b></label>
                <textarea class="txtArea" rows="10" cols="50" name="description" form="login_form">Write Description Here</textarea>

                <label for="stipend"><b>Stipend (Monthly - Rupees)</b></label>
                <input type="number" placeholder="Enter Stipend" name="stipend" min="0" max="500000" class="number" step="1" required>

                <label for="duration"><b>Duration (Days)</b></label>
                <input type="number" placeholder="Enter Duration" name="duration" min="0" max="100" class="number" step="1" required>

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

                <div align="left" style = "font-size: 20px;">
                    <h3>Allowed Batches</h3>
                    <input type="checkbox" name="2016" value="2016">
                    <label for="2016">2016</label><br>
                    
                    <input type="checkbox" name="2017" value="2017">
                    <label for="2017">2017</label><br>

                    <input type="checkbox" name="2018" value="2018">
                    <label for="2018">2018</label><br>

                    <input type="checkbox" name="2019" value="2019">
                    <label for="2019">2019</label><br>

                    <input type="checkbox" name="2020" value="2020">
                    <label for="2020">2020</label><br>
                </div>
                
                <button type="submit" id="login_button">Add Internship</button>
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
