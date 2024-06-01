<?php
include "lib/config.php";

if( isset($_SESSION['logged_in_user_id'])) {
	$sql = "UPDATE `users` SET `password_remember_cookie` = '' WHERE `user_id` = '$_SESSION[logged_in_user_id]'";
	$res = $db->query($sql);
}

setcookie("REMEMBER_ME_TOKEN", "", 0, '/');
session_destroy();

Header("Location: login.php?msg=Logout Successful.");

?>