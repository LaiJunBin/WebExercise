<?php

$image_dir = './images';
$output_image_dir = './images-modified';

if (!is_dir($image_dir)) {
    mkdir($image_dir);
}

if (!is_dir($output_image_dir)) {
    mkdir($output_image_dir);
}

$image_files = array_filter(scandir($image_dir), function ($image) use ($image_dir) {
    return strpos(mime_content_type($image_dir . '/' . $image), 'image') === 0;
});

$images = array_map(function ($image) use ($image_dir) {
    return $image_dir . '/' . $image;
}, $image_files);

foreach ($images as $image) {
    $new_image = imagecreatefromstring(file_get_contents($image));
    $new_image = imagescale($new_image, 320);
    imagefilter($new_image, IMG_FILTER_GRAYSCALE);
    imagejpeg($new_image, './images-modified/' . basename($image));
}
