<?php
include "lib/config.php";
include "lib/login_check.php";

if(isset($_POST['content'])) {

	$sql = "INSERT INTO `posts`( `user_id`, `content`, `user_file`, `timestamp`) VALUES 
	('$_SESSION[logged_in_user_id]','$_POST[content]','','".time()."')";
	$db->query($sql);

	@mkdir("user_posts_files");

	$id = $db->insert_id;
  
	if( $_FILES['user_file']['name']) {

	    $arr = explode(".",   strtolower( $_FILES['user_file']['name'] )  );
	    $ext = end($arr);
	  
	    if($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png" || $ext == "bmp" || $ext == "doc" || $ext == "docx" || $ext == "rtf" || $ext == "pdf" || $ext == "txt" || $ext == "html" || $ext == "htm" || $ext == "xls" || $ext == "csv" || $ext == "zip" || $ext == "mp4" || $ext == "mov" ) {

	      $file_name = "user_posts_files/post_".$id."_".time().".".$ext;
	      copy($_FILES['user_file']['tmp_name'], $file_name);

	      $sql = "UPDATE `posts` SET `user_file` = '$file_name' WHERE `post_id` = '$id'";
	      $db->query($sql);
	    }  
	}

	$msg = "Your Post has been Published";
}

include "lib/header.php";

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
    

<div class="c-content-box c-size-md">
  <div class="container">
     <div id="filters-container" class="cbp-l-filters-button">

     <h1>Add New Post</h1>
     
     <?php

     if( isset($msg))
     	print "<br><div class = \"alert alert-success\">$msg</div><br><br>";
     ?>

      <form action = posts_add name = rForm class="form-horizontal" method="POST" enctype="multipart/form-data">
       

         <div class="form-group">
            <div class="col-md-8">
             <textarea class = "editor" name="content" class="form-control c-square c-theme" placeholder="Whats on your mind?" style="min-width: 500px; min-height: 700px;" required></textarea>
              </div>
        </div>


         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Attachment (Image/Document/Video)</label>
            <div class="col-md-4">
             <input type="file" name="user_file" accept='image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain,video/mp4,video/x-m4v,video/*'  class="form-control c-square c-theme">
              </div>
        </div>        


        <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-4">
         
           <input type='SUBMIT' name='btnsubmit' value=" Post " class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">
        </div>
        </div>

      </form>
    </div>
  </div>
        
					<!--- end   center contents ------------------------------------------- -->
					<!--- end   center contents ------------------------------------------- -->
					<!--- end   center contents ------------------------------------------- -->
					</div>
				</div>


			</div>
		</div>
	<!-- BEGIN: FULL PAGE TEXT CONTENT -->

</div>



<?php
include "lib/footer.php";
?>


  <link href="./assets/summernote/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/summernote/bootstrap.min.js"></script>

  <link href="./assets/summernote/summernoteNik.min.css" rel="stylesheet">
  <script src="./assets/summernote/summernote.min.js"></script>

   <script>
    $(document).ready(function() {
       $('.editor').summernote({
       	        height: 200, // Set editor height

       	toolbar: [
          // Add your custom buttons here
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link']],
          ['view', ['fullscreen', 'codeview']]
        ]
       });
    });
  </script>
