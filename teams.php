<?php
include "lib/config.php";
include "lib/login_check.php";

if( isset($_POST['role']) ) {

	$role     = $_POST['role'];
	$comments = $_POST['comments'];
	$startup_id = $_GET['startup_id'];

	$sql = "SELECT * FROM `startup_members` WHERE `startup_id` = '$_GET[startup_id]' AND `user_id` = '$_SESSION[logged_in_user_id]' ";
	$res = $db->query($sql) or die($db->error);
	$row = $res->fetch_array();

	if($row == false ){
		$sql = "INSERT INTO `startup_members`( `startup_id`, `user_id`, `user_role`, `comments`, `timestamp`, `approval_status`) VALUES ('$startup_id','$_SESSION[logged_in_user_id]','$role','$comments','".time()."','unapproved')";
		$db->query($sql);
		$msg = "Thank you, Your application will be reviewed by the Startup Admin. ";

		//////////////
		// Add auto message to Admin

		$sql = "SELECT * FROM `startups` WHERE `startup_id` = '$_GET[startup_id]'";
	   $res = $db->query($sql);
	   $row = $res->fetch_array();
	   $admin = $row['user_id'];

		$sql = "INSERT INTO `messages`(`sender_user_id`, `receiver_user_id`, `message`, `timestamp`, `deleted_by_sender`, `receiver_message_status`) VALUES ('$_SESSION[logged_in_user_id]','$admin','I have applied for your startup `$row[title]`. Please review my application. [System Generated message]','".time()."','no','unread')";

		$db->query($sql) or die($db->error);

		//////////////

	} else 
		$msg = "Sorry, You have already applied for this Startup . ";
	
}
include "lib/header.php";
?>

<div class="c-layout-page" style="margin-top: 0px; margin-bottom: 0px;">
<img src="./assets/base/img/content/backgrounds/header2.jpg" width="100%"  style="margin-top: -120px;">

	<!-- BEGIN: FULL PAGE TEXT CONTENT -->

		<div class="c-content-box c-size-md c-bg-white" style="margin-top: 0px; min-height: 500px;">
		<div class="container">

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
		<div class="col-md-6 ">
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
				<div class="col-md-6 ">

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
				      <TH>Role</TH>
				      <TH>Status</TH>
				   </TR>';

				   while($row = $res->fetch_array())
				   {

						$sql2 = "SELECT * FROM `users` WHERE `user_id` = '$row[user_id]' ";
						$res2 = $db->query($sql2) or die($db->error);
						$row2 = $res2->fetch_array();

				      $count++;

				      $bg = "bg-success";
				      if($row['approval_status'] == "unapproved") 
				      	$bg = "bg-danger";

				      print "
				      <TR class = \"bg $bg\">
				         <TD>$count</TD>
				         <TD><img src = \"$row2[photo]\" width = 50></TD>
				         <TD><a href = profiles/$row[user_id]>$row2[fullname]</a></TD>
				         <TD>$row[user_role]</TD>
				         <TD>$row[approval_status]</TD>
				      </TR>";

				   }

				   print '</TABLE>';
				   ?>

					</div>

					<hr>

					<div style="border: 2px solid silver; padding: 20px; border-radius: 10px;">
					  <h1>Apply - Join the Team</h1>
     					 You can Apply for a position in this Startup and contact the Admin for approval.
				      <form  name = rForm class="form-horizontal" method="POST" enctype="multipart/form-data">

				      <?php

				      $sql = "SELECT * FROM `startup_members` WHERE `startup_id` = '$_GET[startup_id]' AND `user_id` = '$_SESSION[logged_in_user_id]' ";
						$res = $db->query($sql) or die($db->error);
						$row = $res->fetch_array();

						if(isset($row["approval_status"]) && $row["approval_status"] == "unapproved")
							print '<div class="alert alert-info">You have already applied. Please contact Startup Admin for approval.</div>';
				      
				      if( isset($msg) )
				      	print '<div class="alert alert-info">'.$msg.'</div>';
				      ?>

				         <div class="form-group">
					         <label for="text" class="col-md-4 control-label">Your Primary Role</label>
					            <div class="col-md-8">
					            	<small>Select your preferred main role in this startup</small>
						            <select class="form-control c-square c-theme" id="role" name="role" required>
						                 <option value="Undecided">Undecided Yet</option>
						                 <?php

						            $sql = "SELECT * FROM `roles`  ";
										$res = $db->query($sql) or die($db->error);
										while($row = $res->fetch_array()) {
											print "<option value=\"$row[role_name]\">$row[role_name]</option>";
										}

						                 ?>
							        </select>

						       </div>
						      </div>
  

				         <div class="form-group">
				         <label for="inputEmail3" class="col-md-4 control-label">Any Comments</label>
				            <div class="col-md-8">
				             <textarea name="comments" class="form-control c-square c-theme" placeholder="This is private and will be shown to the Startup admin only."></textarea>
				              </div>
				        </div>


				        <div class="form-group">
				        <label class="col-md-4 control-label"></label>
				        <div class="col-md-8">
				           <input type='SUBMIT' name='btnsubmit' value=" Apply " class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">
				        </div>
				        </div>

				      </form>
					</div>

					
						</div>
		</div>

		
</div>

<?php
include "lib/footer.php";
?>