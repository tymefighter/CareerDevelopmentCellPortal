<?php
    session_start();

    // Generate a random internnship id that has not been used before
    function generateInternshipID($db) {
        
        $str = "0123456789abcdefghijklnmopqrstuvqxyz";
        $found_a_value = false;
        $id_search_query = "SELECT internship_id FROM internship WHERE internship_id = ?";
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
        error_log("error conn(process_company_add_internship.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }

    $internship_id = generateInternshipID($db);
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d', time());

    $query = "CALL add_internship(?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($query);
    $stmt->bind_param(
        'sssssdid',
        $internship_id,
        $_SESSION['company_id'],
        $date,
        $_POST['name'],
        $_POST['description'],
        $_POST['stipend'],
        $_POST['duration'],
        $_POST['min_cgpa']
    );

    if($stmt->execute())
    {
        $stmt->close();

        $query = 'SELECT name FROM branch';
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->bind_result($branch_name);
        $branch_arr = array();
        while($stmt->fetch()) {
            if($_POST[$branch_name] == $branch_name)
                array_push($branch_arr, $branch_name);
        }
        $stmt->close();

        $query_insert = 'INSERT INTO required_branch_internship VALUES (?, ?)';
        $stmt_insert = $db->prepare($query_insert);
        $stmt_insert->bind_param('ss', $branch_name, $internship_id);
        foreach($branch_arr as $branch_name) {
            $stmt_insert->execute();
        }
        $stmt_insert->close();


        $query = 'SELECT year_of_admission FROM batch';
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->bind_result($batch);
        $batch_arr = array();
        while($stmt->fetch()) {
            if($_POST[$batch] == $batch)
                array_push($batch_arr, $batch);
        }
        $stmt->close();

        $query_insert = 'INSERT INTO required_batch_internship VALUES (?, ?)';
        $stmt_insert = $db->prepare($query_insert);
        $stmt_insert->bind_param('ss', $batch, $internship_id);
        foreach($batch_arr as $batch) {
            $stmt_insert->execute();
        }
        $stmt_insert->close();
        
        header("Location: ../php/company_placed_internships.php");
        exit('');
    }
?>

<html>
    <head>
        <title>Processing Add Internship Request</title>
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
        <a href="../php/company_add_internship.php" id="back_button">Back To Internships</a>
        <br><br><br>
        <div class="container" style="background-color:#f1f1f1">
            <br><br>
        </div>
    </body>
</html>