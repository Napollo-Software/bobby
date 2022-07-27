<?php
/*
*Dynamic User Profile Generate Function
*/
 
if (!function_exists('makeAvatar')) {
 
	function makeAvatar($fontpath, $dest, $char) {
		$path = $dest;
		$image = imagecreate(200, 200);
		$red = rand(0,255);
		$green = rand(0,255);
		$blue = rand(0,255);
		imagecolorallocate($image, $red, $green, $blue);
		$textcolor = imagecolorallocate($image, 255, 255, 255);
		imagettftext($image, 100, 0, 40, 150, $textcolor, $fontpath, $char);
		imagepng($image, $path);
		imagedestroy($image);
		return $path;
	}

 } 



?>