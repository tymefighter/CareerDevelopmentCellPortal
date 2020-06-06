<?php
    session_start();
    $_SESSION['prev_page'] = 'companies.php';
?>
<html>
    <head>
        <title>Companies</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/companies.css">
        <script src='../javascript/automate_button.js'></script>
        <link rel="stylesheet" href="../css_files/login_style.css">
    </head>
    <body>
        <?php
			include('header.php');
		?>
        <h2 class="heading_common">Companies</h2>
        <img src="../images/hoogle.jpg" alt="Hoogle" style="width: 25%;height: 200px">
        <img src="../images/soil.jpg" alt="Soil Company" style="width: 25%;height: 200px">
        <img src="../images/fbook.png" alt="Friendsbook" style="width: 25%;height: 200px">
        <?php
			include('invalid.php');
		?>
    </body>
</html>
