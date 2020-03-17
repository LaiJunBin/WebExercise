<?php
	header('content-type:png');
	$code = $_GET['code'];
	$width = 30 * mb_strlen($code);
	$height = 30;
	
	
	
	
	$image = imagecreate($width,$height);
	
	$background_color = imagecolorallocate($image,r(),r(),r());
	$border_color = imagecolorallocate($image,0,0,0);
	$text_color = imagecolorallocate($image,r(),r(),r());
	$pixel_color = imagecolorallocate($image,r(),r(),r());
	
	imagefilledrectangle($image,0,0,$width,$height,$background_color);
	imagerectangle($image,0,0,$width,$height,$border_color);
	
	$x = mt_rand(5,10);
	$y = mt_rand(0,10);
	
	for($i=0;$i<=strlen($code);$i++){
		imagestring($image,5,$x,$y,substr($code,$i,1),$text_color);	
		$y = mt_rand(0,10);
		$x+=mt_rand(20,35);
	}
	
	
	for($i=1;$i<=80;$i++){
		imagesetpixel($image,r($width-1),r($height-1),$pixel_color);	
	}
	
	imagepng($image);
	imagedestroy($image);



	function r($max=200,$min=0){
		return mt_rand($min,$max);	
	}
?>