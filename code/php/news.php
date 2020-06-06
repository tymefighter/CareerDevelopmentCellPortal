<?php
    session_start();
    $_SESSION['prev_page'] = 'news.php';
?>
<html>
    <head>
        <title>News Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/news.css">
        <link rel="stylesheet" href="../css_files/login_style.css">
        <script src='../javascript/automate_button.js'></script>
        <script>
        	function logout_confirm() {
				if (confirm('Confirm logout ?'))
					return true;
				return false;
			}
		</script>
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
