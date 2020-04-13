<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'company') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }

    // Try to establish connection to cdc database via tymefighter@localhost user
    $db = new mysqli ('localhost', 'tymefighter', 'tymefighter', 'cdc');
                    
    // Connection error, hence place error in log file
    $error_num = mysqli_connect_errno();
    if($error_num) {
        error_log("error conn(internship_detail.php):  " . $error_num . "\n", 3, '../log_dir/log_file');
        exit('');
    }

    if($_SESSION['company_id'] == null)
        exit('Huge Error Occurred');

    $query = 'select i.internship_id from internship as i, placed_internship as p_i where i.internship_id = ? and p_i.company_id = ? and i.internship_id = p_i.internship_id';
    $stmt = $db->prepare($query);
    $stmt->bind_param('ss', $_GET['internship_id'], $_SESSION['company_id']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows == 0) {
        exit('Huge Error Occurred');
    }

    $_SESSION['internship_id'] = $_GET['internship_id'];
?>

<html>
<head>
        <title>Internship Details - Company</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/common_home.css">
        <link rel="stylesheet" href="../css_files/internship_detail.css">
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

        <div class="sidenav">
            <br>
            <a href="../php/company_profile.php"><> Profile</a>
            <br>
            <a href="../php/company_placed_internships.php">Placed Internships</a>
            <br>
            <a href="../php/company_placed_jobs.php">Placed Jobs</a>
        </div>

        <div class="main">
            
            <?php
                $query = 'call get_internship_details(?)';
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $_SESSION['internship_id']);
                $stmt->execute();
                $stmt->store_result();

                if($stmt->num_rows == 0) {
                    exit('Huge Error Occurred');
                }

                $stmt->bind_result(
                    $internship_id, $internship_name, $company_name,
                    $description, $stipend, $duration, $min_cgpa, $date
                );

                $stmt->fetch();
            ?>

            <br><br>
            <table>
            <tr>
                <th>Internship Id</th>
                <td><?php echo $internship_id; ?></td>
            </tr>
            <tr>
                <th>Internship Name</th>
                <td><?php echo $internship_name; ?></td>
            </tr>
            <tr>
                <th>Company Name</th>
                <td><?php echo $company_name; ?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?php echo $description; ?></td>
            </tr>
            <tr>
                <th>Stipend</th>
                <td><?php echo $stipend; ?></td>
            </tr>
            <tr>
                <th>Duration</th>
                <td><?php echo $duration; ?></td>
            </tr>
            <tr>
                <th>Min CGPA</th>
                <td><?php echo $min_cgpa; ?></td>
            </tr>
            <tr>
                <th>Date Of Placing</th>
                <td><?php echo $date; ?></td>
            </tr>
            </table>

        </div>
   
</body>
</html> 
            
    </body>
</html>