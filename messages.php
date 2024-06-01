<?php
include "lib/config.php";
include "lib/header.php";


//Mark all messages as read
$sql = "UPDATE `messages` SET  `receiver_message_status` = 'read' WHERE `receiver_user_id` = '$_SESSION[logged_in_user_id]' AND `sender_user_id` = '$_GET[profile_id]' ";
$db->query($sql);



$sql = "SELECT * FROM `users` WHERE `user_id` = '$_GET[profile_id]' ";
$res = $db->query($sql) or die($db->error);
$row = $res->fetch_array();

if( isset($_POST['message'])) {

	$sql = "INSERT INTO `messages`(`sender_user_id`, `receiver_user_id`, `message`, `timestamp`, `deleted_by_sender`, `receiver_message_status`) VALUES ('$_SESSION[logged_in_user_id]','$_GET[profile_id]','$_POST[message]','".time()."','no','unread')";

	$db->query($sql) or die($db->error);

	$msg = "Your message has been sent.";
}


$temp = explode(" ", trim($row['fullname'] ));
$fname = $temp[0];
?>

<div class="c-layout-page" style="margin-top: 0px; margin-bottom: 0px;">
<img src="./assets/base/img/content/backgrounds/header2.jpg" width="100%"  style="margin-top: -120px;">


	<!-- BEGIN: FULL PAGE TEXT CONTENT -->

		<div class="c-content-box c-size-md c-bg-white" style="margin-top: 0px; min-height: 500px;">
		<div class="container">
			<div class="row" style="margin-top: -40px; ">
					

				<div class="col-sm-3" style="border: 0px solid silver;">
				
				<img src = "<?php print $row['photo'];?>" width = "100%" style = "border: 1px solid silver;" >
				<center><h2> &nbsp;<?php print $row['fullname'];?></h2></center>

				<hr>Qualification: <?php print $row['qualification'];?>
				<hr>From: <?php print $row['address_city'];?>, <?php print $row['address_country'];?>

				</div>

				<div class="col-sm-9" style="border: 1px solid silver;margin-top: 0px; min-height: 500px;">
					<div class="c-content-feature-1">
					
					<!--- start center contents ------------------------------------------- -->
					<!--- start center contents ------------------------------------------- -->
					<!--- start center contents ------------------------------------------- -->
    
   <h1>Messages with <?=$fname?>:</h1>
   <hr>
   <?php


   $count = 0;
   $sql = "SELECT * FROM `messages` WHERE 
   	(`receiver_user_id` = '$_SESSION[logged_in_user_id]' AND `receiver_message_status` != 'deleted' AND `sender_user_id` = '$_GET[profile_id]' )
   	 OR (`sender_user_id` = '$_SESSION[logged_in_user_id]') AND `receiver_user_id` = '$_GET[profile_id]'  ORDER BY `message_id` DESC";
   $res = $db->query($sql);
   $num = $res->num_rows;

   if($num<1)
   	 print "<div class = \"alert alert-success\">No Messages</div>";
   	else
   		print '
   ';

   while($row = $res->fetch_array())
   {

		$sql2 = "SELECT * FROM `users` WHERE `user_id` = '$row[sender_user_id]' ";
		$res2 = $db->query($sql2) or die($db->error);
		$row2 = $res2->fetch_array();

		$bgcol = "#eee";
		$float = "left";
		if($row['sender_user_id'] == $_SESSION['logged_in_user_id']) {
			$bgcol = "#efe";
			$float = "right";
		}
      $count++;

      print "
      <div style = \"background: $bgcol; padding: 20px; border-radius: 20px;\">
      	<b style = \"float: $float;\">$row[message]</b>
      	<br><small style = \"float: right;\">$count - $row2[fullname] - ".date("D, d-m-y, h:i a",$row['timestamp'])."</small>
      </div>
      <br>";

   }

   if($num>0)
   	print '</TABLE>';
   ?>

   			 
          
		</div>

		<hr>
		<div style="padding: 40px;">
		<div class="row">
			<div class="col">
				<div class="c-contact">
						<div class="c-content-title-1">
							<a name = "contact"> </a>

							<?php
							if(isset($msg))
								print "<br><br><br><div class = \"alert alert-success\">$msg</div>";
							?>
							<h3  class="c-font-uppercase c-font-bold">Send <?=$fname?> a new message:</h3>
							<p class="c-font-lowercase">Please remember to be respectful and professional</p>
						</div>

						<form method="post" action="./profiles/<?=$_GET['profile_id'];?>#contact">
		                   	<div class="form-group">
                        	   <textarea rows="6" required name="message" placeholder="Write message here ..." class="form-control c-theme c-square input-lg"></textarea>
		                    </div>
		                    <button type="submit" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">Send Message</button> 
	                   	</form>
					</div>
			</div>
		</div>
		</div>
					</div>
				</div>



			</div>
		</div>

		
</div>

<?php
include "lib/footer.php";
?>