<?php
include "lib/config.php";
include "lib/login_check.php";

if( isset($_GET['action']) ) {

	$action = $_GET['action'];
	$startup_member_id = $_GET['startup_member_id'];

	if( $action == "delete") {
		//Nik - For Security, check the user owns this Startup first by matching with session ID
		//Or else someone can delete other members.
		$sql = "DELETE FROM `startup_members` WHERE `startup_member_id` = '$startup_member_id' ";
		$res = $db->query($sql) or die($db->error);
		
	}

	if( $action == "approve") {
		//Nik - For Security, check the user owns this Startup first by matching with session ID
		//Or else someone can delete other members.
		$sql = "UPDATE `startup_members` SET `approval_status` = 'approved' WHERE `startup_member_id` = '$startup_member_id' ";
		$res = $db->query($sql) or die($db->error);

		//////////////
		// Add auto message to User

		$sql = "SELECT * FROM `startups` WHERE `startup_id` = '$_GET[startup_id]'";
	   $res = $db->query($sql);
	   $row = $res->fetch_array();
	   $admin = $row['user_id'];

		$sql = "INSERT INTO `messages`(`sender_user_id`, `receiver_user_id`, `message`, `timestamp`, `deleted_by_sender`, `receiver_message_status`) VALUES ('$_SESSION[logged_in_user_id]','$startup_member_id','Congratulations. I have approved your role in our  startup `$row[title]`.  [System Generated message]','".time()."','no','unread')";

		$db->query($sql) or die($db->error);

		//////////////
		
	}

	if( $action == "unapprove") {
		//Nik - For Security, check the user owns this Startup first by matching with session ID
		//Or else someone can delete other members.
		$sql = "UPDATE `startup_members` SET `approval_status` = 'unapproved' WHERE `startup_member_id` = '$startup_member_id' ";
		$res = $db->query($sql) or die($db->error);
		
	}
	// '$_SESSION[logged_in_user_id]'

}

include "lib/header.php";
?>

<div class="c-layout-page" style="margin-top: 0px; margin-bottom: 0px;">
<img src="./assets/base/img/content/backgrounds/header2.jpg" width="100%"  style="margin-top: -120px;">

	<!-- BEGIN: FULL PAGE TEXT CONTENT -->

		<div class="c-content-box c-size-md c-bg-white" style="margin-top: 0px; min-height: 500px;">
		<div class="container">
<?php

$sqlX = "SELECT * FROM `startups` WHERE `user_id` = '$_SESSION[logged_in_user_id]'";
$resX = $db->query($sqlX);

