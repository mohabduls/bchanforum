<?php
include("_header.php");

?>
<div class="d-flex justify-content-center bg-light text-dark">
	<div class="jumbotron jumbotron-fluid bg-light p-2 mb-2 mt-2">
        <?php
        if(isset($_GET['admin']))
        {
            $bchan_action = $_GET['admin'];
            if($bchan_action == "logout")
            {
                session_destroy();
                ?>
                You are loged out, This page will redirect to homepage in 3 second.
                <?php
                header("Refresh: 3; URL=/login");
            }
        }
        else
        {
            if(!empty($_SESSION['bchan_administrator_mode']))
            {
                header("Location: /");
            }
            else
            {
                if(isset($_POST['login']))
                {
                    $bchan_captcha = $_SESSION['bchan_captcha'];
                    if($_POST['log_captcha'] == $bchan_captcha)
                    {
                        $login_email = $utils->realString($conn, $_POST['login_email']);
                        $l_pass = $utils->realString($conn, $_POST['login_password']);
                        $login_password = md5($l_pass);

                        $sql_check_user = "SELECT * FROM bchan_administrator WHERE bchan_admin_email='$login_email' AND bchan_admin_password='$login_password'";
                        $check_user = $bchan_class->q($conn, $sql_check_user);
                        $fetch_user = mysqli_fetch_assoc($check_user);
                        $user_email = $fetch_user['bchan_admin_email'];
                        $user_pass = $fetch_user['bchan_admin_password'];
                        $bchan_username = $fetch_user['bchan_admin_name'];
                        if($login_email == $user_email && $login_password == $user_pass)
                        {
                            $_SESSION['bchan_administrator_mode'] = true;
                            session_regenerate_id(true);
                            header("Refresh: 1; URL=/");
                            ?>
                            <div class="p-1">
                                <h5 class="text-dark">Hi <?php echo $bchan_username; ?></h5>
                                <h4 class="text-dark bchan-font-header">You are logged in as Administrator, please wait , you will be redirecting to home.</h4>
                                <div class="spinner-grow text-secondary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="container p-3 bg-danger text-light">
                                <h6 class="bchan-font-header">Username of Passowrd wrong!</h6>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <div class="container p-3 bg-danger text-light">
                            <h6 class="bchan-font-header">Captcha wrong!</h6>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                }
                else
                {
                    ?>
                    <div class="p-1">
                        <h3 class="display bchan-font-header">Hi Administrator</h3>
                        <form method="POST" action="/bchan-controls">
                            <div class="form-group p-2 bchan-form p-2">
                                <label for="login_email">Email</label>
                                <input type="email" name="login_email" class="form-control" required="true">

                                <label for="login_password">Password</label>
                                <input id="login_password" type="password" name="login_password" class="form-control" required="true">

                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" onclick="showHidePass()">
                                    <label for="form-check-label">Show password</label>
                                </div>

                                <!--captcha-->
                                <div class="input-group mb-2 mt-2">
                                    <span class="input-group-addon">
                                        <img src="bchan_captcha.png"/>
                                    </span>
                                    <input id="comments_captcha" class="form-control" aria-describedby="basic-addon1" type="number" name="log_captcha" placeholder="Captcha..?" required="true">
                                </div>

                                <div class="text-center p-3 mt-3">
                                    <input type="submit" name="login" class="btn bchan-btn-background" value="Login">
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
        }
		?>
	</div>
</div>
<script>
	function showHidePass()
	{
		var x = document.getElementById("login_password");
		if (x.type === "password")
		{
			x.type = "text";
		}
		else
		{
		    x.type = "password";
		}
	}
</script>
<?php

include("_footer.php");
?>