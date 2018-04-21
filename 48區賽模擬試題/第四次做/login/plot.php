<?php
	header('content-type:png');
	$width = 30;
	$height = 30;
	$image = imagecreate($width,$height);
	
	$code = $_GET['code'];
	
	$keys = ['background_color','border_color','text_color','pixel_color'];
	
	foreach($keys as $key){
		$$key = imagecolorallocate($image,r(),r(),r());
	}
	
	imagefilledrectangle($image,0,0,$width,$height,$background_color);
	imagerectangle($image,0,0,$width,$height,$border_color);
	
	imagestring($image,5,r($width-10,3),r($height-10,3),$code,$text_color);
	
	for($i=1;$i<=80;$i++){
		imagesetpixel($image,r($width),r($height),$pixel_color);	
	}
	
	imagepng($image);
	imagedestroy($image);
	
	function r($max=255,$min=0){
		return mt_rand($min,$max);	
	}
?>