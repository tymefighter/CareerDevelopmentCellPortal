<?php
    session_start();

    // Check if entered form values are valid or not
    function validateFormValues() {

        if(is_numeric($_POST['phone_1']) == false)
            return false;
        if(empty($_POST['phone_2']) == false && is_numeric($_POST['phone_2']) == false)
            return false;
        
        return true;
    }

    // Check if username is taken or not
    function usernameTaken($db) {
        $uname_search_qry = "SELECT username FROM login_details WHERE username = ?";
        $stmt_uname = $db->prepare($uname_search_qry);
        $stmt_uname->bind_param('s', $_POST['username']);
        $stmt_uname->execute();
        $stmt_uname->store_result();
        if($stmt_uname->num_rows != 0)
            return true;
        return false;
    }

    // Generate a random offical id that has not been used before
    function generateOfficialID($db) {
        
        $str = "0123456789abcdefghijklnmopqrstuvqxyz";
        $found_a_value = false;
        $id_search_query = "SELECT official_id FROM cdc_official WHERE official_id = ?";
        $stmt_id = $db->prepare($id_search_query);
        $id = '';
        $stmt_id->bind_param('s', $id);

        while($found_a_value == false) {
            $id = str_shuffle($str).substr(0, 9);
            $stmt_id->execute();
            $stmt_id->store_result();
            if($stmt_id->num_rows == 0)
                $found_a_value = true;
        }

        return $id;
    }

    // Try to establish connection to cdc database via tymefighter@localhost user
    $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
        
    // Connection error, hence place error in log file
    $error_num = mysqli_connect_errno();
    if($error_num) {
        error_log("error conn(process_registeration.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }

    $is_username_taken = false;

    if(validateFormValues() == true) {

        $is_username_taken = usernameTaken($db);
        if($is_username_taken == false) {

            $offical_id = generateOfficialID($db);

            $query = "CALL register_cdc_offical(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $db->prepare($query);

            if($_POST['phone_2'] == '')
                $phone_2 = null;
            else
                $phone_2 = $_POST['phone_2'];

            $stmt->bind_param(
                'ssssssssss', 
                $_POST['username'], 
                $_POST['password'],
                $offical_id,
                $_POST['name'],
                $_POST['designation'],
                $_POST['email'],
                $_POST['phone_1'],
                $phone_2,
                $_POST['bldg_name'],
                $_POST['room_number']
            );

            if($stmt->execute())
            {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['user_type'] = 'cdc_official';
                $_SESSION['logged_in'] = true;
                header("Location: ../php/cdc_official_home.php");
                exit('');
            }

            error_log("error conn(process_registration_cdc_offical.php):  " . $stmt->error . "\n", 3, '../log_dir/log_file');
        }
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
        <?php
            if($is_username_taken == false)
                echo '<h3 id="error_heading">Data Entered is in Incorrect Format</h3>';
            else
                echo '<h3 id="error_heading">Username Already Taken</h3>';
        ?>
        <a href="../php/register.php" id="back_button">Back To Registeration</a>
        <br><br><br>
        <div class="container" style="background-color:#f1f1f1">
            <br><br>
        </div>
    </body>
</html>