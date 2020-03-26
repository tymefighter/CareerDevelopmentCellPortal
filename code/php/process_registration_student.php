<?php
    session_start();

    function validateFormValues() {
        if(is_numeric($_POST['roll_number']) == false)
            return false;
        if(is_numeric($_POST['pincode']) == false)
            return false;
        if(is_numeric($_POST['phone_1']) == false)
            return false;
        if(empty($_POST['phone_2']) == false && is_numeric($_POST['phone_2']) == false)
            return false;
        
        $date_regex = '/([12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01]))/';

        if(preg_match($date_regex, $_POST['dob']) == false)
            return false;

        return true;
    }

    if(validateFormValues() == true)
    {

        // Try to establish connection to cdc database via tymefighter@localhost user
        $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
        
        // Connection error, hence place error in log file
        $error_num = mysqli_connect_errno();
        if($error_num) {
            error_log("error conn(process_registeration.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
            exit('');
        }

        $query = "CALL register_student(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($query);
        $stmt->bind_param(
            'sssssssdsdsiissssssss', 
            $_POST['username'], 
            $_POST['password'],
            $_POST['roll_number'],
            $_POST['name'],
            $_POST['nationality'],
            $_POST['dob'],
            $_POST['gender'],
            $_POST['tenth_percentage'],
            $_POST['tenth_board'],
            $_POST['twelfth_percentage'],
            $_POST['twelfth_board'],
            $_POST['JEE_main_rank'],
            $_POST['JEE_advanced_rank'],
            $_POST['bldg_name'],
            $_POST['street_name'],
            $_POST['city'],
            $_POST['state'],
            $_POST['country'],
            $_POST['pincode'],
            $_POST['phone_1'],
            $_POST['phone_2']
        );

        if($stmt->execute())
        {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['user_type'] = $_POST['user_type'];
            $_SESSION['logged_in'] = true;
            header("Location: ../php/student_home.php");
            exit('');
        }

        error_log("error conn(process_registeration.php):  " . $stmt->error . "\n", 3, '../log_dir/log_file');
    }
?>

<html>
    <head>
        <title>Processing Registration</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/error.css">
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
        <h3 id="error_heading">Some Error Occurred In Registration</h3>
        <a href="../php/register.php" id="back_button">Back To Registeration</a>
        <br><br><br>
        <div class="container" style="background-color:#f1f1f1">
            <br><br>
        </div>
    </body>
</html>