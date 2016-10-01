<?php
session_start();
unset($_SESSION['rand_code']);
if (empty($_SESSION['rand_code'])) {
    $str = "";
	$a = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $length = 0;
    for ($i = 0; $i < 6; $i++) {
        $str .= $a{rand(0, 61)};
    }
    $_SESSION['rand_code'] = $str;
}

$imgX = 100;
$imgY = 20;
$image = imagecreatetruecolor(100, 20);
$backgr_col = imagecolorallocate($image, 238,239,239);
$border_col = imagecolorallocate($image, 208,208,208);
$text_col = imagecolorallocate($image, 46,60,31);
imagefilledrectangle($image, 0, 0, 100, 20, $backgr_col);
imagerectangle($image, 0, 0, 99, 19, $border_col);
$font = "./VeraSe.ttf"; 
$font_size = 10;
$angle = 0;
$box = imagettfbbox($font_size, $angle, $font, $_SESSION['rand_code']);
$x = (int)($imgX - $box[4]) / 2;
$y = (int)($imgY - $box[5]) / 2;
imagettftext($image, $font_size, $angle, $x, $y, $text_col, $font, $_SESSION['rand_code']);
header("Content-type: image/png");
imagepng($image);
imagedestroy ($image);
?>
