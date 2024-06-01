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

if( isset($_GET['del_id']) ) {
	$sql = "DELETE FROM `posts` WHERE `post_id` = '$_GET[del_id]' AND `user_id` = '$_SESSION[logged_in_user_id]'";
	$db->query($sql);
	$msg = "<div class = \"alert alert-success\">Deleted Successfully</div>";
}
include "lib/header.php";

?>

<div class="c-layout-page" style="margin-top: 0px; margin-bottom: 0px;">
<img src="./assets/base/img/content/backgrounds/header2.jpg" width="100%"  style="margin-top: -120px;">


	<!-- BEGIN: FULL PAGE TEXT CONTENT -->

		<div class="c-content-box c-size-md c-bg-white" style="margin-top: 0px; min-height: 500px;">
		<div class="container">
		<?php
		if( isset($msg)) print $msg; 
		?>
		<div class="row">
	<?php

   $count = 0;
   $sql = "SELECT * FROM `posts` WHERE `user_id` = '$_SESSION[logged_in_user_id]' ORDER BY `post_id` DESC LIMIT 0, 100 ";
   $res = $db->query($sql);

   while($row = $res->fetch_array())
   {

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
		$post_video = "";

		if( stripos($file, ".") < 1)
			$file_link = "";
		else {
			$arr = explode(".",   strtolower( $file)  );
		   $ext = end($arr);
		  
		   if($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png" || $ext == "webp" || $ext == "bmp") {
		   	$post_pic = $file;
		   }
		   if($ext == "mp4" || $ext == "mov") {
		   	$post_video = $file;
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

      if($post_video) {
      	$video_html = "<video src = \"$post_video\" width = 100% controls></video>";
      	$pic_html = "";
      }
      else {
      	$video_html = "";

      	$pic_html = 
      		<<<EOF
      		<div class="c-overlay-wrapper">
		  				<div class="c-overlay-content">
			  				<a href="comments?post_id=$row[post_id]" name = "post_$row[post_id]" > <button>Comments</button> </a>
			  				<a href="$post_pic" data-lightbox="fancybox" data-fancybox-group="gallery">
			  					<i class="icon-magnifier"></i>
			  				</a>
			  			</div>
	  				</div>
EOF;
$pic_html .= "<img class=\"c-overlay-object img-responsive\" src=\"$post_pic\">";
      }

      print <<<EOF
		<div class="col-md-6 ">
			<div class="c-content-blog-post-card-1 c-option-2 c-bordered " style = "border: 4px solid silver; border-radius: 10px;">			  			
	  			<div class="c-media c-content-overlay">
	  				
	  				$video_html $pic_html
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
			  		

			  		<a href = "posts_manage?del_id=$row[post_id]" onclick = "return confirm('Are you sure?')"><button class = "btn btn-danger">Delete</a></a>
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