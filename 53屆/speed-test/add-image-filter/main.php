<?php

$image = imagecreatefromjpeg('./plane.jpg');

$width = imagesx($image);
$height = imagesy($image);

for ($i = 0; $i < 30000; $i++) {
    $x = rand(0, $width - 1);
    $y = rand(0, $height - 1);
    $color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($image, $x, $y, $color);
}

imagejpeg($image, './result.jpg');
