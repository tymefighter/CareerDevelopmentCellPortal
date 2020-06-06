<?php
    session_start();
    if($_SESSION['logged_in'] != null && $_SESSION['logged_in'] == true) {

        $user_type = $_SESSION['user_type'];

        if($user_type == 'student')
            header('Location: student_home.php');       // Redirect to student home page
        else if($user_type == 'student_vol')
            header('Location: student_vol_home.php');   // Redirect to student volunteer home page
        else if($user_type == 'company')
            header('Location: company_home.php');       // Redirect to company home page
        else
            header('Location: cdc_official_home.php');   // Redirect to cdc offical home page
    }
?>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/login_style.css">
        <script src='../javascript/automate_button.js'></script>
    </head>
    <body>
        <ul class="nav">
        <h2 class="heading_common">Login</h2>

        <form action="../php/process_login.php" method="post" id="login_form">
          
            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username"
	                required="" oninvalid="this.setCustomValidity('Username is Required')"
	                oninput="setCustomValidity('')">
          
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password"
	                required="" oninvalid="this.setCustomValidity('Please enter your password')"
	                oninput="setCustomValidity('')">
                  
                <button type="submit" id="login_button">Login</button>
                <?php
                    $attempt = $_SESSION["invalid_login"];
                    if ($attempt != null) {
                        $invalid = "Invalid Username or Password";
                        echo $invalid;
                        $_SESSION["invalid_login"] = null;
                    }
                ?>
            </div>
            
        </form>
        <a href="../php/home.php" id="cancel_button">Cancel</a>
        <br><br><br>
        <a href="../php/register.php" id="register_button">Register ?</a>
        <br><br>
        <div class="container" style="background-color:#f1f1f1">
            <br><br>
        </div>
        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="../php/process_login.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="../images/avatar.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="username"><b>Username</b></label>
            	<input type="text" placeholder="Enter Username" name="username"
	                required="" oninvalid="this.setCustomValidity('Username is Required')"
	                oninput="setCustomValidity('')">

      <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password"
	                required="" oninvalid="this.setCustomValidity('Please enter your password')"
	                oninput="setCustomValidity('')">
        
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

    </body>
</html>
