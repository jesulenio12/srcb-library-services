<?php
$image = imagecreatetruecolor(100, 100);
$color = imagecolorallocate($image, 255, 0, 0);
imagefilledrectangle($image, 0, 0, 100, 100, $color);
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
