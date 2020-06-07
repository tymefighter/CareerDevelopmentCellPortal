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

<style>
    #invalid_login {
        margin-left: 300;
        margin-right: 300;
        font-size: medium;
        text-align: center;
        color: red;
    }
</style>