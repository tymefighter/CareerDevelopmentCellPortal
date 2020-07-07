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
    $_SESSION['prev_page'] = 'process_company_add_job.php';
?>

<?php

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

    // Try to establish connection to cdc database
    $db = new mysqli ($server, $user, $pass, $database);
        
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

        $query_insert = 'INSERT INTO required_branch_job VALUES (?, ?)';
        $stmt_insert = $db->prepare($query_insert);
        $stmt_insert->bind_param('ss', $branch_name, $job_id);
        foreach($branch_arr as $branch_name) {
            $stmt_insert->execute();
        }
        $stmt_insert->close();

        header("Location: ../php/company_placed_jobs.php");
        exit('');
    }

    error_log("error conn(process_company_add_job.php):  " . $stmt->error . "\n", 3, '../log_dir/log_file');
    
?>

<html>
    <head>
        <title>Processing Add Job Request</title>
        <link rel="stylesheet" href="../css_files/error.css">
    </head>
    <body>
        <?php
			include('header.php');
		?>
        <h3 id="error_heading">Something Wrong Happened</h3>';
        <a href="../php/company_add_job.php" id="back_button">Back To Job</a>
        <br><br><br>
       
        <?php
			include('invalid.php');
		?>
    </body>
</html>
