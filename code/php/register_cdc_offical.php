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
?>
<html>
    <head>
        <title>Register CDC Official</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/register_common.css">
        <script src='../javascript/automate_button.js'></script>
        <script src='../javascript/validate_form.js'></script>
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
        <h2 class="heading_common">Register CDC Offical</h2>

        <form name="reg_student" action="../php/process_registration_cdc_offical.php" onsubmit="return validateRegStudent()" method="post" id="login_form">
          
            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>
            
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label for="re_password"><b>Re-Enter Password</b></label>
                <input type="password" placeholder="Enter Password" name="re_password" required>

                <label for="cdc_offical_code"><b>Enter CDC Offical's Code</b></label>
                <input type="password" placeholder="Enter Student Code" name="cdc_offical_code" required>

                <label for="name"><b>Enter Full Name</b></label>
                <input type="text" placeholder="Enter Full Name" name="name" required>

                <br><br>
                <label for="designation"><b>Designation: </b></label>
                <select name="designation" class="drop_down">
                    <option value="TPO">TPO</option>
                    <option value="Faculty">Faculty</option>
                </select>

                <br><br>
                <label for="email"><b>Email Id</b></label>
                <input type="email" class="email" placeholder="Enter Email Id" name="email"  required>
                
                <label for="phone_1"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter Phone Number" name="phone_1" required>

                <label for="phone_2"><b>Alternate Phone Number</b></label>
                <input type="text" placeholder="You May Enter An Alternate Phone Number" name="phone_2" required>

                <label for="bldg_name"><b>Institute Building Name</b></label>
                <input type="text" placeholder="Enter Institute Building Name" name="bldg_name" required>

                <label for="room_number"><b>Institute Room Number</b></label>
                <input type="text" placeholder="Enter Institute Room Number" name="room_number" required>

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