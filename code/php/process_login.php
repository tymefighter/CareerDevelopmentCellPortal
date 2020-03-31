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

    // Try to establish connection to cdc database via tymefighter@localhost user
    $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
    
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

    // Now, we display the page with an error message
?>

<html>
    <head>
        <title>Processing Login</title>
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
        <h3 id="error_heading">Invalid Username or Password</h3>
        <a href="login.php" id="back_button">Back To Login Page</a>
        <br><br><br>
        <div class="container" style="background-color:#f1f1f1">
            <br><br>
        </div>
    </body>
</html>