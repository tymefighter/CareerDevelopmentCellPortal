<?php
    session_start();
    if ($_SESSION['login_info'] == null) {
		$line = file_get_contents("../login_info.txt") or die("Unable to open file!");
		$lines = explode("\n", $line);
		if (count($lines) < 4)
	   		die("Some login information are missing!");
       	$_SESSION['server']   = $lines[0];
       	$_SESSION['user']     = $lines[1];
       	$_SESSION['pass']     = $lines[2];
       	$_SESSION['database'] = $lines[3];
       	$_SESSION['login_info'] = TRUE;
    }
    
    $server	= $_SESSION['server'];
    $user	= $_SESSION['user'];
    $pass	= $_SESSION['pass'];
    $database	= $_SESSION['database'];
    $_SESSION['prev_page'] = 'process_registration_company.php';
?>

<?php

    // Check if entered form values are valid or not
    function validateFormValues() {

        if(is_numeric($_POST['phone_1']) == false)
            return false;
        if(empty($_POST['phone_2']) == false && is_numeric($_POST['phone_2']) == false)
            return false;
        if(is_numeric($_POST['hq_pincode']) == false)
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
    function generateCompanyID($db) {
        
        $str = "0123456789abcdefghijklnmopqrstuvqxyz";
        $found_a_value = false;
        $id_search_query = "SELECT company_id FROM company WHERE company_id = ?";
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

    // Try to establish connection to cdc database
    $db = new mysqli ($server, $user, $pass, $database);
        
    // Connection error, hence place error in log file
    $error_num = mysqli_connect_errno();
    if($error_num) {
        error_log("error conn(process_registeration_company.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }

    $is_username_taken = false;

    if(validateFormValues() == true) {

        $is_username_taken = usernameTaken($db);
        if($is_username_taken == false) {

            $company_id = generateCompanyID($db);

            $query = "CALL register_company(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if($_POST['email_id_2'] == '')
                $email_id_2 = null;
            else
                $email_id_2 = $_POST['email_id_2'];

            if($_POST['phone_2'] == '')
                $phone_2 = null;
            else
                $phone_2 = $_POST['phone_2'];

            $stmt = $db->prepare($query);
            $stmt->bind_param(
                'ssssssssissssssss',
                $_POST['username'],
                $_POST['password'],
                $company_id,
                $_POST['name'],
                $_POST['email_id_1'],
                $email_id_2,
                $_POST['phone_1'],
                $phone_2,
                $_POST['is_startup'],
                $_POST['company_overview'],
                $_POST['hq_bldg_name'],
                $_POST['hq_street_name'],
                $_POST['hq_city'],
                $_POST['hq_state'],
                $_POST['hq_country'],
                $_POST['hq_pincode'],
                $_POST['company_website']
            );

            if($stmt->execute())
            {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['user_type'] = 'company';
                $_SESSION['logged_in'] = true;
                $_SESSION['company_id'] = $company_id;
                header("Location: ../php/company_home.php");
                exit('');
            }

            error_log("error conn(process_registration_company.php):  " . $stmt->error . "\n", 3, '../log_dir/log_file');
        }
    }
    
?>

<html>
    <head>
        <title>Processing Registration</title>
        <link rel="stylesheet" href="../css_files/error.css">
    </head>
    <body>
       <?php
			include('header.php');
		?>
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
        <?php
			include('invalid.php');
		?>
    </body>
</html>
