<!DOCTYPE html>

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"  >
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<?php
if (strpos( $_SERVER['SERVER_NAME'],"localhost")===false)
	print '	<BASE HREF = "https://generationai.in/Vikram/SEEF3/"> ';
else
	print '	<BASE HREF = "http://localhost/WWW/index"> ';

if(!isset($_SESSION['logged_in_user_id'])) $_SESSION['logged_in_user_id'] = -123;
?>
	
	<meta charset="utf-8"/>
	<title>SEEF | STARTUP ECOSYSTEM ENHANCEMENT AND FACILITATION (SEEF) | Ultimate Entrepreneur Network</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
	<link href="./assets/plugins/socicon/socicon.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css"/>		
	<link href="./assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/plugins/animate/animate.min.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->

			<!-- BEGIN: BASE PLUGINS  -->
			<link href="./assets/plugins/revo-slider/css/settings.css" rel="stylesheet" type="text/css"/>
			<link href="./assets/plugins/revo-slider/css/layers.css" rel="stylesheet" type="text/css"/>
			<link href="./assets/plugins/revo-slider/css/navigation.css" rel="stylesheet" type="text/css"/>
			<link href="./assets/plugins/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css"/>
			<link href="./assets/plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css"/>
			<link href="./assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
			<link href="./assets/plugins/slider-for-bootstrap/css/slider.css" rel="stylesheet" type="text/css"/>
				<!-- END: BASE PLUGINS -->
	
	
    <!-- BEGIN THEME STYLES -->
	<link href="./assets/demos/default/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/demos/default/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="./assets/demos/default/css/themes/default.css" rel="stylesheet" id="style_theme" type="text/css"/>
	<link href="./assets/demos/default/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->

	<link rel="shortcut icon" href="favicon.ico"/>

	<style>
	.panel-group {
	  margin-bottom: 0;
	}
	.panel-group .panel {
	  border-radius: 0;
	  box-shadow: none;
	}
	.panel-group .panel .panel-heading {
	  padding: 0;
	}
	.panel-group .panel .panel-heading h4 a {
	  background: rgb(46, 185, 198);
	  display: block;
	  font-size: 14px;
	  font-weight: bold;
	  padding: 15px;
	  text-decoration: none;
	  transition: 0.15s all ease-in-out;
	}
	.panel-group .panel .panel-heading h4 a:hover, .panel-group .panel .panel-heading h4 a:not(.collapsed) {
	  background: rgb(36, 155, 170);
	  transition: 0.15s all ease-in-out;
	}
	.panel-group .panel .panel-heading h4 a:not(.collapsed) i:before {
	  content: "";
	}
	.panel-group .panel .panel-heading h4 a i {
	  color: #999;
	}
	.panel-group .panel .panel-body {
	  padding-top: 0;
	}
	.panel-group .panel .panel-heading + .panel-collapse > .list-group,
	.panel-group .panel .panel-heading + .panel-collapse > .panel-body {
	  border-top: none;
	}
	.panel-group .panel + .panel {
	  border-top: none;
	  margin-top: 0;
	}

</style>

</head><body class="c-layout-header-fixed c-layout-header-mobile-fixed c-layout-header-fullscreen"> 
		
	<!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
