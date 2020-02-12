<?php
session_start();
include("system/utils.php");
include("system/connection.php");
include("system/bchan-controls.php");
include("classes/class.phpmailer.php");

$controls = new bchanControls();
$utils = new bchanUtils();

$bchan_admin = $controls->areYouAdmin();
$bchan_domain = $utils->getThisServer();

date_default_timezone_get("Asia/Jakarta");

if(!empty($_SESSION['bchan_user']))
{
	$bchan_user_session = $_SESSION['bchan_user'];
}

$bchan_thisname = $_SERVER['PHP_SELF'];
if($bchan_thisname == "/index.php")
{
	$title = "Bchan Forum - Anime Lovers Community";
}
elseif($bchan_thisname == "/_forum1.php")
{
	if(isset($_GET['did']) AND isset($_GET['ft']))
	{
		$forum_name = $utils->realString($conn, $_GET['ft']);
		$postid = $utils->realString($conn, $_GET['did']);
		if($utils->checkForumType($_GET['ft']))
		{
			$query_title_post = $bchan_class->q($conn, $utils->getForumID($forum_name, $postid));
			$fetch_title = mysqli_fetch_assoc($query_title_post);

			$title = $fetch_title['bchan_discussion_title']." - Bchan Forum";
		}
		else
		{

		}
	}
	else
	{
		$title = "All About Anime Discussion";
	}
}
elseif($bchan_thisname == "/_forum2.php")
{
	$title = "All About Manga Discussion";
}
elseif($bchan_thisname == "/_forum3.php")
{
	$title = "All About Japanese Discussion";
}
elseif($bchan_thisname == "/_forum4.php")
{
	$title = "All About LA Discussion";
}
elseif($bchan_thisname == "/_forum5.php")
{
	$title = "ALl About Film Discussion";
}
elseif($bchan_thisname == "/_forum6.php")
{
	$title = "Others Discussion";
}
elseif($bchan_thisname == "/_viewForum.php")
{
	$bchan_tag = $_GET['discussion'];
	$bchan_forumType = $_GET['forumtype'];
	$title = "Bchan - Tag #$bchan_tag";
}
elseif($bchan_thisname == "/_user.php")
{
	$bchan_query_name = $bchan_class->q($conn, $utils->getName($utils->realString($conn, $bchan_user_session)));
	$bchan_name_fetch = mysqli_fetch_assoc($bchan_query_name);
	$bchan_name = $bchan_name_fetch['bchan_name'];
	$title = $bchan_name." "."Profile";
}
elseif($bchan_thisname == "/_login.php")
{
	$title = "Login to your Bchan account";
}
elseif($bchan_thisname == "/_register.php")
{
	$title = "Sign up Bchan account";
}
elseif($bchan_thisname == "/_administrator.php")
{
	$title = "Bchan Forum Administrator Login";
}
elseif($bchan_thisname == "/system/_bchan-action-handle.php")
{
	switch($_GET['control'])
	{
		case "del":{
			$title = "Processing Delete Post with ID: ".$_GET['pid'];
		}
	}
}
elseif($bchan_thisname == "/_verify.php")
{
	$title = "Verify Bchan Account";
}
elseif($bchan_thisname == "/_logout.php")
{
	$title = "Logout from account";
}
elseif($bchan_thisname == "/_sites.php")
{
	$bchan_page = $_GET['page'];
	switch($bchan_page)
	{
		case "privacy-policy":{
			$title = "Privacy Policy";
		}
		break;
		case "disclaimer":{
			$title = "Disclaimer";
		}
		case "about-us":{
			$title = "About Bchan Forum";
		}
		break;
	}
}
elseif($bchan_thisname == "/_profile.php")
{
	$bchan_username = strip_tags($_GET['u']);
	if(!empty($bchan_username))
	{
		$title = "Profile ".$bchan_username." on Bchan Forum"; 
	}
}
elseif($bchan_thisname == "/_animelist.php")
{
	$title = "Anime Database";
}

?>
<!DOCTYPE html>
<?php
?>
<html lang="en-US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta name="robots" content="index, follow" />
		<link rel="canonical" href="<?php echo $bchan_domain; ?>/"/>
		<meta name="keyword" content="bchan,bchan forum,anime forum,anime community,anime discussion,all about anime,bacod chan,japanese culture,manga,live action,film discussion,discussion,myanimelist,anime recomendation,anime info,anime share,ask anime"/>
		<meta name="description" content="Bchan (Bacod Chan) is an Anime forum website, you can share something related to Japan. Recommend a content, ask questions, and provide information to the entire contents of the forum."/>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/bchan.css" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono:400,400i|IBM+Plex+Sans+Condensed:400,400i|IBM+Plex+Sans:100,100i,400,400i,700,700i|IBM+Plex+Serif:400,400i&display=swap" rel="stylesheet">
		<!--logo-->
		<link rel="icon" href="/assets/bchan-logo.png" sizes="32x32" />
		<link rel="icon" href="/assets/bchan-logo.png" sizes="192x192" />
		<link rel="apple-touch-icon-precomposed" href="/assets/bchan-logo.png" />
		<meta name="msapplication-TileImage" content="/assets/bchan-logo.png" />
		<!--script-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({
				google_ad_client: "ca-pub-7733062331032756",
				enable_page_level_ads: true
			});
		</script>
	</head>
	<body>
		<header class="bchan-header p-3 text-center">
			<div class="clearfix">
				<div class="float-left">
					<a href="/">
						<h3 class="text-light">
							<strong>Bchan</strong>
						</h3>
					</a>
				</div>
				<div class="float-right text-light">
					<?php
					if(empty($_SESSION['bchan_user']))
					{
						?>
						<h5 class="text-light bchan-name">
							<strong><a href="/login" class="text-light">Login</a></strong> or <strong><a href="/signup" class="text-light">Sign Up</a></strong>
						</h5>
						<?php
					}
					else
					{
						$bchan_user = $_SESSION['bchan_user'];
						?>
						<h5 class="text-light bchan-name">
							<strong>
								<a href="/user" class="text-light">
									Profile
								</a>
							</strong>
							or 
							<strong>
								<a href="/logout" class="text-light" rel="nofollow">
									Logout
								</a>
							</strong>
						</h5>
						<?php
					}
					if($bchan_admin == true)
					{
						?>
						<h5 class="text-light bchan-name">
							<strong>
								<a href="/bchan-controls?admin=logout" class="text-light" rel="nofollow">
									Admin Logout
								</a>
							</strong>
							 | 
							<strong>
								<a href="#" class="text-light" rel="nofollow" data-toggle="modal" data-target="#addAnimeModal">
									Add Anime List
								</a>
							</strong>
						</h5>
						<?php
					}
					?>
				</div>
			</div>
		</header>
		<div class="bchan-expand">