<?php
include "lib/config.php";
include "lib/login_check.php";

if(isset($_POST['start_date'])) {


	$sql = "INSERT INTO `user_work_history`( `user_id`, `start_date`, `end_date`, `designation`, `company_name`, `summary`, `sort_order`) 
		VALUES ('$_SESSION[logged_in_user_id]','$_POST[start_date]','$_POST[end_date]','$_POST[designation]','$_POST[company_name]','$_POST[summary]', '".time()."')";
	$db->query($sql);

	Header("Location: user_msg.php?msg=5");

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

     <h1>Add New Work</h1>
     
      <form action = add_work name = rForm class="form-horizontal" method="POST" enctype="multipart/form-data">

      
       <br><br>
         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Start Date *</label>
            <div class="col-md-4">
             <input type="date" name="start_date" class="form-control c-square c-theme"   required>
              </div>
        </div>
        
       
         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">End Date </label>
            <div class="col-md-4">
             <input type="date" name="end_date" class="form-control c-square c-theme" >
             (Leave blank if still continuing)
              </div>
        </div>

        
         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Designation *</label>
            <div class="col-md-4">
             <input type="text" name="designation" class="form-control c-square c-theme" required >
              </div>
        </div>

        
         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Company Name *</label>
            <div class="col-md-4">
             <input type="text" name="company_name" class="form-control c-square c-theme" required >
              </div>
        </div>        

         <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Job Summary</label>
            <div class="col-md-4">
             <textarea name="summary" class="form-control c-square c-theme"></textarea>
              </div>
        </div>


        <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-4">
         
           <input type='SUBMIT' name='btnsubmit' value=" Add work " class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">
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