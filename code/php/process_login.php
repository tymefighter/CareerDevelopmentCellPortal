<html>
    <head>
        <title>CDC Home Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/login_style.css">
    </head>
    <body>
        <ul class="nav">
            <li class="nav"><a href='home.html' class="nav">Home</a></li>
            <li class="nav"><a href='https://iitpkd.ac.in' class="nav">IIT Palakkad</a></li>
            <li class="nav"><a href="companies.html" class="nav">Companies</a></li>
            <li class="nav"><a href="projects.html" class="nav">Projects</a></li>
            <li class="nav"><a href="research.html" class="nav">Research</a></li>
            <li class="nav"><a href="news.html" class="nav">News</a></li>
            <li class="nav"><a href="login.html" class="nav">Login</a></li>
        </ul>
        <h2 class="heading_common">Processing</h2>
        <?php
            echo '<h4>Was your username ' . $_POST['username'] . ' and password ' . $_POST['password'] . '</h4>'
        ?>
        
    </body>
</html>