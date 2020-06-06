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
            header('Location: cdc_official_home.php');   // Redirect to cdc offical home page
    }
?>
<html>
    <head>
        <title>CDC Home Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/home_style.css">
        <link rel="stylesheet" href="../css_files/login_style.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
		<?php
			include('header.php');
		?>
        <img src="../images/iit.png" alt="cdc logo" id="img_logo">
        <h2 id="cdc_heading">Career Development Cell IIT Palakkad<br>CDC</h2>
        <div id="invalid_login">
        <?php
        	$attempt = $_SESSION["invalid_login"];
              if ($attempt != null) {
                  $invalid = "Invalid Username or Password";
                  echo $invalid;
                  $_SESSION["invalid_login"] = null;
              }
        ?>
        </div>
    </body>
</html>
