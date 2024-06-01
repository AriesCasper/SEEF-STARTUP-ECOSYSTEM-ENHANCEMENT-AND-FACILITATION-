<?php

session_start();
date_default_timezone_set("Asia/Kolkata");

//Header('Access-Control-Allow-Origin: *');

if (strpos( $_SERVER['SERVER_NAME'],"localhost")===false)
{
	$DB_hostname="mysql.aiinstitute.in";
	$DB_username="techno_vikram";
	$DB_password="Vikram@Tcg123";
	$DB_dbname_1="project";
	// mysql -u techno_vikram -p -h mysql.aiinstitute.in techno_vikram_seef 
}
else
{
	// for local
	$DB_hostname="localhost";
	$DB_username="root";
	$DB_password="";
	$DB_dbname_1="project";
}

$db	= new mysqli($DB_hostname, $DB_username, $DB_password, $DB_dbname_1);


foreach($_POST as $k=>$v)
{
	if(gettype($_POST[$k]) == "array")
	{
		continue;
	}

	if($k!="content") //CKEditor Content
		$_POST[$k] = addslashes(str_replace("<","&lt;",$v));
}
foreach($_GET as $k=>$v)
{
	$_GET[$k]	= addslashes(trim(str_replace("<","&lt;",$v)));
}



function NikThumb($file_path, $thumb_file_path, $thumb_max_width=100, $thumb_max_height=100)
{

	//Find Extension
	$tmp = explode(".", $file_path);
	$ext = strtolower(trim(end($tmp)));

	if($ext == "jpg" || $ext =="jpeg" )
		$source = imagecreatefromjpeg($file_path);

	if($ext == "png" )
		$source = imagecreatefrompng($file_path);

	if($ext == "gif" )
		$source = imagecreatefromgif($file_path);

	//$source = imagecreatefromjpeg("samples/face.jpg");
	$width  = imagesx($source);  //1920
	$height = imagesy($source);  //1200

	//Find a scale, if Tall Image, scale down with HEIGHT (Make Height=100, W<100)
	//If Wide image, scale down WIDTH to make it 100, Height<100
	$scale = min( $thumb_max_width/$width, $thumb_max_height/$height );


	$thumb_width  = $scale*$width;
	$thumb_height = $scale*$height;

	$temp   = imagecreatetruecolor($thumb_width, $thumb_height);

	imagecopyresampled($temp, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);

	if($thumb_file_path!="") {
		if(stripos($thumb_file_path, ".jp") !== false)
			imagejpeg($temp, $thumb_file_path);

		if(stripos($thumb_file_path, ".gif") !== false)
			imagegif($temp, $thumb_file_path);

		if(stripos($thumb_file_path, ".png") !== false)
			imagepng($temp, $thumb_file_path);
	}
	else {
		header("Content-type: image/jpeg");
		imagejpeg($temp);
	}	
}

?>