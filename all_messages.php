<?php
include "lib/config.php";
include "lib/login_check.php";

include "lib/header.php";

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
				
				<?php
				$show_sidebar_account = true;
				include "lib/sidebar.php";
				?>				

				</div>

				
				<div class="col-sm-9" style="border: 1px solid silver;margin-top: 0px; min-height: 500px;">
					<div class="c-content-feature-1">
					
					<!--- start center contents ------------------------------------------- -->
					<!--- start center contents ------------------------------------------- -->
					<!--- start center contents ------------------------------------------- -->
    
   <h1>All Messages</h1>

   <?php

   $count = 0;
   $sql = "SELECT * FROM `messages` WHERE 
   	(`receiver_user_id` = '$_SESSION[logged_in_user_id]' AND `receiver_message_status` != 'deleted' )
   	 OR (`sender_user_id` = '$_SESSION[logged_in_user_id]')  ORDER BY `message_id` DESC";
   $res = $db->query($sql);
   $num = $res->num_rows;

   if($num<1)
   	 print "<div class = \"alert alert-success\">No Messages</div>";
   	else
   		print '
   <TABLE ALIGN = CENTER BORDER = 1 CELLPADDING = 10 class = "table table-striped">
   <TR>
      <TH>No</TH>
      <TH>Date</TH>
      <TH>Message</TH>
      <TH>Sender</TH>
   </TR>';

   while($row = $res->fetch_array())
   {

		$sql2 = "SELECT * FROM `users` WHERE `user_id` = '$row[sender_user_id]' ";
		$res2 = $db->query($sql2) or die($db->error);
		$row2 = $res2->fetch_array();

      $count++;
      print "
      <TR>
         <TD>$count</TD>
         <TD>".date("D, d-m-y, h:i a",$row['timestamp'])."</TD>
         <TD>$row[message]</TD>
         <TD><a href = \"./messages/$row2[user_id]\"><u>$row2[fullname]</u></a></TD>
      </TR>";

   }

   if($num>0)
   	print '</TABLE>';
   ?>

   			 
          
		</div>

		<hr>
		
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