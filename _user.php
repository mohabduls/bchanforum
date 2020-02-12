<?php
include("_header.php");
?>
<div class="d-flex justify-content-center bg-light text-dark p-3">
	<?php
	if(empty($_SESSION['bchan_user']))
	{
		header("Location: /login?status=2");
	}
	else
	{
		$bchan_session = $_SESSION['bchan_user'];
		$sql_check_user = "SELECT * FROM bchan_user WHERE bchan_username='$bchan_session'";
		$query_bchan_user = $bchan_class->q($conn, $sql_check_user);

		if(mysqli_num_rows($query_bchan_user) == 1)
		{
			$fetch_user = mysqli_fetch_assoc($query_bchan_user);
			$bchan_name = htmlspecialchars($fetch_user['bchan_name']);
			$bchan_username = htmlspecialchars($fetch_user['bchan_username']);
			$bchan_email = htmlspecialchars($fetch_user['bchan_email']);
			$bchan_status_email = htmlspecialchars($fetch_user['bchan_status']);

			$bchan_birth = htmlspecialchars($fetch_user['bchan_birth']);
			$bchan_photo = htmlspecialchars($fetch_user['bchan_photo']);
			$bchan_bio = $fetch_user['bchan_bio'];

			//Check email status.
			if($bchan_status_email == false)
			{
				$status_email = "<span class='text-danger'>Unverified <button id='resend' class='btn btn-warning btn-sm'>Click to verify</button></span>";
			}
			else
			{
				$status_email = "<span class='text-success'>Verified</span>";
			}
			?>
			<div class="bchan-box-profile border border-2 round">
				<div class="p-1">
					<h3 class="bchan-profile mt-3">
						<strong>Profile</strong>
					</h3>
					<h5 class="text-dark bchan-font-header">Your info</h5>
					<span class="text-dark bchan-font-header">
						Name : <b><?php echo $bchan_name; ?></b>
					</span>
					<br/>
					<span class="text-dark bchan-font-header">
						Username : <b><?php echo $bchan_username; ?></b>
					</span>
					<br/>
					<span class="text-dark bchan-font-header">
						Email : <b><?php echo $bchan_email."</b> (".$status_email.")"; ?>
					</span>
					<br/>
					<span class="text-dark bchan-font-header">
						<?php
						if($bchan_birth == 0)
						{
							?>
							Birthday : <strong><?php echo "You have not set your birtday. Click setting button to setup your account."; ?></strong>
							<?php
						}
						else
						{
							?>
							Birthday : <?php echo $bchan_birth; ?>
							<?php
						}
						?>
					</span>


					<h3 class="bchan-profile mt-3">
						<strong>Bio</strong>
					</h3>
					<div class="p-1">
						<span class="text-dark bchan-font-header">
							<?php
							if(empty($bchan_bio))
							{
								echo "You don't have add your bio, Click button bellow to make a bio !";
								?>
								<div class="text-center mt-2">
									<button class="btn btn-sm bchan-btn-background" data-toggle="collapse" data-target="#bioCollapse">Add a Bio</button>
								</div>
								<div id="bioCollapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
									<div class="card-body">
										<form class="form-group" aaction="/user" method="POST">
											<label for="bchan_bio">Input your Bio to save</label>
											<textarea id="bchan_description" class="form-control" name="bchan_bio" placeholder="Add a bio status.."><?php echo $bchan_bio; ?></textarea>
											<div class="clearfix">
												<div class="float-right">
													<input type="submit" name="bchan_save_bio" class="btn btn-sm bchan-btn-background" value="Save Bio">
												</div>
											</div>
										</form>
									</div>
								</div>
								<?php
							}
							else
							{
								?>
								<div class="card bg-light text-dark shadow-sm p-1">
									<?php echo $bchan_bio; ?>
								</div>
								<div class="clearfix text-center mt-2">
									<div class="float-right">
										<button class="btn btn-sm bchan-btn-background" data-toggle="collapse" data-target="#bioEditCollapse">Edit Bio</button>
									</div>
								</div>
								<div id="bioEditCollapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
									<div class="card-body">
										<form class="form-group" aaction="/user" method="POST">
											<label for="bchan_bio">Input your Bio to save</label>
											<textarea id="bchan_description" class="form-control" name="bchan_bio" placeholder="Add a bio status.."><?php echo $bchan_bio; ?></textarea>
											<div class="clearfix mt-2">
												<div class="float-right">
													<input type="submit" name="bchan_save_bio" class="btn btn-sm bchan-btn-background" value="Save Bio">
												</div>
											</div>
										</form>
									</div>
								</div>
								<?php
							}
							?>
						</span>
					</div>
					<div class="p-2 text-center">
					<?php
					if(isset($_POST['bchan_save']))
					{
						$bchan_name = $utils->realString($conn, $utils->filterHTML($_POST['bchan_name']));
						$bchan_username = $utils->realString($conn, $utils->filterHTML($_POST['bchan_username']));
						$bchan_birth = $utils->realString($conn, $utils->filterHTML($_POST['bchan_birth']));
						$bchan_email = $utils->realString($conn, $utils->filterHTML($_POST['bchan_email']));
						$bpass = $utils->realString($conn, $_POST['bchan_password']);
						$bchan_password = md5($bpass);

						$sql_check_pass = "SELECT * FROM bchan_user WHERE bchan_username='$bchan_session'";
						$query_check_pass = $bchan_class->q($conn, $sql_check_pass);
						$fetch_check_password = mysqli_fetch_assoc($query_check_pass);
						$bchan_default_pass = $fetch_check_password['bchan_password'];

						if($bchan_password == $bchan_default_pass)
						{
							$sql_save_userinfo = "UPDATE bchan_user SET bchan_name='$bchan_name', bchan_username='$bchan_username', bchan_birth='$bchan_birth', bchan_email='$bchan_email' WHERE bchan_username='$bchan_session'";
							$_SESSION['bchan_user'] = $bchan_username;
							if($bchan_class->q($conn, $sql_save_userinfo))
							{
								?>
								<div class="p-3 bg-success text-light rounded">
									Setting saved.
								</div>
								<?php
							}
							else
							{
								?>
								<div class="p-3 bg-danger text-light rounded">
									Couldn't save setting, The password you entered not match with your current password !<br/>
									<?php
									echo mysqli_error($conn);
									?>
								</div>
								<?php
							}
							
						}
						else
						{
							?>
							<div class="p-3 bg-danger text-light rounded">
								Couldn't save setting, The password you entered not match with your current password !
							</div>
							<?php
						}
						
					}
					elseif(isset($_POST['bchan_save_bio']))
					{
						$bchan_bio = $utils->realString($conn, $utils->filterHTML($_POST['bchan_bio']));

						$sql_save_bio = "UPDATE bchan_user SET bchan_bio='$bchan_bio' WHERE bchan_username='$bchan_session'";

						if($bchan_class->q($conn, $sql_save_bio))
						{
							?>
							<div class="p-3 bg-success text-light rounded">
								Your Bio was saved successfuly.<br/>
							</div>
							<?php
						}
						else
						{
							?>
							<div class="p-3 bg-danger text-light rounded">
								Something wrong.<br/>
								<?php
								echo mysqli_error($conn);
								?>
							</div>
							<?php
						}
					}
					?>
					</div>

					<!--Setting Modal Boxes-->
					<div class="clearfix p-1">
						<div class="float-right">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#settingModal">
								Setting
							</button>
						</div>
					</div>
					<div class="modal fade" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="settingModal" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="settingModal">Setting</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form class="form-group p-1" action="/user" method="POST">
										<label for="bchan_name">Name</label>
										<input type="text" name="bchan_name" class="form-control mb-2 p-1" value="<?php echo $bchan_name; ?>" required="true">

										<label for="bchan_username">Username</label>
										<input type="text" name="bchan_username" class="form-control mb-2 p-1" value="<?php echo $bchan_username; ?>" required="true">

										<label for="bchan_birth">Birthday</a>
										<input type="date" name="bchan_birth" class="form-control mb-2 p-1" value="<?php echo $bchan_birth; ?>" required="true">

										<label for="bchan_email">Email</label>
										<input type="email" name="bchan_email" class="form-control mb-2 p-1" value="<?php echo $bchan_email; ?>" required="true">

										<label for="bchan_password">Retype Your Password</label>
										<input id="bchan_password" type="password" name="bchan_password" class="form-control mb-2 p-1" value="" required="true">

										<div class="form-check mt-2">
											<input type="checkbox" class="form-check-input" onclick="showHidePass()">
											<label for="form-check-label">Show password</label>
										</div>


										<div class="mt-4">
											<button type="submit" class="btn btn-primary" name="bchan_save">Save changes</button>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		else
		{
			header("Location: /login");
		}
	}
	?>
</div>
<script>
	function showHidePass()
	{
		var x = document.getElementById("bchan_password");
		if (x.type === "password")
		{
			x.type = "text";
		}
		else
		{
		    x.type = "password";
		}
	}
	function resendMail()
	{
		
	}
	$("#resend").click(function()
	{
		$.ajax({
			type: "POST",
			url: "_reverify.php",
			data: "reverify",
			success : function(response)
			{
				alert(response);
			}
		});
	});
</script>
<?php
include("_footer.php");
?>