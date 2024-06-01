<?php
if( !isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true)
	Header("Location: index.php?msg=Invalid Access");

?>