<?php
    session_start();

    // Generate a random internnship id that has not been used before
    function generateJobID($db) {
        
        $str = "0123456789abcdefghijklnmopqrstuvqxyz";
        $found_a_value = false;
        $id_search_query = "SELECT job_id FROM job WHERE job_id = ?";
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
        error_log("error conn(process_company_add_job.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }

    $job_id = generateJobID($db);
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d', time());

    if($_POST['perks'] == 'Perks' || $_POST['perks'] == '')
        $perks = null;
    else
        $perks = $_POST['perks'];

    $query = "CALL add_job(?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($query);
    $stmt->bind_param(
        'sssssdsd',
        $job_id,
        $_SESSION['company_id'],
        $date,
        $_POST['name'],
        $_POST['description'],
        $_POST['CTC'],
        $perks,
        $_POST['min_cgpa']
    );

    if($stmt->execute())
    {
        header("Location: ../php/company_placed_jobs.php");
        exit('');
    }

    error_log("error conn(process_company_add_job.php):  " . $stmt->error . "\n", 3, '../log_dir/log_file');
    
?>

<html>
    <head>
        <title>Processing Add Job Request</title>
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
        <h3 id="error_heading">Something Wrong Happened</h3>';
        <a href="../php/company_add_job.php" id="back_button">Back To Job</a>
        <br><br><br>
        <div class="container" style="background-color:#f1f1f1">
            <br><br>
        </div>
    </body>
</html>