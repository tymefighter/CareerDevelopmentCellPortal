<?php
    // Some Helper Functions

    function getRollNumber($db, $username) {
        $query = "SELECT roll_number FROM student_login WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows == 0) {
            $_SESSION['logged_in'] = false;
            exit('Huge Error Occurred');
        }

        $stmt->bind_result($roll_number);
        $stmt->fetch();

        return $roll_number;
    }

    function getVolunteerId($db, $username) {
        $query = "SELECT vol_id FROM volunteer_login WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows == 0) {
            $_SESSION['logged_in'] = false;
            exit('Huge Error Occurred');
        }

        $stmt->bind_result($vol_id);
        $stmt->fetch();

        return $vol_id;
    }

    function getCompanyId($db, $username) {
        $query = "SELECT company_id FROM company_login WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows == 0) {
            $_SESSION['logged_in'] = false;
            exit('Huge Error Occurred');
        }

        $stmt->bind_result($company_id);
        $stmt->fetch();

        return $company_id;
    }

    function getOfficialId($db, $username) {
        $query = "SELECT official_id FROM official_login WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows == 0) {
            $_SESSION['logged_in'] = false;
            exit('Huge Error Occurred');
        }

        $stmt->bind_result($official_id);
        $stmt->fetch();

        return $official_id;
    }

?>

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
?>

<?php
    
    // Try to establish connection to cdc database
    $db = new mysqli ($server, $user, $pass, $database);
    // Connection error, hence place error in log file
    $error_num = mysqli_connect_errno();
    if($error_num) {
        error_log("error conn(process_login.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT user_type FROM login_details WHERE username = ? AND password = SHA(?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->store_result();
    // Valid Login
    if($stmt->num_rows != 0) {
    
        $_SESSION['invalid_attempt'] = 0; // Valid login, hence set count to 0
        $_SESSION['invalid_login'] = FALSE;

        $stmt->bind_result($user_type);
        $stmt->fetch();

        // Save these values as they would be used later
        $_SESSION['user_type'] = $user_type;
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;

        if($user_type == 'student') {
            $_SESSION['roll_number'] = getRollNumber($db, $_SESSION['username']);
            header('Location: student_home.php');       // Redirect to student home page
        }
        else if($user_type == 'student_vol') {
            $_SESSION['vol_id'] = getVolunteerId($db, $_SESSION['username']);
            header('Location: student_vol_home.php');   // Redirect to student volunteer home page
        }
        else if($user_type == 'company') {
            $_SESSION['company_id'] = getCompanyId($db, $_SESSION['username']);
            header('Location: company_home.php');       // Redirect to company home page
        }
        else {
            $_SESSION['official_id'] = getOfficialId($db, $_SESSION['username']);
            header('Location: cdc_official_home.php');   // Redirect to cdc offical home page
        }

        exit('');
    }

    // The following variable stores the number of invalid logins
    // made by the user
    $_SESSION['invalid_login'] = TRUE;
    if($_SESSION['invalid_attempt'] == null)
        $_SESSION['invalid_attempt'] = 1;
    else
        $_SESSION['invalid_attempt'] = $_SESSION['invalid_attempt'] + 1;

	//$_SESSION['prev_page'] = 'home.php';
    // Now, we move back to home page
    die(header("location:".$_SESSION['prev_page']));
?>
