<?php
    session_start();
    $_SESSION['prev_page'] = 'projects.php';
?>
<html>
    <head>
        <title>Projects Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/projects.css">
        <link rel="stylesheet" href="../css_files/login_style.css">
        <script src='../javascript/automate_button.js'></script>
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
