<?php
include "lib/config.php";


include "lib/header.php";

if(isset($_POST['comment'])) {
	$sql = "INSERT INTO `post_comments`( `post_id`, `user_id`, `comment`, `timestamp`) VALUES ('$_GET[post_id]','$_SESSION[logged_in_user_id]', '$_POST[comment]', '".time()."')";
	$db->query($sql);
	$msg = "Your comment has been posted";
}

?>

<div class="c-layout-page" style="margin-top: 0px; margin-bottom: 0px;">
<img src="./assets/base/img/content/backgrounds/header2.jpg" width="100%"  style="margin-top: -120px;">


	<!-- BEGIN: FULL PAGE TEXT CONTENT -->

		<div class="c-content-box c-size-md c-bg-white" style="margin-top: 0px; min-height: 500px;">
		<div class="container">
			<div class="row" style="margin-top: -40px; ">
					
  			<!--- start center contents ------------------------------------------- -->
					<!--- start center contents ------------------------------------------- -->
					<!--- start center contents ------------------------------------------- -->
    
   <h1> Post </h1>

   <?php

   $count = 0;
   $sql = "SELECT * FROM `posts` WHERE `post_id` = '$_GET[post_id]'";
   $res = $db->query($sql);
   $row = $res->fetch_array();
   
$sql2 = "SELECT * FROM `users` WHERE `user_id` = '$row[user_id]' ";
		$res2 = $db->query($sql2) or die($db->error);
		$row2 = $res2->fetch_array();

		$file = $row['user_file'];

		//If no photo uploaded, show user profile pic in post
		if($row2['photo'] != "")
			$post_pic = $row2['photo'];
		else
			$post_pic = "images/no_pic.png";

		//Attachment
		$post_attachment = "";

		if( stripos($file, ".") < 1)
			$file_link = "";
		else {
			$arr = explode(".",   strtolower( $file)  );
		   $ext = end($arr);
		  
		   if($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png" || $ext == "webp" || $ext == "bmp") {
		   	$post_pic = $file;
		   }
		   else
		   	$post_attachment = "File Attached: <a href = \"$file\" target = _blank><u>Download $ext</u></a>";
		}
		 
		//Have I Liked this?
		$sql3 = "SELECT * FROM `post_likes` WHERE `user_id` = '$_SESSION[logged_in_user_id]' AND `post_id` = '$row[post_id]' ";
		$res3 = $db->query($sql3) or die($db->error);
		$row3 = $res3->fetch_array();
		if($row3)
			$like_link = "<a href = posts.php?post_id=$row[post_id]&action=unlike><img src = images/liked.png width = 30></a>";
		else
			$like_link = "<a href = posts.php?post_id=$row[post_id]&action=like><img src = images/like.png width = 30></a>";

		//How many total likes?
		$sql4 = "SELECT * FROM `post_likes` WHERE `post_id` = '$row[post_id]' ";
		$res4 = $db->query($sql4) or die($db->error);
		$total_likes = $res4->num_rows;

			//How many total comments?
		$sql5 = "SELECT * FROM `post_comments` WHERE `post_id` = '$row[post_id]' ";
		$res5 = $db->query($sql5) or die($db->error);
		$total_comments = $res5->num_rows;

      $dt = date("D, d-M-Y, h:i a",$row['timestamp']);

      print <<<EOF
		<div class="col-md-6 ">
			<div class="c-content-blog-post-card-1 c-option-2 c-bordered " style = "border: 4px solid silver; border-radius: 10px;">			  			
	  			<div class="c-media c-content-overlay">
	  				<div class="c-overlay-wrapper">
		  				<div class="c-overlay-content">
			  				<a href="$post_pic" name = "post_$row[post_id]" data-lightbox="fancybox" data-fancybox-group="gallery">
			  					<i class="icon-magnifier"></i>
			  				</a>
			  			</div>
	  				</div>
	  				<img class="c-overlay-object img-responsive" src="$post_pic" alt="">
	  			</div>
	  			<div class="c-body">
		  			
		  			<div style = "background: #FFFFEE; padding: 10px 20px 8px 20px; color: black; margin: -10px; font-weight: strong;">
			  			<b>$row[content]</b>
	                </div>

		  			<div class="c-author">
		  				By <a href="./profiles/$row2[user_id]"><span class="c-font-uppercase">$row2[fullname]</span></a>
		  				on <span class="c-font-uppercase">$dt</span>
		  			</div>

		  			<div class="c-panel">	
		  				<ul class="c-tags ">
							<li>$total_likes</li>
							<li>Likes</li>
							<li>$like_link</li>
							<li>$post_attachment</li>
						</ul>						
						<div class="c-comments"><a href="comments?post_id=$row[post_id]"><i class="icon-speech"></i> $total_comments comments</a></div>
					</div>
			  		
                </div>
            </div>
		</div>

EOF;

   ?>
		<div class="col-md-6 ">

			<div class="c-comments">

				<div class="c-content-title-1">
					<h3 class="c-font-uppercase c-font-bold">Comments</h3>
					<div class="c-line-left"></div>
					<?php
					if(isset($msg))
						print "<div class = \"alert alert-success\">$msg</div>";
					?>
				</div>

				<div class="c-comment-list">
					<?php

					$sql = "SELECT * FROM `post_comments` WHERE  `post_id` = '$_GET[post_id]' ORDER BY `post_comment_id` DESC ";
				    $res = $db->query($sql);

				    while($row = $res->fetch_array())
				    {

				    	$sql2 = "SELECT * FROM `users` WHERE `user_id` = '$row[user_id]' ";
						$res2 = $db->query($sql2) or die($db->error);
						$row2 = $res2->fetch_array();

						//If no photo uploaded, show user profile pic in post
						if($row2['photo'] != "")
							$post_pic = $row2['photo'];
						else
							$post_pic = "images/no_pic.png";

						$dt = date("D, d-M-Y, h:i a",$row['timestamp']);

				    print <<<NIKHIL
					
					<div class="media">
					   	<div class="media-body">
					      	<h4 class="media-heading"><a href="./profiles/$row2[user_id]" class="c-font-bold">$row2[fullname]</a> on <span class="c-date">$dt</span></h4>
					       	$row[comment]
					   	</div>
					</div>
NIKHIL;
					}
					?>

				</div>

				<div class="c-content-title-1">
					<hr>
					<div class="c-line-left"></div>
					<h3 class="c-font-uppercase c-font-bold">Leave A Comment</h3>
					
				</div>

				<form method = "post">
					
                   	<div class="form-group">
                   		<textarea rows="3" name="comment" placeholder="Write comment here ..." class="form-control c-square"></textarea>
                    </div>
                    <div class="form-group">
                    	<button type="submit" class="btn c-theme-btn c-btn-uppercase btn-md c-btn-sbold btn-block c-btn-square">Submit</button> 
                    </div>
               	</form>

		</div>	   			 
          

	</div>
</div>

		
</div>

<?php
include "lib/footer.php";
?>