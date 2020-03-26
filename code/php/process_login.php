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

        if($user_type == 'student')
            header('Location: student_home.php');       // Redirect to student home page
        else if($user_type == 'student_vol')
            header('Location: student_vol_home.php');   // Redirect to student volunteer home page
        else if($user_type == 'company')
            header('Location: company_home.php');       // Redirect to company home page
        else
            header('Location: cdc_offical_home.php');   // Redirect to cdc offical home page

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
        <title>Registration Processing</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/error.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
        <ul class="nav">
            <li class="nav"><a href='../html/home.html' class="nav">Home</a></li>
            <li class="nav"><a href='https://iitpkd.ac.in' class="nav">IIT Palakkad</a></li>
            <li class="nav"><a href="../html/companies.html" class="nav">Companies</a></li>
            <li class="nav"><a href="../html/projects.html" class="nav">Projects</a></li>
            <li class="nav"><a href="../html/research.html" class="nav">Research</a></li>
            <li class="nav"><a href="../html/news.html" class="nav">News</a></li>
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
        <h3 id="error_heading">Invalid Username or Password</h3>
        <a href="login.php" id="back_button">Back To Login Page</a>
        <br><br><br>
        <div class="container" style="background-color:#f1f1f1">
            <br><br>
        </div>
    </body>
</html>