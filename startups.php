<?php
include "lib/config.php";
include "lib/login_check.php";

if( isset($_GET['action']) ) {

	$action = $_GET['action'];
	$post_id = $_GET['post_id'];

	if($action == "like") {
		$sql = "INSERT INTO `post_likes`( `post_id`, `user_id`) VALUES ('$post_id','$_SESSION[logged_in_user_id]')";
		$db->query($sql);
		header("Location: ./posts#post_".$post_id);
	}
	if($action == "unlike") {
		$sql = "DELETE FROM `post_likes` WHERE `post_id` = '$post_id' AND `user_id` = '$_SESSION[logged_in_user_id]'";
		$db->query($sql);
		header("Location: ./posts#post_".$post_id);
	}

	//Go to AHREF :: post_$row[post_id]
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
   $sql = "SELECT * FROM `startups` WHERE 1 ORDER BY `startup_id` DESC LIMIT 0, 100";
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
			
						</div>
		</div>

		
</div>

<?php
include "lib/footer.php";
?>