<?php
    session_start();
    if ($_SESSION['login_info'] == null) {
		$line = file_get_contents("../important_text/login_info.txt") or die("Unable to open file!");
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
    $_SESSION['prev_page'] = 'process_registration_student_volunteer.php';
?>

<?php

    // Check if entered form values are valid or not
    function validateFormValues() {
        if(is_numeric($_POST['roll_number']) == false)
            return false;
        
        $date_regex = '/([12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01]))/';

        if(preg_match($date_regex, $_POST['date_join']) == false)
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

    function isRollNumberPresent($db) {
        $qry = "SELECT roll_number FROM student WHERE roll_number = ?";
        $stmt = $db->prepare($qry);
        $stmt->bind_param('s', $_POST['roll_number']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows == 0)
            return false;
        return true;
    }

    // Generate a random offical id that has not been used before
    function generateVolID($db) {
        
        $str = "0123456789abcdefghijklnmopqrstuvqxyz";
        $found_a_value = false;
        $id_search_query = "SELECT vol_id FROM student_vol WHERE vol_id = ?";
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
        error_log("error conn(process_registeration_student_volunteer.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }

    $is_username_taken = false;
    $is_roll_num_present = true;

    if(validateFormValues() == true) {

        $is_username_taken = usernameTaken($db);
        if($is_username_taken == false)
            $is_roll_num_present = isRollNumberPresent($db);

        if($is_username_taken == false && $is_roll_num_present == true) {

            $vol_id = generateVolID($db);

            $query = "CALL register_student_vol(?, ?, ?, ?, ?, ?)";

            $stmt = $db->prepare($query);
            $stmt->bind_param(
                'ssssss', 
                $_POST['username'], 
                $_POST['password'],
                $_POST['roll_number'],
                $_POST['date_join'],
                $vol_id,
                $_POST['designation']
            );

            if($stmt->execute())
            {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['user_type'] = 'student_vol';
                $_SESSION['logged_in'] = true;
                $_SESSION['vol_id'] = $vol_id;
                header("Location: ../php/student_vol_home.php");
                exit('');
            }

            error_log("error conn(process_registration_student_volunteer.php):  " . $stmt->error . "\n", 3, '../log_dir/log_file');
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
			include('invalid.php');
		?>
        <?php
            if($is_username_taken == false) {
                if($is_roll_num_present == false)
                    echo '<h3 id="error_heading">Roll Number does not correspond to a registered student</h3>';
                else
                    echo '<h3 id="error_heading">Data Entered is in Incorrect Format</h3>';
            }
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
