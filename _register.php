<?php
include("_header.php");
$bchan_captcha = $_SESSION['bchan_captcha'];

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "bchan.my.id";
$mail->SMTPDebug = 0;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "no-reply@bchan.my.id"; 
$mail->Password = "thebambino1001";
$mail->SetFrom("no-reply@bchan.my.id","Bchan Forum");
$mail->Subject = "Bchan Email Verification";
?>
<div class="d-flex jumbotron justify-content-center bg-light text-dark p-3">
<?php
if(!empty($_SESSION['bchan_user']))
{
	?>
	<script>
		window.location.href = "/user";
	</script>
	<?php
}
else
{
	
	if(isset($_POST['register']))
	{
		if($_POST['reg_captcha'] == $bchan_captcha)
		{
			$reg_name = $utils->realString($conn, $_POST['reg_name']);
			$reg_username = $utils->realString($conn, $utils->tagReplacer($_POST['reg_username']));
			$reg_email = $utils->realString($conn, $_POST['reg_email']);
			$r_pass = $utils->realString($conn, $_POST['reg_password']);
			$reg_password = md5($r_pass);

			//Check if user exists
			$sql_check_user = "SELECT * FROM bchan_user WHERE bchan_email='$reg_email' OR bchan_username='$reg_username'";
			$check = $bchan_class->q($conn, $sql_check_user);

			if(strlen($reg_username) < 3)
			{
				?>
				<div class="bg-danger p-3 text-light">
					<h6>Username minimum is 3 characters!</h6>
				</div>
				<script>
					var delay = 2000;
					setTimeout(function(){
						window.location.href = "/signup";
					}, delay);
				</script>
				<?php
			}
			elseif(strlen($r_pass) < 8)
			{
				?>
				<div class="bg-danger p-3 text-light">
					<h6>Password minimum is 8 characters!</h6>
				</div>
				<script>
					var delay = 2000;
					setTimeout(function(){
						window.location.href = "/signup";
					}, delay);
				</script>
				<?php
			}
			elseif(mysqli_num_rows($check) == 1)
			{
				//users already exist
				?>
				<div class="container bg-danger p-3 text-light">
					<p class="text-light bchan-font-header">Username or Email already exists!</p>
				</div>
				<script>
					var delay = 2000;
					setTimeout(function(){
						window.location.href = "/signup";
					}, delay);
				</script>
				<?php
			}
			elseif($utils->dangerChars($reg_name) == true)
			{
				?>
				<div class="container bg-danger p-3 text-light">
					<p class="text-light bchan-font-header">Illegal characters on Name detected!</p>
				</div>
				<script>
					var delay = 2000;
					setTimeout(function(){
						window.location.href = "/signup";
					}, delay);
				</script>
				<?php
			}
			elseif($utils->dangerChars($reg_username) == true)
			{
				?>
				<div class="container bg-danger p-3 text-light">
					<p class="text-light bchan-font-header">Illegal characters on Username detected!</p>
				</div>
				<script>
					var delay = 2000;
					setTimeout(function(){
						window.location.href = "/signup";
					}, delay);
				</script>
				<?php
			}
			elseif($utils->dangerChars($reg_email) == true)
			{
				?>
				<div class="container bg-danger p-3 text-light">
					<p class="text-light bchan-font-header">Illegal characters on Email detected!</p>
				</div>
				<script>
					var delay = 2000;
					setTimeout(function(){
						window.location.href = "/signup";
					}, delay);
				</script>
				<?php
			}
			else
			{
				if(empty($reg_name) OR empty($reg_username) OR empty($reg_email) OR empty($reg_password))
				{
					?>
					<div class="container bg-danger p-3 text-light">
						<h4 class="display-4 text-danger bchan-font-header">Something went wrong while adding your account, make sure you have fill all form before.</h4>
					</div>
					<?php
				}
				else
				{
					$sql_input_user = "INSERT INTO bchan_user(bchan_name, bchan_username, bchan_email, bchan_password, bchan_status) VALUES('$reg_name', '$reg_username', '$reg_email', '$reg_password', '0')";
					if($bchan_class->q($conn, $sql_input_user))
					{
						$mail->AddAddress("$reg_email","Bchan User");
						$msg_verification = "<strong>Thankyou for Sign up on Bchan Forum!</strong><br/>Just 1 step again, Verify your email by clicking link bellow :<br/><a href='https://bchan.my.id/verify?u=".base64_encode($reg_username)."'>CLick here to Verify your Account!</a>";
						$mail->MsgHTML("$msg_verification");
						if($mail->Send())
						{
							?>
							<div class="container p-3 text-dark text-center">
								<h5 class="bchan-font-header">Thankyou for Signup on Bachan Forum. an email verification has been send to your email, please verify your Email before using your account. the account will be active after you confirm your email. Link confirmation has been send to your email!</h5>
							</div>
							<script>
								var delay = 2000;
								setTimeout(function(){
								window.location.href = "/login";
								}, delay);
							</script>
							<?php
						}
						else
						{
							?>
							<div class="container p-3 text-dark text-center">
								<h5 class="bchan-font-header">We can't send the verification link :(</h5>
							</div>
							<script>
								var delay = 2000;
								setTimeout(function(){
								window.location.href = "/login";
								}, delay);
							</script>
							<?php
						}
					}
					else
					{
						echo "We can't proccess your account now!";
					}
				}
			}
			?>
			<?php
		}
	}
	else
	{
		?>
		<div>
			<h3 class="display bchan-font-header">Register New Account</h3>
			<form class="form-group p-2 bchan-form" method="POST" action="/signup">
				<div class="p-2">
					<!--reg_name-->
					<label for="reg_name">Name</label>
					<input type="text" name="reg_name" class="form-control" required="true">
					<!--reg_username-->
					<label for="reg_username">Username</label>
					<input type="text" name="reg_username" class="form-control" required="true">
					<!--reg_email-->
					<label for="reg_email">Email</label>
					<input type="email" name="reg_email" class="form-control" required="true">
					<!--reg_password-->
					<label for="reg_password">Password</label>
					<input id="reg_password" type="password" name="reg_password" class="form-control" required="true">
					<div class="form-check mt-2">
						<input type="checkbox" class="form-check-input" onclick="showHidePass()">
						<label for="form-check-label">Show password</label>
					</div>
					
					<!--captcha-->
					<div class="input-group mb-2 mt-2">
						<span class="input-group-addon">
							<img src="bchan_captcha.png"/>
						</span>
						<input id="comments_captcha" class="form-control" aria-describedby="basic-addon1" type="number" name="reg_captcha" placeholder="Captcha..?" required="true">
					</div>
					<!--captcha-->
					<div class="form-check mt-2">
						<input type="checkbox" class="form-check-input" name="reg_privacy" required="true">
						<label for="form-check-label">I have read and agree with <a target="_blank" href="/privacy-policy">Privacy & Policy</a> on Bchan Forum</label>
					</div>
					
					<!--register-->
					<div class="text-center p-3 mt-3">
						<input type="submit" name="register" class="btn bchan-btn-background" value="Register">
					</div>
				</div>
			</form>
		</div>
		<?php
	}
}
?>
</div>
<script>
function showHidePass() {
  var x = document.getElementById("reg_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<?php

include("_footer.php");
?>