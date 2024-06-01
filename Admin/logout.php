<?php
include "includes/config.php";

session_destroy();

Header("Location: index.php?msg=Logout Successful.");

?>