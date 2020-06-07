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
    $_SESSION['prev_page'] = 'register.php';
?>
<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="../css_files/register.css">
    </head>
    <body>
       <?php
			include('header.php');
		?>
        <h2 class="heading_common">Register</h2>

        <a href='../php/register_student.php' class='select_user_type' id='first_one'>Student</a>
        <a href='../php/register_company.php' class='select_user_type'>Company</a>
        <a href='../php/register_student_vol.php' class='select_user_type'>Student Volunteer</a>
        <a href='../php/register_cdc_offical.php' class='select_user_type'>CDC Official</a>
        <?php
			include('invalid.php');
		?>
    </body>
</html>
