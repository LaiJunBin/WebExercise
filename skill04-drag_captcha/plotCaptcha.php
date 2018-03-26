<?php
    header('content-type:png');
    $width = 30;
    $height = 30;
    $code = $_GET['code']??'-';

    $image = imagecreate($width,$height);
    $text_color = imagecolorallocate($image,r(),r(),r());
    $border_color = imagecolorallocate($image,0,0,0);
    $background_color = imagecolorallocate($image,r(255,200),r(255,200),r(255,200));
    $pixel_color = imagecolorallocate($image,r(),r(),r());

    imagefilledrectangle($image,0,0,$width,$height,$background_color);
    imagerectangle($image,0,0,$width,$height,$border_color);
    
    for($i=1;$i<=80;$i++)
        imagesetpixel($image,r($width),r($height),$pixel_color);
    $x = r(20,5);
    $y = r(10,5);
    imagestring($image,5,$x,$y,$code,$text_color);

    imagepng($image);
    imagedestroy($image);

    function r($max=200,$min=0){
        return mt_rand($min,$max);
    }
?>