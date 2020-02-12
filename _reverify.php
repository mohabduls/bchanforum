<?php
session_start();
include("system/utils.php");
include("system/connection.php");
include("classes/class.phpmailer.php");
$utils = new bchanUtils();

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "mail.bchan.my.id";
$mail->SMTPDebug = 0;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "admin@bchan.my.id"; 
$mail->Password = "thebambino1001";
$mail->SetFrom("no-reply@bchan.my.id","Bchan Forum");
$mail->Subject = "Bchan Email Verification";

if(!empty($_SESSION['bchan_user']))
{

    $bchan_username = $_SESSION['bchan_user'];
    $sql_getmail = "SELECT * FROM bchan_user WHERE bchan_username='$bchan_username'";
    $q_getmail = $bchan_class->q($conn, $sql_getmail);
    $fetch_mail = mysqli_fetch_assoc($q_getmail);
    $email = $fetch_mail['bchan_email'];
    $mail->AddAddress($email,"Bchan User");
    $msg_verification = "<strong>Bchan re-verification Emails</strong><br/>Just 1 step again, Verify your email by clicking link bellow :<br/><a href='https://bchan.my.id/verify?u=".base64_encode($bchan_username)."'>CLick here to Verify your Account!</a>";
            
    $mail->MsgHTML("$msg_verification");
	if($mail->Send())
	{
		echo "Success re-send verification to your Email.";
    }
    else
    {
        echo "Can't re-send verification email.";
    }
}
else
{
    echo "Error, You are not logged in!";
}

?>