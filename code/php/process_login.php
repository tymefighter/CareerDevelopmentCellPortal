<?php
    session_start();

    $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
    
    if($con->connect_errno) {
        error_log("error conn(process_login.php):  " . $con->connect_errno . "\n", 3, '../log_dir/log_file');
        exit('');
    }
?>

<html>
<head>
        <title>CDC Home Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/companies.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
        <ul class="nav">
            <li class="nav"><a href='home.html' class="nav">Home</a></li>
            <li class="nav"><a href='https://iitpkd.ac.in' class="nav">IIT Palakkad</a></li>
            <li class="nav"><a href="companies.html" class="nav">Companies</a></li>
            <li class="nav"><a href="projects.html" class="nav">Projects</a></li>
            <li class="nav"><a href="research.html" class="nav">Research</a></li>
            <li class="nav"><a href="news.html" class="nav">News</a></li>
            <li class="nav"><a href="../php/login.php" class="nav">Login</a></li>
            <li class="nav"><a href="../php/register.php" class="nav">Register</a></li>
            <li id="nav_button">
                <div class="cont" onclick="clickMenuButton(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </li>
        </ul>
        <h2 class="heading_common">Processing</h2>

        <?php
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT user_type FROM login_details WHERE username = ? AND password = ?";

            $stmt = $db->prepare($query);
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();

            $stmt->store_result();
            if($stmt->num_rows == 0) {

                if($_SESSION['invalid_login'] == null)
                    $_SESSION['invalid_login'] = 1;
                else
                    $_SESSION['invalid_login'] = $_SESSION['invalid_login'] + 1;
            
                header('Location: login.php');              // Redirect to login page
                exit('');
            }
            else
                $_SESSION['invalid_login'] = 0;             // Valid login, hence set count to 0

            $stmt->bind_result($user_type);
            $stmt->fetch();

            // Save these values as they would be used later
            $_SESSION['user_type'] = $user_type;
            $_SESSION['username'] = $username;

            if($user_type == 'student')
                header('Location: student_home.php');
            else if($user_type == 'student_vol')
                header('Location: student_vol_home.php');
            else if($user_type == 'company')
                header('Location: company_home.php');
            else
                header('Location: cdc_offical_home.php');
        ?>
    </body>
</html>