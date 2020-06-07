<?php
    session_start();
    $_SESSION['prev_page'] = 'projects.php';
?>
<html>
    <head>
        <title>Projects Page</title>
        <link rel="stylesheet" href="../css_files/projects.css">
    </head>
    <body>
        <?php
			include('header.php');
		?>
        <h2 class="heading_common">Projects</h2>
        <?php
			include('invalid.php');
		?>
    </body>
</html>
