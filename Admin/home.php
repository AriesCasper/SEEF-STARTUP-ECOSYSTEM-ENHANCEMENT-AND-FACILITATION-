<?php 
include "includes/config.php";
include "includes/login_check.php";
include "includes/header.php";



?>
<div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        
      </h4>

      <div class="row">
        <!-- Basic Buttons -->

        <div class="col-12">
          <div class="card mb-4">
            <h5 class="card-header"></h5>
            <div class="card-body">
            	<?php
			    if(isset($_GET['msg'])){
					print '<div class="alert alert-success alert-dismissible text-center" role="alert" >
			                '.$_GET['msg'].'
			                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			            </div>';
				}
				?>
              
            <h2 class = "text-center">Hello Welcome to Admin Panel!!</h2>
            
          </div>
        </div>
       </div>
   	</div>
</div>

<?php 
include "includes/footer.php";


?>