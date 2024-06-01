<?php
include "lib/config.php";
include "lib/login_check.php";

if(isset($_POST['update_user_id'])) {

  $update_user_id = $_SESSION['logged_in_user_id'];// For Safety! Dont use Post.;
   

  if( $_POST['password']) {

        $_POST['password'] = md5(trim($_POST['password']));
        $sql = "UPDATE `users` SET `password` = '$_POST[password]' WHERE `user_id` = '$update_user_id'";
        $db->query($sql);
  }

    Header("Location: user_msg.php?msg=4");
}

include "lib/header.php";

$update_sql = "SELECT * FROM `users` WHERE `user_id` = '$_SESSION[logged_in_user_id]'";
$update_res = $db->query($update_sql);
$update_row = $update_res->fetch_array();


    $msg = "Your password has been updated.";
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
     <script type="text/javascript">
        function verify()
        {
          
          if(document.rForm.password.value != document.rForm.confirm_password.value ) {
             alert('Password and Confirm Password do not match');
             document.rForm.confirm_password.focus();
            return false;
          }
          return true;
        }
      </script>

<div class="c-content-box c-size-md">
  <div class="container">
     <div id="filters-container" class="cbp-l-filters-button">
     
      <form action = edit_password name = rForm class="form-horizontal" method="POST" enctype="multipart/form-data"  onsubmit="return verify();">

    

       <input type="hidden" name="update_user_id" value = "<?php print $update_row['user_id'];?>">
       <b>Please enter your new password twice:</b>
       <br><br>
         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Password *</label>
            <div class="col-md-4">
             <input type="password" name="password" class="form-control c-square c-theme" id="inputPasswordX"  minlength="5" required>
              </div>
        </div>
        
        <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Confirm Password *</label>
            <div class="col-md-4">
             <input type="password" name="confirm_password" class="form-control c-square c-theme" id="inputPasswordY"  minlength="5" required>
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