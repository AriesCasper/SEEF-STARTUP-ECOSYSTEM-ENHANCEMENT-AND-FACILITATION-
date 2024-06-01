<?php
include "lib/config.php";

if(isset($_COOKIE['REMEMBER_ME_TOKEN']) && strlen($_COOKIE['REMEMBER_ME_TOKEN'])>1) {

	$sql = "SELECT * FROM `users` WHERE `password_remember_cookie` = '$_COOKIE[REMEMBER_ME_TOKEN]'";
	$res = $db->query($sql) or die($db->error);
	$row = $res->fetch_array();

	if(!$row) {  //Wrong Cookie Data/Stale, Redirect to login page
		setcookie("REMEMBER_ME_TOKEN", "", 0, '/');
		unset($_COOKIE['REMEMBER_ME_TOKEN']);
		Header("Location: login"); die("Header Err");
	}

	$user = $row['email'];
	$pass = trim($row['password']);
	$_POST['remember'] = "true";
}
else {
	$user = trim(addslashes($_POST['email']));
	$pass = md5(trim(addslashes($_POST['password'])));
}

$sql = "SELECT * FROM `users` WHERE `email` = '$user' AND `password` = '$pass'";
$res = $db->query($sql) or die($db->error);
$num = $res->num_rows;

$row = $res->fetch_array();
if($num > 0)
{

	if($row['status'] != "active") {
		Header("Location: login?msg=Sorry, your account has been disabled or deleted.");
		 die("Header Err");
	}

	$_SESSION['logged_in_user_id']   = $row['user_id'];
	$_SESSION['logged_in_user_name'] = $row['fullname'];
	$_SESSION['logged_in']           = true;

	if(isset($_POST['remember']) && $_POST['remember'] == "true") {
		$rand = md5(rand(11111,99999).md5(rand(11111,99999)));
		setcookie("REMEMBER_ME_TOKEN", $rand, time()+3600*24*365*21, '/');

		$sql = "UPDATE `users` SET `password_remember_cookie` = '$rand' WHERE `user_id` = '$row[user_id]'";
		$res = $db->query($sql);
	}
	else {
		setcookie("REMEMBER_ME_TOKEN", "", 0);

		$sql = "UPDATE `users` SET `password_remember_cookie` = '' WHERE `user_id` = '$row[user_id]'";
		$res = $db->query($sql);
	}

	Header("Location: posts"); die("Header Err");
}
else
{
	$sql = "SELECT * FROM `users` WHERE `email` = '$user' ";
	$res = $db->query($sql) or die($db->error);
	$num = $res->num_rows;

	if($num) {
		Header("Location: login?email=$user&msg=Your Email was found, but password is incorrect. Try Forgot Password!"); 
		die("Header Err");
	}
	else {
		Header("Location: login?msg=This email ID is not registered with us. Check it!"); 
		die("Header Err");
	}
}
?>