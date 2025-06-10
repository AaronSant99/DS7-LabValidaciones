<?php

session_start();

$random_number = bin2hex(random_bytes(4));
$_SESSION['captcha_code'] = $random_number;
header("Content-type: image/png");

// Crear la imagen
$image_width = 100;
$image_height = 40;
$image = imagecreatetruecolor($image_width, $image_height);
$background_color = imagecolorallocate($image, 220, 220, 220);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagefilledrectangle($image, 0, 0, $image_width, $image_height, $background_color);

// Dibujar el texto del captcha
$font_size = 5;
$x = 10;
$y = 10;
imagestring($image, $font_size, $x, $y, $random_number, $text_color);
imagepng($image);
imagedestroy($image);

?>