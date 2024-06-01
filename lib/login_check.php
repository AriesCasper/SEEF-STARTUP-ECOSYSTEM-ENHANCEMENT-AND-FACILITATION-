<?php
if( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true)
	Header("Location: login.php?msg=Invalid Access");

?>