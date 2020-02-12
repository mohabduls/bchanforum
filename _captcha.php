<?php
//SESSION START
session_start();

//MAKE SURE THIS CONTENT ARE IMAGES
header("Content-type: image/png");

$_SESSION['bchan_captcha'] = "";

//Width & Height
$img = imagecreate(100, 38);
//Background Color Of The Captcha
imagecolorallocate($img, 111,90,126);

//Font & Color Captcha
$color = imagecolorallocate($img, 240, 248, 255);
$font = dirname(__FILE__)."/assets/bchan_captcha.otf";
$size = 17;
$position = 28;

//MAKE RANDOM NUMBERS
for($i=0;$i<=5;$i++)
{
	//Random
	$random = rand(0,5);
	$_SESSION['bchan_captcha'] .= $random;
	//Slope
	$slope = rand(20,20);
	imagefttext($img, $size, $slope, 8+15*$i, $position, $color, $font, $random);
}
imagepng($img);
imagedestroy($img);
?>