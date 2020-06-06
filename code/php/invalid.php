<div id="invalid_login">
	<?php
      	$attempt = $_SESSION["invalid_login"];
        if ($attempt != null) {
            $invalid = "Invalid Username or Password";
            echo $invalid;
            $_SESSION["invalid_login"] = null;
        }
     ?>
</div>
