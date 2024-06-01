<?php
include "lib/config.php";
include "lib/login_check.php";

if(isset($_POST['update_user_id']) ){

  $update_user_id = $_SESSION['logged_in_user_id'];// For Safety! Dont use Post.;
   

  if( $_FILES['cv']['name']) {

        $arr = explode(".",   strtolower( $_FILES['cv']['name'] )  );
        $ext = end($arr);
      
        if($ext == "doc" || $ext == "docx" || $ext == "txt" || $ext == "pdf" || $ext == "rtf"  || $ext == "html" ) {
          $cv_name = "registrations/cv_".$update_user_id.".".$ext;
          @mkdir("registrations");
          copy($_FILES['cv']['tmp_name'], $cv_name);

          $sql = "UPDATE `users` SET `cv` = '$cv_name' WHERE `user_id` = '$update_user_id'";
          $db->query($sql);
        }  

  }

    Header("Location: user_msg.php?msg=3");
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
     
      <form action = edit_cv name = rForm class="form-horizontal" method="POST" enctype="multipart/form-data" >

      
       <input type="hidden" name="update_user_id" value = "<?php print $update_row['user_id'];?>">

         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Upload a new CV *</label>
            <div class="col-md-4">
             <input type="file"   accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"  class="form-control c-square c-theme" id="inputEmail3"  name="cv" required>
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
           
            <br>
            <a href = "<?php print $update_row['cv'];?>" target = "_blank"> Click here to see your current CV </a>
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