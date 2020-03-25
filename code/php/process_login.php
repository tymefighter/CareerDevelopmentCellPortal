<?php
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
        <link rel="stylesheet" href="../css_files/login_style.css">
    </head>
    <body>
        <ul class="nav">
            <li class="nav"><a href='../html/home.html' class="nav">Home</a></li>
            <li class="nav"><a href='../html/https://iitpkd.ac.in' class="nav">IIT Palakkad</a></li>
            <li class="nav"><a href="../html/companies.html" class="nav">Companies</a></li>
            <li class="nav"><a href="../html/projects.html" class="nav">Projects</a></li>
            <li class="nav"><a href="../html/research.html" class="nav">Research</a></li>
            <li class="nav"><a href="../html/news.html" class="nav">News</a></li>
            <li class="nav"><a href="../html/login.html" class="nav">Login</a></li>
        </ul>
        <h2 class="heading_common">Processing</h2>

        <?php
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT user_type, username, password FROM login_details WHERE username = ? AND password = ?";

            $stmt = $db->prepare($query);
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();

            $stmt->store_result();
            if($stmt->num_rows == 0) {
                exit('Invalid username or password');
            }

            $stmt->bind_result($user_type, $un, $ps);
            $stmt->fetch();

            // Save these values as they would be used later
            $_SESSION['user_type'] = $user_type;
            $_SESSION['username'] = $username; 

            if($user_type == 'student')
                header('Location: student.php');
            else if($user_type == 'student_vol')
                header('Location: student_vol.php');
            else if($user_type == 'company')
                header('Location: company.php');
            else
                header('Location: cdc_offical.php');
        ?>
    </body>
</html>