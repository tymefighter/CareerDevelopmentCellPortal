<?php
    // Some Helper Functions

    function getRollNumber($db, $username) {
        $query = "SELECT roll_number FROM student_login WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows == 0) {
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
            exit('Huge Error Occurred');
        }

        $stmt->bind_result($official_id);
        $stmt->fetch();

        return $official_id;
    }

?>

<?php

    session_start();
    // Try to establish connection to cdc database via mustang28@localhost user
    $db = new mysqli ('localhost', 'mustang28', 'mustang28', 'cdc');
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
    
        $_SESSION['invalid_login'] = 0; // Valid login, hence set count to 0            

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
    if($_SESSION['invalid_login'] == null)
        $_SESSION['invalid_login'] = 1;
    else
        $_SESSION['invalid_login'] = $_SESSION['invalid_login'] + 1;

    // Now, we move back to login page
    die(header("location:login.php"));
?>