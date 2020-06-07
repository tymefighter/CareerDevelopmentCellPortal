<?php
    session_start();
    $_SESSION['prev_page'] = 'research.php';
?>
<html>
    <head>
        <title>Research Page</title>
        <link rel="stylesheet" href="../css_files/research.css">
    </head>
    <body>
        <?php
			include('header.php');
		?>
        <h2 class="heading_common">Research</h2>
        <?php
			include('invalid.php');
		?>
    </body>
</html>