while($rowX = $resX->fetch_array())
{

	$_GET['startup_id'] = $rowX['startup_id'];
   	?>
		<div class="row">
		<?php

   $count = 0;
   $sql = "SELECT * FROM `startups` WHERE `startup_id` = '$_GET[startup_id]'";
   $res = $db->query($sql);

   while($row = $res->fetch_array())
   {

		$sql2 = "SELECT * FROM `users` WHERE `user_id` = '$row[user_id]' ";
		$res2 = $db->query($sql2) or die($db->error);
		$row2 = $res2->fetch_array();

		//If no photo uploaded, show user profile pic in post
		if($row['logo'] == "")
			$logo_pic = $row2['photo'];
		else
			$logo_pic = $row['logo'];
		 
		
      $dt = date("D, d-M-Y, h:i a", $row['added_timestamp']);

      //How many total members?
		$sql4 = "SELECT * FROM `startup_members` WHERE `startup_id` = '$row[startup_id]' ";
		$res4 = $db->query($sql4) or die($db->error);
		$total_members = $res4->num_rows;

		if($total_members == 1)
			$total_members = $total_members. " Member";
		else
			$total_members = $total_members. " Members";

      print <<<EOF
		<div class="col-md-12 ">
			<div class="c-content-blog-post-card-1 c-option-2 c-bordered " style = "border: 4px solid silver; border-radius: 10px;">			  			
	  			<div class="c-media c-content-overlay">
	  				<div class="c-overlay-wrapper">
		  				<div class="c-overlay-content">
			  				<a href="teams?startup_id=$row[startup_id]" name = "post_$row[startup_id]" > <button>More Details</button> </a>
			  				<a href="$logo_pic" data-lightbox="fancybox" data-fancybox-group="gallery">
			  					<i class="icon-magnifier"></i>
			  				</a>
			  			</div>
	  				</div>
	  				<img class="c-overlay-object img-responsive" src="$logo_pic" alt="" style = "border-radius: 5px;" width = "100%">
	  			</div>
	  			<div class="c-body">
		  			
		  			<div style = "background: #EEFFFF; padding: 10px 30px 8px 30px; color: black; margin: -30px; font-weight: strong;">
			  			<br><b><a href="teams?startup_id=$row[startup_id]" name = "post_$row[startup_id]" >$row[title]</a></b>
			  			<br><br>$row[public_summary]<br><br>
	            </div>
	            <br><br>
		  			<div class="c-author">
		  				By <a href="./profiles/$row2[user_id]"><span class="c-font-uppercase">$row2[fullname]</span></a>
		  				on <span class="c-font-uppercase">$dt</span>
		  			</div>

		  			<div class="c-panel">	
		  				<ul class="c-tags ">
							<li></li>
							<li>$total_members </li>
						</ul>						
						
					</div>
			  		
                </div>
            </div>
		</div>
		

EOF;
   }

   ?>
				<div class="col-md-12 ">

					<div>

				   <h1> Members</h1>

				   <?php

				   $count = 0;
				   $sql = "SELECT * FROM `startup_members` WHERE `startup_id` = '$_GET[startup_id]'";
				   $res = $db->query($sql);
				   
				   
				   print '
				   <TABLE ALIGN = CENTER BORDER = 1 CELLPADDING = 10 class = "table ">
				   <TR>
				      <TH>No</TH>
				      <TH>Pic</TH>
				      <TH>Name</TH>
				      <TH>CV</TH>
				      <TH>Role</TH>
				      <TH>Status</TH>
				      <TH>Action</TH>
				   </TR>';

				   while($row = $res->fetch_array())
				   {

				   	if($row['approval_status'] == "approved") {
					   	$action = "
					   	<a href = startup_manage?action=unapprove&startup_member_id=$row[startup_member_id]><b>Unapprove</b></a>
					   	<br>
					   	<a onclick = \"return confirm('Are you you want to DELETE?')\" href = startup_manage?action=delete&startup_member_id=$row[startup_member_id]>Delete</a>
					   		";
				   	}
				   	if($row['approval_status'] == "unapproved") {
					   	$action = "
					   	<a href = startup_manage?action=approve&startup_member_id=$row[startup_member_id]><b>Approve</b></a>
					   	<br>
					   	<a onclick = \"return confirm('Are you you want to DELETE?')\" href = startup_manage?action=delete&startup_member_id=$row[startup_member_id]>Delete</a>
					   		";
				   	}

				   	if($row['user_id'] == $_SESSION['logged_in_user_id'])
				   		$action = " - self -";


						$sql2 = "SELECT * FROM `users` WHERE `user_id` = '$row[user_id]' ";
						$res2 = $db->query($sql2) or die($db->error);
						$row2 = $res2->fetch_array();

				      $count++;

				      $bg = "bg-success";
				      if($row['approval_status'] == "unapproved") 
				      	$bg = "bg-danger";

				      if($row2['cv'] != "")
				      	$cv = "<a href = \"$row2[cv]\" download >CV</a>";
				      else
				      	$cv = "No CV";

				      print "
				      <TR class = \"bg $bg\">
				         <TD>$count</TD>
				         <TD><img src = \"$row2[photo]\" width = 50></TD>
				         <TD>$row2[fullname]</TD>
				         <TD>$cv</TD>
				         <TD><a href = profile/$row[user_id]>$row[user_role]</a></TD>
				         <TD>$row[approval_status]</TD>
				         <TD>$action</TD>
				      </TR>";

				   }

				   if($num>0)
				   	print '</TABLE>';
				   ?>

					</div>

					 <hr>
					
					</div>

						<?php
					}
					?>
		</div>

		
</div>

<?php
include "lib/footer.php";
?>