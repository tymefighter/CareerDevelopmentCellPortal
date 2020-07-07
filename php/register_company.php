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
    $_SESSION['prev_page'] = 'register_company.php';
?>
<html>
    <head>
        <title>Register Company</title>
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
        <h2 class="heading_common">Register Company</h2>

        <form name="reg_company" action="../php/process_registration_company.php" onsubmit="return validateRegCompany()" method="post" id="login_form">
          
            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>
            
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label for="re_password"><b>Re-Enter Password</b></label>
                <input type="password" placeholder="Enter Password" name="re_password" required>

                <label for="name"><b>Company Name</b></label>
                <input type="text" placeholder="Enter Company's Name" name="name" required>

                <br><br>
                <label for="email_id_1"><b>Email Id</b></label>
                <input type="email" class="email" placeholder="Enter an Email Id" name="email_id_1"  required>

                <br>
                <label for="email_id_2"><b>Alternate Email Id</b></label>
                <input type="email" class="email" placeholder="Enter Alternate Email Id" name="email_id_2">

                <label for="phone_1"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter Phone Number" name="phone_1" required>

                <label for="phone_2"><b>Alternate Phone Number</b></label>
                <input type="text" placeholder="You May Enter An Alternate Phone Number" name="phone_2">

                <br><br>
                <label for="is_startup"><b>Startup ? </b></label>
                <select name="is_startup" class="drop_down">
                    <option value=0>not a startup</option>
                    <option value=1>startup</option>
                </select>

                <label for="company_overview"><b>Company Overview:</b></label>
                <textarea class="txtArea" rows="10" cols="50" name="company_overview" form="login_form">Write Company Overview Here</textarea>

                <br><br>
                <label for="hq_bldg_name"><b>Building Name of Headquarters</b></label>
                <input type="text" placeholder="Enter Building Name of Headquarters" name="hq_bldg_name" required>

                <label for="hq_street_name"><b>Street Name of Headquarters</b></label>
                <input type="text" placeholder="Enter Street of HeadQuarters" name="hq_street_name" required>

                <label for="hq_city"><b>City of Headquaters</b></label>
                <input type="text" placeholder="Enter City of Headquaters" name="hq_city" required>

                <label for="hq_state"><b>State of Headquarters</b></label>
                <input type="text" placeholder="Enter State of Headquarters" name="hq_state" required>

                <label for="hq_country"><b>Country of Headquarters</b></label>
                <input type="text" placeholder="Enter Country of Headquarters" name="hq_country" required>

                <label for="hq_pincode"><b>Pincode of Headquarters</b></label>
                <input type="text" placeholder="Enter Pincode of Headquarters" name="hq_pincode" required>

                <label for="company_website"><b>Company Website</b></label>
                <input type="text" placeholder="Enter Link of Company Website" name="company_website" required>

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
