<?php
    session_start();

    if($_SESSION['logged_in'] != null && $_SESSION['logged_in'] == true) {

        $user_type = $_SESSION['user_type'];

        if($user_type == 'student')
            header('Location: student_home.php');       // Redirect to student home page
        else if($user_type == 'student_vol')
            header('Location: student_vol_home.php');   // Redirect to student volunteer home page
        else if($user_type == 'company')
            header('Location: company_home.php');       // Redirect to company home page
        else
            header('Location: cdc_offical_home.php');   // Redirect to cdc offical home page
    }
    $_SESSION['prev_page'] = 'register_student_vol.php';
?>
<html>
    <head>
        <title>Register Student Volunteer</title>
        <link rel="stylesheet" href="../css_files/register_common.css">
        <script src='../javascript/validate_form.js'></script>
    </head>
    <body>
        <?php
			include('header.php');
		?>
		<?php
			include('invalid.php');
		?>
        <h2 class="heading_common">Register Student Volunteer</h2>

        <form name="reg_volunteer" action="../php/process_registration_student_volunteer.php" onsubmit="return validateRegVolunteer()" method="post" id="login_form">
          
            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>
            
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label for="re_password"><b>Re-Enter Password</b></label>
                <input type="password" placeholder="Enter Password" name="re_password" required>

                <label for="student_vol_code"><b>Student Volunteer's Code</b></label>
                <input type="password" placeholder="Enter Volunteer Code" name="student_vol_code" required>

                <label for="roll_number"><b>Enter Roll Number</b></label>
                <input type="text" placeholder="Enter Roll Number" name="roll_number" required>

                <br><br>
                <label for="date_join"><b>Date Of Joining: </b></label>
                <input type="date" placeholder="yyyy-mm-dd" name="date_join" class="date" required>

                <br><br>
                <label for="designation"><b>Designation: </b></label>
                <select name="designation" class="drop_down">
                    <option value="student_volunteer">Student Volunteer</option>
                </select>

                <button type="submit" id="login_button">Register</button>
            </div>
            
        </form>
        <a href="../php/home.php" id="cancel_button">Cancel</a>
        <br>
        <br>
        <div class="container" style="background-color:#f1f1f1">
            <br>
            <br>
        </div>
    </body>
</html>
