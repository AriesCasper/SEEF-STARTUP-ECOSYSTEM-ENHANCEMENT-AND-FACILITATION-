<?php 
include "includes/config.php";
include "includes/login_check.php";

if(isset($_POST['newp'])){
  $current_password   = md5($_POST['currentp']);
  $new_password       = $_POST['newp'];
  $confirm_password   = $_POST['confirmp'];

  $sql = "SELECT * FROM `administrator` WHERE  `password` = '$current_password' AND `id` = '$_SESSION[admin_logged_in_user_id]'";
  $res = $db->query($sql);
  $row = $res->fetch_object();

  $num = $res->num_rows;
  if($num>0){

      if($new_password == $confirm_password){

          $new_password = md5($new_password);
          $sql = "UPDATE `administrator` SET `password` = '$new_password' WHERE `id` = '$_SESSION[admin_logged_in_user_id]' ";
          $db->query($sql);

          Header("location: home.php?msg=Password has been changed");
      }
      else {
          $msg =  '<div class="alert alert-success alert-dismissible" role="alert">
                New and Confirm Password doesnot matched
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      }
  }
  else {
    $msg = '<div class="alert alert-success alert-dismissible" role="alert">
                Current Password doesnot matched
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  }

}

include "includes/header.php";

?>
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Change</span> Password</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-8">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">

                      <?php 
                        if(isset($msg)){
                          print $msg;
                        }

                      ?>
                      
                    </div>
                    <div class="card-body">
                      <form method = "post" action  = "change_password.php">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Current Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="basic-default-name" placeholder="Current Password" name = "currentp" required/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-company">New Password</label>
                          <div class="col-sm-10">
                            <input
                              type="password"
                              class="form-control"
                              id="basic-default-company"
                              placeholder="New Password" name = "newp" required
                            />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-company">Confirm Password</label>
                          <div class="col-sm-10">
                            <input
                              type="password"
                              class="form-control"
                              id="basic-default-company"
                              placeholder="Confirm Password" name = "confirmp" required
                            />
                          </div>
                        </div>
                       
                      
                       
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary ">Change</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Basic with Icons -->
                
              </div>
            </div>
<?php 
include "includes/footer.php";


?>