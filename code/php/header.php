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
		      <a href = "../php/register.php" id = "reglink">Register</a>
		    </div>
		  </form>
		</div>
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

<script src='../javascript/automate_button.js'></script>
<script>
		function logout_confirm() {
			if (confirm('Confirm logout ?'))
				return true;
			return false;

			var modal = document.getElementById('id01');

			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
		}
</script>

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

	input[type=text], input[type=password] {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
	}

	button {
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		width: 100%;
	}

	button:hover {
		opacity: 0.8;
	}

	.cancelbtn {
		width: auto;
		padding: 10px 18px;
		background-color: #f44336;
	}

	.imgcontainer {
		text-align: center;
		margin: 24px 0 12px 0;
		position: relative;
	}

	img.avatar {
		width: 40%;
		border-radius: 50%;
	}

	.container {
		padding: 16px;
	}

	span.psw {
		float: right;
		padding-top: 16px;
	}

	.modal {
		display: none;
		position: fixed;
		z-index: 1;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgb(0,0,0);
		background-color: rgba(0,0,0,0.4);
		padding-top: 60px;
	}

	.modal-content {
		background-color: #fefefe;
		margin: 5% auto 15% auto;
		border: 1px solid #888;
		width: 400px;
	}

	.close {
		position: absolute;
		right: 25px;
		top: 0;
		color: #000;
		font-size: 25px;
		font-weight: bold;
	}

	.close:hover,
	.close:focus {
		color: red;
		cursor: pointer;
	}

	.animate {
		-webkit-animation: animatezoom 0.6s;
		animation: animatezoom 0.6s
	}

	@-webkit-keyframes animatezoom {
		from {-webkit-transform: scale(0)} 
		to {-webkit-transform: scale(1)}
	}
	
	@keyframes animatezoom {
		from {transform: scale(0)} 
		to {transform: scale(1)}
	}

	@media screen and (max-width: 300px) {
		span.psw {
			display: block;
			float: none;
		}
		.cancelbtn {
			width: 100%;
		}
	}
	
	ul.nav {
		margin: 0;
		padding: 0;
		background-color: #333;
		top: 0;
		position: fixed;
		width: 100%;
	}

	body {
		margin:0;
		background-color:white;
	}
	
	li.nav {
		float: left;
		border-right:1px solid goldenrod;
	}
	
	li:last-child.nav {
		border-right: none;
	}
	
	a.nav {
		display: block;
		color: gold;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
	}
	
	a:hover.nav {
		background-color: black;
	}

	h2.heading_common {
		color: goldenrod;
		text-align: center;
		margin-top: 50px;
	}

	#nav_button {
		display: none;
	}

	.cont {
		cursor: pointer;
		float: right;
		margin-right: 50;
	}
	
	.bar1, .bar2, .bar3 {
		width: 35px;
		height: 5px;
		background-color: goldenrod;
		margin: 6px 0;
		transition: 0.4s;
	}

	.change .bar1 {
		-webkit-transform: rotate(-45deg) translate(-9px, 6px);
		transform: rotate(-45deg) translate(-9px, 6px);
	}

	.change .bar2 {opacity: 0;}

	.change .bar3 {
		-webkit-transform: rotate(45deg) translate(-8px, -8px);
		transform: rotate(45deg) translate(-8px, -8px);
	}

	@media screen and (max-width: 800px) {
		
		#nav_button {
			display: block;
		}
		li.nav {
			display: none;
			float:none;
		}
		#img_logo {
			width: 50%;
			height: 200px;
		}
	}

</style>