<?php

session_start();

$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";


$captcha_code = substr(str_shuffle($chars), 0, 6);
$_SESSION['captcha'] = $captcha_code;

$captcha_image = imagecreatetruecolor(150, 50);
$captcha_bg = imagecolorallocate($captcha_image, 247, 174, 71);
$captcha_txt = imagecolorallocate($captcha_image, 0, 0, 0);

imagefill($captcha_image, 0, 0, $captcha_bg);

for ($i = 0; $i < strlen($captcha_code); $i++) {
  $char = substr($captcha_code, $i, 1);
  $x = 10 + ($i * 25);
  $y = rand(10, 30);

  imagestring($captcha_image, 5, $x, $y, $char, $captcha_txt);
}

imagepng($captcha_image);
