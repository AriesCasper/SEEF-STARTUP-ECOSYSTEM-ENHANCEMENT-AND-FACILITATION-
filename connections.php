<?php
include 'lib/config.php';
include "lib/login_check.php";

if( isset($_GET['action'])) {
	
	$action  = $_GET['action'];
	$user_id = $_GET['user_id'];

	if($action == "accept") {
		$sql = "UPDATE `user_connections` SET `connection_status` = 'accepted' WHERE `sender_user_id` = '$user_id' AND `receiver_user_id` = '$_SESSION[logged_in_user_id]'  ";
		$res = $db->query($sql) or die($db->error);
		$msg = "Connection Accepted";
	}

	if($action == "reject") {
		$sql = "DELETE FROM `user_connections` WHERE `sender_user_id` = '$user_id' AND `receiver_user_id` = '$_SESSION[logged_in_user_id]'  ";
		$res = $db->query($sql) or die($db->error);
		$msg = "Connection Rejected";
	}
	
}

include 'lib/header.php';

?>


<div class="c-content-box c-size-md c-bg-grey-1">

<!-- BEGIN: CONTENT/MISC/TEAM-3 -->
	 

<!-- BEGIN: CONTENT/MISC/TEAM-3 -->
<div class="c-content-box c-size-md c-bg-grey-1">
	<div class="container">
		<!-- Begin: Testimonals 1 component -->
		<div class="c-content-team-1-slider" data-slider="owl" data-items="3">
			<!-- Begin: Title 1 component -->
			<div class="c-content-title-1">
				<h3 class="c-center c-font-uppercase c-font-bold">My Connections</h3>
				<div class="c-line-center c-theme-bg"></div>
			</div>
			<!-- End-->
			 <?php
			 if( isset($msg))
			 	print "<div class = \"alert alert-success\">$msg</div>";
			 ?>

		<div class="row">
			<div class="col-sm-3" style="border: 0px solid silver;">
				
				<?php
				$show_sidebar_account = true;
				include "lib/sidebar.php";
				?>				

			</div>

				
				<div class="col-sm-9" style="border: 1px solid silver;margin-top: 0px; min-height: 500px;">
		<?php


		$friends = [];

		$sql = "SELECT * FROM `user_connections` WHERE `sender_user_id` = '$_SESSION[logged_in_user_id]' AND `connection_status` = 'accepted'  ";
		$res = $db->query($sql) or die($db->error);
		while($row = $res->fetch_array()) 
			$friends[] = $row['receiver_user_id'];
		

		$sql = "SELECT * FROM `user_connections` WHERE `receiver_user_id` = '$_SESSION[logged_in_user_id]' AND `connection_status` = 'accepted'  ";
		$res = $db->query($sql) or die($db->error);
		while($row = $res->fetch_array()) 
			$friends[] = $row['sender_user_id'];
		

		foreach($friends as $friend) {
			$sql2 = "SELECT * FROM `users` WHERE `user_id` = '$friend' ";
			$res2 = $db->query($sql2) or die($db->error);
			$row2 = $res2->fetch_array();

			if($row2==null)
				continue;

			$fullname  = $row2['fullname'];
			$fullname   = substr( $fullname, 0, 15);

			//print "<a href=\"./profiles/$row2[user_id]\"><img src = \"$row2[photo]\" width = 100> </a> &nbsp; ";

			print <<<EOF


				<!-- start record -->
				<!-- start record -->
				<div class="col-md-3 col-sm-4	 c-margin-b-10">
					<div class="c-content-person-1 c-option-2">
			  			<a href="./profiles/$row2[user_id]"><div class="c-caption c-content-overlay">
			  				<div class="c-overlay-wrapper">
				  				 
			  				</div>
			  				<img class="c-overlay-object img-responsive" src="$row2[photo]" alt="" style="width: 100%;" >
			  			</div></a>
			  			<div class="c-body">
				  			<div class="c-head">
				  				<div class="c-name c-font-uppercase c-font-bold"><a href="./profiles/$row2[user_id]">$fullname</a></div>
				  				
				  			</div>
					  		
		        </div>
	        	</div>
				</div>
				<!-- end record -->
				<!-- end record -->

EOF;	
		}


		// $id = $row['sender_user_id'];

		// 	$sql2 = "SELECT * FROM `users` WHERE `user_id` = '$id' ";
		// 	$res2 = $db->query($sql2) or die($db->error);
		// 	$row2 = $res2->fetch_array();

		// 	print "<img src = \"$row2[photo]\" width = 100> &nbsp; ";

		if(count($friends) == 0)
			print "<center>You have no connections yet. Visit the members section.</center>";
		?>
			
		</div>
		</div>

	    </div>
	    <!-- End-->
	</div>
</div><!-- END: CONTENT/MISC/TEAM-3 -->
  
		

<?php
include 'lib/footer.php';
?>

