	<ul class="nav">
	<li class="nav"><a href='../php/home.php' class="nav">Home</a></li>
	<li class="nav"><a href='https://iitpkd.ac.in' class="nav">IIT Palakkad</a></li>
	<li class="nav"><a href="../php/companies.php" class="nav">Companies</a></li>
	<li class="nav"><a href="../php/projects.php" class="nav">Projects</a></li>
	<li class="nav"><a href="../php/research.php" class="nav">Research</a></li>
	<li class="nav"><a href="../php/news.php" class="nav">News</a></li>
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
		      <!--<span class="psw">Forgot <a href="#">password?</a></span>-->
		     	<style>
		      		#reglink {
		      			background-color: DodgerBlue;
  						border: none;
  						color: white;
  						width: auto;
  						margin-top: 8px;
  						padding: 10px 18px;
  						float: right;
  						text-decoration:none;
  						cursor: pointer;
		      		}
		      		#reglink:hover {
  						background-color: RoyalBlue;
					}
				</style>
		      <a href = "../php/register.php" id = "reglink">Register</a>
		    </div>
		  </form>
		</div>
	<script>
		function logout_confirm() {
			if (confirm('Confirm logout ?'))
				return true;
		return false;
		// Get the modal
		var modal = document.getElementById('id01');

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal.style.display = "none";
		    }
		}
	}
	</script>
    <?php
          if($_SESSION['logged_in'] != null && $_SESSION['logged_in'] == true) {
              echo '<li class="nav"><a href="../php/logout.php" class="nav" onclick="return logout_confirm();">Logout</a></li>';
          }
          else {
              echo '<li class="nav"><a href="#" class="nav" onclick="document.getElementById(\'id01\').style.display=\'block\'" style="width:auto;">Login</a></li>';
              echo '<li class="nav"><a href="../php/register.php" class="nav">Register</a></li>';
          }
    ?>
	<li id="nav_button">
	<div class="cont" onclick="clickMenuButton(this)">
	<div class="bar1"></div>
	<div class="bar2"></div>
	<div class="bar3"></div>
	</div>
	</li>
	</ul>
