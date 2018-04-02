<?php
	
	header('content-type:png');
	
	$width = 30;
	$height = 30;
	
	$code = $_GET['code'];
	
	$image = imagecreate($width,$height);
	
	$background_color = imagecolorallocate($image,r(),r(),r());
	$border_color = imagecolorallocate($image,0,0,0);
	$text_color = imagecolorallocate($image,r(),r(),r());
	$pixel_color = imagecolorallocate($image,r(),r(),r());
	
	imagefilledrectangle($image,0,0,$width,$height,$background_color);
	imagerectangle($image,0,0,$width,$height,$border_color);
	
	for($i = 1 ; $i<=80 ;$i++){
		imagesetpixel($image,r($width),r($height),$pixel_color);	
	}

	imagestring($image,5,r($width-15,10),r($height-20,3),$code,$text_color);
	
	imagepng($image);
	imagedestroy($image);

	function r($max=255,$min=0){
		return mt_rand($min,$max);	
	}
?>