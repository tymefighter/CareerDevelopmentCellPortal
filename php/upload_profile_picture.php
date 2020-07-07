<?php
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
?>

<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('Cannot Be Accessed Without Logging In');
    }

    if($_SESSION['user_type'] != 'student') {
        exit('This webpage cannot be accessed by a ' . $_SESSION['user_type']);
    }
?>

<html>
<head>
        <title>Upload Profile Picture</title>
        <link rel="stylesheet" href="../css_files/common_home.css">
    </head>
    <body>
        <?php
			include('header.php');
		?>

        <div class="sidenav">
            <br>
            <a href="../php/student_profile.php"><> Profile</a>
            <br>
            <a href="../php/student_resume.php">My Resume</a>
            <br>
            <a href="../php/student_applications.php">Applications</a>
            <br>
            <a href="../php/student_verification.php">Verification</a>
        </div>

        <div class="main">
            <br>
            <h2>Upload Profile Picture</h2>
            <?php
                if($_SESSION['roll_number'] == null)
                    exit('Huge Error Occurred');

                $roll_number = $_SESSION['roll_number'];

                $imageFileType = strtolower(pathinfo($_FILES["profile_picture"]["name"],PATHINFO_EXTENSION));
                if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg')
                    exit('Uploaded file is not an accepted image type (jpg, png, jpeg)');

                // File Size Cannot be more than 2MB
                if ($_FILES["profile_picture"]["size"] > 2097152) {
                    exit('File Size greater than 2MB');
                }

                // We must first delete previous profile picture
                $image_extensions = array('.jpg', '.jpeg', '.png');

                foreach($image_extensions as $ext) {
                    $img_path = '../profile_images/' . $roll_number . $ext;

                    $fp = fopen($img_path, 'r');
                    if($fp == false)
                        continue;

                    $picture_is_present = true;
                    fclose($fp);

                    unlink($img_path);  // Delete the image
                    break;
                }

                if(move_uploaded_file($_FILES["profile_picture"]["tmp_name"], '../profile_images/' . $roll_number . '.' . $imageFileType) == false)
                    exit('Error in uploading picture');
            ?>

            <h3 style='color:goldenrod;'>Profile Picture has been uploaded</h3>
        </div>
   
</body>
</html> 
            
    </body>
</html>
