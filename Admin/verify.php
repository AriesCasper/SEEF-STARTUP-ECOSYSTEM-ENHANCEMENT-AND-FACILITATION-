<?php
include "includes/config.php"; 
if(isset($_POST['username']) && isset($_POST['password'])){

	$user = trim(addslashes($_POST['username']));
	$pass = md5(trim(addslashes($_POST['password']))); // admin


	$sql = "SELECT * FROM `administrator` WHERE `username` = '$user' AND `password` = '$pass'";
	$res = $db->query($sql) or die($db->error);
	$num = $res->num_rows;

	$row = $res->fetch_array();
	if($num > 0){
		$_SESSION['admin_logged_in_user_id']   = $row['id'];
		$_SESSION['admin_logged_in_user_name'] = $row['fullname'];
		$_SESSION['admin_logged_in']           = true;

		Header("Location: home.php"); die("Header Err");
	}	
	else
		Header("Location: index.php?msg=Invalid Details");
}


	





?>