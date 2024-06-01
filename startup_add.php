<?php
include "lib/config.php";
include "lib/login_check.php";

if(isset($_POST['title'])) {

	$sql = "INSERT INTO `startups`(`user_id`, `title`, `public_summary`, `logo`, `info_url`, `added_timestamp`, `status`) VALUES ('$_SESSION[logged_in_user_id]','$_POST[title]','$_POST[public_summary]','','$_POST[info_url]','".time()."', 'unverified_by_admin')";
	$db->query($sql);

	@mkdir("startup_photos");

	//Add Logo if there.
	$id = $db->insert_id;
  
	if( $_FILES['logo']['name']) {

	    $arr = explode(".",   strtolower( $_FILES['logo']['name'] )  );
	    $ext = end($arr);
	  
	    if($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png" || $ext == "bmp" ) {
	      $pic_name = "startup_photos/logo_".$id.".".$ext;
	      copy($_FILES['logo']['tmp_name'], $pic_name);

	      $sql = "UPDATE `startups` SET `logo` = '$pic_name' WHERE `startup_id` = '$id'";
	      $db->query($sql);
	    }  
	}

	//Add Role of the USER - The approval_status is always approved cause this is the startup creator
	$sql = "INSERT INTO `startup_members`(`startup_id`, `user_id`, `user_role`, `timestamp`, `approval_status`) VALUES ('$id','$_SESSION[logged_in_user_id]','$_POST[role]','".time()."','approved') ";

	$db->query($sql);

	Header("Location: user_msg.php?msg=10");

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

     <h1>Add New Startup</h1>
     
      <form action = startup_add name = rForm class="form-horizontal" method="POST" enctype="multipart/form-data">

         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Startup Name *</label>
            <div class="col-md-4">
             <input type="text" name="title" class="form-control c-square c-theme" required placeholder="Your Startup name / Codename">
              </div>
        </div>        

         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">About/Summary *</label>
            <div class="col-md-4">
             <textarea name="public_summary" class="form-control c-square c-theme" placeholder="Tell something about your Startup to everyone."></textarea>
              </div>
        </div>


         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Logo/Graphic</label>
            <div class="col-md-4">
             <input type="file" name="logo" accept='image/*'  class="form-control c-square c-theme">
              </div>
        </div>        



         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Website/Page</label>
            <div class="col-md-4">
             <input type="text" name="info_url" class="form-control c-square c-theme"  placeholder="Link to your website or social page about the startup">
              </div>
        </div>        

        <div class="form-group">
         <label for="text" class="col-md-2 control-label">Your Primary Role</label>
            <div class="col-md-4">
            	<small>Select your main role in this startup</small>
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
        <label class="col-md-2 control-label"></label>
        <div class="col-md-4">
         
           <input type='SUBMIT' name='btnsubmit' value=" Add Startup " class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">
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