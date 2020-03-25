<?php
    session_start();
?>
<html>
    <head>
        <title>CDC Home Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/register.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
        <ul class="nav">
            <li class="nav"><a href='home.html' class="nav">Home</a></li>
            <li class="nav"><a href='https://iitpkd.ac.in' class="nav">IIT Palakkad</a></li>
            <li class="nav"><a href="companies.html" class="nav">Companies</a></li>
            <li class="nav"><a href="projects.html" class="nav">Projects</a></li>
            <li class="nav"><a href="research.html" class="nav">Research</a></li>
            <li class="nav"><a href="news.html" class="nav">News</a></li>
            <li class="nav"><a href="../php/login.php" class="nav">Login</a></li>
            <li class="nav"><a href="../php/register.php" class="nav">Register</a></li>
            <li id="nav_button">
                <div class="cont" onclick="clickMenuButton(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </li>
        </ul>
        <h2 class="heading_common">Register</h2>

        <a href='../php/register_student.php' class='select_user_type' id='first_one'>Student</a>
        <a href='../php/register_company.php' class='select_user_type'>Company</a>
        <a href='../php/register_student_vol.php' class='select_user_type'>Student Volunteer</a>
        <a href='../php/register_cdc_offical.php' class='select_user_type'>CDC Official</a>
    </body>
</html>