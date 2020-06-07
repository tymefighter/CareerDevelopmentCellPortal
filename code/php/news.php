<?php
    session_start();
    $_SESSION['prev_page'] = 'news.php';
?>
<html>
    <head>
        <title>News Page</title>
        <link rel="stylesheet" href="../css_files/news.css">
    </head>
    <body>
        <?php
			include('header.php');
		?>
        <h2 class="heading_common">News</h2>
        <?php
			include('invalid.php');
		?>
    </body>
</html>
