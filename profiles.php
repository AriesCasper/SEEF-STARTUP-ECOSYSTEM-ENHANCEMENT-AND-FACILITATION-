<?php
include "lib/config.php";
//Connections
if( isset($_GET['action']) ) {

	$action = trim($_GET['action']);
	$id     = trim($_GET['id']);

	if($action == "connect") {
		$sql = "INSERT INTO `user_connections`(`sender_user_id`, `receiver_user_id`, `connection_status`, `sent_on_timestamp`) VALUES ('$_SESSION[logged_in_user_id]','$id','pending','".time()."')";
		$db->query($sql) or die($db->error);
		//$msg = "Connection request sent";

		header("Location: ./profiles/".$id);
	}

	if($action == "remove") {
		$sql = "DELETE FROM `user_connections` WHERE
		(`sender_user_id` = '$_SESSION[logged_in_user_id]' AND `receiver_user_id` = '$id')
					OR
				(`sender_user_id` = '$id' AND `receiver_user_id` = '$_SESSION[logged_in_user_id]')
		";
		$db->query($sql) or die($db->error);
		//$msg = "Connection request sent";

		header("Location: ./profiles/".$id);
	}

}

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
				
				<img src = "<?php print $row['photo'];?>" width = "100%" style = "border: 1px solid silver;" >
				<center><h2> &nbsp;<?php print $row['fullname'];?></h2></center>

				
				<center>
					<?php

				//Connection: 
				$sqlC = "SELECT * FROM `user_connections` WHERE 

				(`sender_user_id` = '$_SESSION[logged_in_user_id]' AND `receiver_user_id` = '$_GET[profile_id]')
					OR
				(`sender_user_id` = '$_GET[profile_id]' AND `receiver_user_id` = '$_SESSION[logged_in_user_id]')
				 ";
				$resC = $db->query($sqlC);
				$numC = $resC->num_rows;

				if($numC == 0 ) {
					if($_GET['profile_id']!=$_SESSION['logged_in_user_id']) {
						print '<a href = "./profiles.php?action=connect&id='.$_GET['profile_id'].'"><button type="submit" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">Connect</button></a>';
					}
					
				}
				else
				{
					$rowC = $resC->fetch_array();
					if($rowC['connection_status'] == "accepted")
						print '<a href = "./profiles.php?action=remove&id='.$_GET['profile_id'].'" onclick = "return confirm(\'Are you sure you want to remove your connection?\')"><button type="submit" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">Disconnect</button></a>';

					if($rowC['connection_status'] == "rejected")
						print '<a href = "./profiles.php?action=connect&id='.$_GET['profile_id'].'"><button type="submit" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">Connect</button></a>';

					if($rowC['connection_status'] == "pending")
						print '<button type="submit" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">Connect Request Sent</button>';

				}

				?>
				 </center>
				 <hr><b>Qualification:</b> <?php print $row['qualification'];?>

				<hr><b>About:</b> <?php print $row['about'];?>
				<hr><b>Skills:</b> <?php print $row['skills'];?>
				<hr><b>Projects:</b> <?php print $row['projects'];?>

				<hr><b>From:</b> <?php print $row['address_city'];?>, <?php print $row['address_country'];?>

				<hr>
				</div>

				<div class="col-sm-9" style="border: 1px solid silver;margin-top: 0px; min-height: 500px;">
					<div class="c-content-feature-1">
					
					<!--- start center contents ------------------------------------------- -->
					<!--- start center contents ------------------------------------------- -->
					<!--- start center contents ------------------------------------------- -->
    
    <h1><?=$fname?>'s Work History:</h1>

   
   <?php
   

   $count = 0;
   $sql = "SELECT * FROM `user_work_history` WHERE `user_id` = '$_GET[profile_id]'  ORDER BY `sort_order` DESC";
   $res = $db->query($sql);
   $num = $res->num_rows;

   if($num<1)
   	 print "<div class = \"alert alert-success\">No Work History added by user</div>";
   	else
   		print '
   <TABLE ALIGN = CENTER BORDER = 1 CELLPADDING = 10 class = "table table-striped">
   <TR>
      <TH>No.</TH>
      <TH>Start Date</TH>
      <TH>End Date</TH>
      <TH>Designation</TH>
      <TH>Company</TH>
      <TH>Summary</TH>
   </TR>';

   while($row = $res->fetch_array())
   {
      $count++;
      print "
      <TR>
         <TD>$count</TD>
         <TD>$row[start_date]</TD>
         <TD>$row[end_date]</TD>
         <TD>$row[designation]</TD>
         <TD>$row[company_name]</TD>
         <TD>$row[summary]</TD>

        
      </TR>";

   }

   if($num>0)
   	print '</TABLE>';
   ?>

   <hr>

	<h1><?=$fname?>'s Education History:</h1>

   
   <?php
   

   $count = 0;
   $sql = "SELECT * FROM `user_education_history` WHERE `user_id` = '$_GET[profile_id]'  ORDER BY `sort_order` DESC";
   $res = $db->query($sql);
   $num = $res->num_rows;

   if($num<1)
   	 print "<div class = \"alert alert-success\">No Education History added by user</div>";
   	else
   		print '
   <TABLE ALIGN = CENTER BORDER = 1 CELLPADDING = 10 class = "table table-striped">
   <TR>
      <TH>No.</TH>
      <TH>Start Date</TH>
      <TH>End Date</TH>
      <TH>Course</TH>
      <TH>Organization</TH>
   </TR>';

   while($row = $res->fetch_array())
   {
      $count++;
      print "
      <TR>
         <TD>$count</TD>
         <TD>$row[start_date]</TD>
         <TD>$row[end_date]</TD>
         <TD>$row[course]</TD>
         <TD>$row[organization]</TD>

        
      </TR>";

   }

   if($num>0)
   	print '</TABLE>';
   ?>

   			 
        
					<!--- end   center contents ------------------------------------------- -->
					<!--- end   center contents ------------------------------------------- -->
					<!--- end   center contents ------------------------------------------- -->

		<hr>
		<h1><?=$fname?>'s Connections:</h1>
		<div class="row">
		<?php

		/*
		SELECT * FROM `user_connections` WHERE `sender_user_id` = '$user_id' AND `connection_status` = 'accepted';
		use the `receiver_user_id` from this table.

		SELECT * FROM `user_connections` WHERE `receiver_user_id` = '$user_id' AND `connection_status` = 'accepted';
		use the `sender_user_id` from this table
		*/

		$friends = [];

		$sql = "SELECT * FROM `user_connections` WHERE `sender_user_id` = '$_GET[profile_id]' AND `connection_status` = 'accepted'  ";
		$res = $db->query($sql) or die($db->error);
		while($row = $res->fetch_array()) 
			$friends[] = $row['receiver_user_id'];
		

		$sql = "SELECT * FROM `user_connections` WHERE `receiver_user_id` = '$_GET[profile_id]' AND `connection_status` = 'accepted'  ";
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
				<div class="col-md-2 col-sm-3 c-margin-b-10">
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
		?>
			
		</div>


		<?php
		if( $_SESSION['logged_in_user_id'] != $_GET['profile_id'] )
		{
			//Allow only connected useds to send messages
			$sqlC = "SELECT * FROM `user_connections` WHERE 
			(`sender_user_id` = '$_SESSION[logged_in_user_id]' AND `receiver_user_id` = '$_GET[profile_id]')
				OR
			(`sender_user_id` = '$_GET[profile_id]' AND `receiver_user_id` = '$_SESSION[logged_in_user_id]')
			 ";
			$resC = $db->query($sqlC);
			$is_connected = $resC->num_rows;

			if($is_connected == 0)
				print "<hr><center><b>You cannot send a message to this user since you are not connected.</b></center>";
			else
			{
		?>
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
							<h3  class="c-font-uppercase c-font-bold">Send <?=$fname?> a message:</h3>
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
		<?php
			}
		}
		else {
			print "<br><center><hr>A messaging form will be shown here to other people.</center><br><br><br><br>";
		}
		?>


					</div>
				</div>



			</div>
		</div>

		
</div>

<?php
include "lib/footer.php";
?>