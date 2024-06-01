<?php 
include "includes/config.php";
include "includes/login_check.php";
include "includes/header.php";

$sql = "SELECT * FROM `administrator` WHERE `id` = '$_SESSION[admin_logged_in_user_id]'";
$res = $db->query($sql);
$row = $res->fetch_object();


/*    Update Account */

if(isset($_POST['fullname'])){
    $sql = "UPDATE `administrator` SET `fullname` = '$_POST[fullname]', `username` = '$_POST[username]', `email` = '$_POST[email]' WHERE `id` = '$_SESSION[admin_logged_in_user_id]'";
    $db->query($sql);

    $msg = '<div class="alert alert-success alert-dismissible text-center" role="alert" >
                      Your account has been updated
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
}

/* Update Account Ends */

if(isset($_POST['accountActivation'])){

  $sql = "DELETE FROM `administrator` WHERE `id` = '$_SESSION[admin_logged_in_user_id]'";
  //$db->query($sql);

  $msg = '<div class="alert alert-success alert-dismissible text-center" role="alert" >
          Your account has been Deleted Permanently
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}


?>

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-notifications.html"
                        ><i class="bx bx-bell me-1"></i> Notifications</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-connections.html"
                        ><i class="bx bx-link-alt me-1"></i> Connections</a
                      >
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <?php 
                        print isset($msg) ? $msg : "";
                      ?>
                      <!-- <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="../assets/img/avatars/1.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>

                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                      </div> -->
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" action = "account.php">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">FullName</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="fullname"
                              value="<?=$row->fullname?>"
                              autofocus required
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">UserName</label>
                            <input class="form-control" type="text" name="username" id="lastName" value="<?=$row->username ?>" required/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="<?=$row->email?>"
                              placeholder="john.doe@example.com" required
                            />
                          </div>
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                           <a href = "change_password.php" class="btn btn-primary me-2">Change Password</a>
                         
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                      <form id="formAccountDeactivation"  method = "post" action = "account.php">
                        <div class="form-check mb-3">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            name="accountActivation"
                            id="accountActivation" required
                          />
                          <label class="form-check-label" for="accountActivation"
                            >I confirm my account deactivation</label
                          >
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

<?php 
include "includes/footer.php";

?>