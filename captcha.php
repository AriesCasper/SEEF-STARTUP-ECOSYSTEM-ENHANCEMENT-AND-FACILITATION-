<?php
session_start();

$rand_str	= chr(rand(65,90)).chr(rand(97,122)).chr(rand(65,90)).rand(0,9).chr(rand(97,122));
	 

$_SESSION['image_value'] =md5($rand_str);

//Get Each letter in different variables,we will format each letters different.
$letter1	= substr($rand_str,0,1); 
$letter2	= substr($rand_str,1,1);
$letter3	= substr($rand_str,2,1);
$letter4	= substr($rand_str,3,1);
$letter5	= substr($rand_str,4,1);


//Make Captcha Canvas
$image		= imagecreatefrompng("images/noise.png");


//Get a random angle for each letter to be rotated with
$angle1		= rand(-20, 20);
$angle2		= rand(-20, 20);
$angle3		= rand(-20, 20);
$angle4		= rand(-20, 20);
$angle5		= rand(-20, 20);

//Get a random font
$font1		= "fonts/".rand(1, 3).".ttf";
$font2		= "fonts/".rand(1, 3).".ttf";
$font3		= "fonts/".rand(1, 3).".ttf";
$font4		= "fonts/".rand(1, 3).".ttf";
$font5		= "fonts/".rand(1, 3).".ttf";


//Define a table of colors(The values are the RGB Component for each color.)
$colors[0]	= array(122,229,112);
$colors[1]	= array(85,178,85);
$colors[2]	= array(226,108,97);
$colors[3]	= array(141,214,210);
$colors[4]	= array(214,141,205);
$colors[5]	= array(100,138,204);

//Get a random color of each letter
$color1		= rand(0, 5);
$color2		= rand(0, 5);
$color3		= rand(0, 5);
$color4		= rand(0, 5);
$color5		= rand(0, 5);


//Allocate Colors for letters
$textColor1 = imagecolorallocate ($image, $colors[$color1][0],$colors[$color1][1], $colors[$color1][2]);
$textColor2 = imagecolorallocate ($image, $colors[$color2][0],$colors[$color2][1], $colors[$color2][2]);
$textColor3 = imagecolorallocate ($image, $colors[$color3][0],$colors[$color3][1], $colors[$color3][2]);
$textColor4 = imagecolorallocate ($image, $colors[$color4][0],$colors[$color4][1], $colors[$color4][2]);
$textColor4 = imagecolorallocate ($image, $colors[$color5][0],$colors[$color5][1], $colors[$color5][2]);
$textColor5 = imagecolorallocate ($image, $colors[$color5][0],$colors[$color5][1], $colors[$color5][2]);

//Make Captcha
$size=20;
imagettftext($image, $size, $angle1, 10, $size+15, $textColor1, $font1, $letter1);
imagettftext($image, $size, $angle2, 35, $size+15, $textColor2, $font2, $letter2);
imagettftext($image, $size, $angle3, 60, $size+15, $textColor3, $font3, $letter3);
imagettftext($image, $size, $angle4, 85, $size+15, $textColor4, $font4, $letter4);
imagettftext($image, $size, $angle5, 110, $size+15, $textColor5, $font5, $letter5);


//send image to browser
Header("Content-Type: image/jpeg");


//create an image
imagejpeg($image);

//destroy image resource
imagedestroy($image);


?>