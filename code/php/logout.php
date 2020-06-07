<?php
    session_start();
    if($_SESSION['logged_in'] == null || $_SESSION['logged_in'] == false) {
        exit('This Page cannot be accessed without logging in');
    }
    session_destroy();
    die(header("location:home.php"));

    if($_SESSION['logged_in'] != null && $_SESSION['logged_in'] == true) {
        echo '<li class="nav"><a href="../php/logout.php" class="nav">Logout</a></li>';
    }
    else {
        echo '<li class="nav"><a href="../php/login.php" class="nav">Login</a></li>';
        echo '<li class="nav"><a href="../php/register.php" class="nav">Register</a></li>';
    }
?>