<!-- BEGIN: HEADER -->
<header class="c-layout-header c-layout-header-2 c-layout-header-dark-mobile c-header-transparent-dark" data-minimize-offset="80" >
		<div class="c-navbar">
		<div class="container">
			<!-- BEGIN: BRAND -->
			<div class="c-navbar-wrapper clearfix">
				<div class="c-brand c-pull-left">
					<a href="index" class="c-logo">
						<img src="./assets/base/img/layout/logos/logo-1.png" alt="SEEF" class="c-desktop-logo">
						<img src="./assets/base/img/layout/logos/logo-1.png" alt="SEEF" class="c-desktop-logo-inverse">
						<img src="./assets/base/img/layout/logos/logo-1.png" alt="SEEF" class="c-mobile-logo">
					</a>
					<button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
					<span class="c-line"></span>
					<span class="c-line"></span>
					<span class="c-line"></span>
					</button>
					<!-- <button class="c-topbar-toggler" type="button">
						<i class="fa fa-ellipsis-v"></i>
					</button>
					<button class="c-search-toggler" type="button">
						<i class="fa fa-search"></i>
					</button> -->
					<button class="c-cart-toggler" type="button">
						 <span class="c-cart-number c-theme-bg"><?php print notices_requiring_attention(); ?></span>
					</button> 
				</div>
				<!-- END: BRAND -->				
				<!-- BEGIN: QUICK SEARCH -->
				<form class="c-quick-search" action="#">
					<input type="text" name="query" placeholder="Type to search..." value="" class="form-control" autocomplete="off">
					<span class="c-theme-link">&times;</span>
				</form>
				<!-- END: QUICK SEARCH -->	
				<!-- BEGIN: HOR NAV -->
				<!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
<!-- BEGIN: MEGA MENU -->
<!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
<nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-theme c-fonts-uppercase c-fonts-bold">
	<ul class="nav navbar-nav c-theme-nav"> 

		<li class="c-active"> <a href="index" class="c-link">Home</a> </li>
		<li class="c-link"> <a href="seef" class="c-link">SEEF</a> </li>
		<!-- <li class="c-link"> <a href="about" class="c-link">About</a> </li> -->
		<li class="c-link"> <a href="members" class="c-link">Members</a> </li>
		<li class="c-link"> <a href="posts" class="c-link">Posts</a> </li>
		<li class="c-link"> <a href="startups.php" class="c-link">Startups</a> </li>
		<!-- <li class="c-link"> <a href="contact" class="c-link">Contact</a> </li> -->
		<?php
		if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
			print '<li class="c-link"> <a href="login" class="c-link" >
				<span style="border: 1px solid white; padding: 10px;">Login</span>
				</a> </li>

				<li class="c-link"> <a href="register_simple" class="c-link" >
				<span style="border: 1px solid white; padding: 10px;">Register</span>
				</a> </li>';
		} else {
			print '<li class="c-link"> <a href="account" class="c-link" >
		<span style="border: 1px solid white; padding: 10px;">Account</span>
		</a> </li>

		<li class="c-link"> <a href="logout" class="c-link" >
		<span style="border: 1px solid white; padding: 10px;">Logout </span>
		</a> </li>';

		
		print '<li class="c-cart-toggler-wrapper">
		
		<a  href="#" class="c-btn-icon c-cart-toggler">'.$_SESSION['logged_in_user_name'].'
		 <span class="c-cart-number c-theme-bg">'.notices_requiring_attention().'</a>
		
		</li>';

		}


		function notices_requiring_attention() {

			global $db; 
			
			$notices_requiring_attention = 0 ;
			

			$sql = "SELECT * FROM `user_connections` WHERE `receiver_user_id` = '$_SESSION[logged_in_user_id]' AND `connection_status` = 'pending' ";
			$res = $db->query($sql) or die($db->error);
			while($row = $res->fetch_array()) {
				$notices_requiring_attention++;
			}

			$sql = "SELECT DISTINCT `sender_user_id` FROM `messages` WHERE `receiver_user_id` = '$_SESSION[logged_in_user_id]' AND `receiver_message_status` = 'unread' ";
			$res = $db->query($sql) or die($db->error);
			while($row = $res->fetch_array()) {
				$notices_requiring_attention++;
			}

			return $notices_requiring_attention;
		}
		?>
	</ul>
</nav>
<!-- END: MEGA MENU --><!-- END: LAYOUT/HEADERS/MEGA-MENU -->
				<!-- END: HOR NAV -->		
			</div>	





