<?php
include "lib/config.php";
include "lib/login_check.php";

if( isset($_POST['update_user_id'])) {

  $update_user_id = $_SESSION['logged_in_user_id'];// For Safety! Dont use Post.;
   
  if( $_FILES['photo']['name']) {

        $arr = explode(".",   strtolower( $_FILES['photo']['name'] )  );
        $ext = end($arr);
      
        if($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png" || $ext == "bmp" ) {
          $pic_name = "user_images/pic_".$update_user_id.".".$ext;
          @mkdir("user_images");
          copy($_FILES['photo']['tmp_name'], $pic_name);

          $sql = "UPDATE `users` SET `photo` = '$pic_name' WHERE `user_id` = '$update_user_id'";
          $db->query($sql);
        }  
  }
    Header("Location: user_msg.php?msg=2");
}

include "lib/header.php";

$update_sql = "SELECT * FROM `users` WHERE `user_id` = '$_SESSION[logged_in_user_id]'";
$update_res = $db->query($update_sql);
$update_row = $update_res->fetch_array();
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
     
      <form action = edit_photo name = rForm class="form-horizontal" method="POST" enctype="multipart/form-data" >

       <input type="hidden" name="update_user_id" value = "<?php print $update_row['user_id'];?>">

        <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Upload a new Photo *</label>
            <div class="col-md-4">
             <input type="file"   accept='image/*' class="form-control c-square c-theme" id="inputEmail3" placeholder="Your Full Name" name="photo" required>
            </div>
        </div>

        <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-4">
         
           <input type='SUBMIT' name='btnsubmit' value=" Update " class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">
        </div>
        </div>

      </form>
    </div>
  </div>
        <center>
           Your Current photo:
            <br>
            <img src = "<?php print $update_row['photo'];?>" style = "max-width: 500px;">
        </center>
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