<!-- BEGIN: CART MENU -->
<div class="c-cart-menu">
	<div class="c-cart-menu-title">

		<?php

		$notices_requiring_attention = notices_requiring_attention ();
		if($notices_requiring_attention==1)
			print "A notice requires your attention";

		if($notices_requiring_attention>1)
			print "We have $notices_requiring_attention notices for you!";

		if($notices_requiring_attention==0)
			print "Hurray! Notihing Requires attention";
		?>
		
	</div>
	<ul class="c-cart-menu-items">
		<?php

		//Select Connection Requests

		$sql = "SELECT * FROM `user_connections` WHERE `receiver_user_id` = '$_SESSION[logged_in_user_id]' AND `connection_status` = 'pending' ";
		$res = $db->query($sql) or die($db->error);
		while($row = $res->fetch_array()) {

			$sqlU = "SELECT * FROM `users` WHERE `user_id` = '$row[sender_user_id]' ";
			$resU = $db->query($sqlU) or die($db->error);
			$rowU = $resU->fetch_array();
			
			print '<li>
				<img src="'.$rowU['photo'].'"/>
				<div class="c-cart-menu-content" style="padding-top: 10px;">
					<a href="./profiles/'.$rowU['user_id'].'" class="c-item-name c-font-sbold"><p>'.$rowU['fullname'].'</p></a>
					Sent a Connection Request

					<a href="connections.php?action=accept&user_id='.$row['sender_user_id'].'" class="btn btn-sm c-btn c-btn-square c-theme-btn c-font-white c-font-bold c-center"> Accept</a>

					<a href="connections.php?action=reject&user_id='.$row['sender_user_id'].'" class="btn btn-sm c-btn c-btn-square c-theme-btn c-font-white c-font-bold c-center"> Reject</a>

				</div>
			</li>';

		}


		//Messages
		$sql = "SELECT DISTINCT `sender_user_id` FROM `messages` WHERE `receiver_user_id` = '$_SESSION[logged_in_user_id]' AND `receiver_message_status` = 'unread' ";
		$res = $db->query($sql) or die($db->error);
		while($row = $res->fetch_array()) {


			$sql2 = "SELECT * FROM `messages` WHERE `receiver_user_id` = '$_SESSION[logged_in_user_id]' AND `receiver_message_status` = 'unread' AND `sender_user_id` = '$row[0]' ";
			$res2 = $db->query($sql2) or die($db->error);
			$num = $res2->num_rows; 
			$row2 = $res2->fetch_array();

			$sql3 = "SELECT * FROM `users` WHERE `user_id` = '$row[sender_user_id]' ";
			$res3 = $db->query($sql3) or die($db->error);
			$row3 = $res3->fetch_array();

				print '<li>
			<img src="'.$row3['photo'].'"/>
			<div class="c-cart-menu-content" style="padding-top: 10px;">
				<a href="./profiles/'.$row3['user_id'].'" class="c-item-name c-font-sbold"><p>'.$row3['fullname'].'</p></a>
				Sent '.$num.' new message(s)

				<a href="messages/'.$row['sender_user_id'].'" class="btn btn-sm c-btn c-btn-square btn-success c-font-white c-font-bold c-center"> Read</a>

			</div>
		</li>';
		}

		?>


	</ul> 
	<div class="c-cart-menu-footer">
		<a href="./all_messages" class="btn btn-md c-btn c-btn-square c-theme-btn c-font-white c-font-bold c-center c-font-uppercase"> Messages</a>
		<a href="./connections" class="btn btn-md c-btn c-btn-square c-theme-btn c-font-white c-font-bold c-center c-font-uppercase"> Connects</a>

	</div>
</div>
<!-- END: CART MENU --><!-- END: LAYOUT/HEADERS/QUICK-CART -->



		</div>
	</div>



</header>
<!-- END: HEADER --><!-- END: LAYOUT/HEADERS/HEADER-1 -->
<div style="padding-top: 100px;">
