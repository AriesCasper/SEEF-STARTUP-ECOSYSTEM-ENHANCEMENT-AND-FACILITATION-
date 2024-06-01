<?php
include "lib/config.php";

if( strlen($_POST['captcha']) != 5)
  die("Not Human");


$sql = "SELECT * FROM `users` WHERE `email` = '$_POST[email]'";
$res = $db->query($sql) or die($db->error);
$num = $res->num_rows;

if($num) {
  Header("Location: register.php?msg=Your Email is already registered with us. Please Try Login instead of Registering or use a different Email ID. You can also try Forgot Password."); 
  die("Header Err");
}

if($_POST['btnsubmit'] == "Submit" || true)
{

  $latlong = getLatLong($_POST['pincode']);

  $_POST['password'] = md5(trim($_POST['password']));
  
  $sql = "INSERT INTO `users` (`user_id`,`fullname`,`qualification`,`age`,`gender`,`email`,`password`,`password_remember_cookie`,`phone`,`photo`,`cv`,`about`,`skills`,`projects`,`address_line_1`,`address_line_2`,`address_city`,`address_state`,`address_country`,`address_pin`, `address_latlong`, `registered_on_ts`,`registered_from_ip`,`status`,`admin_comments`) VALUES ('','$_POST[fullname]','$_POST[qualification]','$_POST[age]','$_POST[gender]','$_POST[email]','$_POST[password]','$_POST[password_remember_cookie]','$_POST[phone]','','','$_POST[about]','$_POST[skills]','$_POST[projects]','$_POST[address_line_1]','$_POST[address_line_2]','$_POST[address_city]','$_POST[address_state]','$_POST[address_country]','$_POST[pincode]','$latlong','".time()."','$_SERVER[REMOTE_ADDR]','active','') ";
  $db->query($sql);

  $id = $db->insert_id;
  
  if( $_FILES['photo']['name']) {

        $arr = explode(".",   strtolower( $_FILES['photo']['name'] )  );
        $ext = end($arr);
      
        if($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png" || $ext == "bmp" ) {
          $pic_name = "registrations/pic_".$id.".".$ext;
          @mkdir("registrations");
          copy($_FILES['photo']['tmp_name'], $pic_name);

          $sql = "UPDATE `users` SET `photo` = '$pic_name' WHERE `user_id` = '$id'";
          $db->query($sql);
        }  

  }
  
  if( $_FILES['cv']['name']) {

        $arr = explode(".",   strtolower( $_FILES['cv']['name'] )  );
        $ext = end($arr);
      
        if($ext == "doc" || $ext == "docx" || $ext == "txt" || $ext == "pdf" || $ext == "rtf"  || $ext == "html" ) {
          $cv_name = "registrations/cv_".$id.".".$ext;
          @mkdir("registrations");
          copy($_FILES['cv']['tmp_name'], $cv_name);

          $sql = "UPDATE `users` SET `cv` = '$cv_name' WHERE `user_id` = '$id'";
          $db->query($sql);
        }  

  }


$mail_content = "

Registration on Online Training:

Fullname: $_POST[fullname]
Email: $_POST[email]
Qualification: $_POST[qualification]
Phone: $_POST[phone]
Address: $_POST[address]
Pic Path: http://einsteinz.in/$pic_name

Regards,

FreshersIndia.com Team";


$headers = 'From: info@freshersindia.com' . "\r\n" .
  'Reply-To: info@freshersindia.com' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

$to   = "ipeg.solutions@gmail.com";
$subject="IMP: $_POST[plan] Registration ";
@mail($to,$subject,$mail_content,$headers);

}



function getLatLong($pin) 
{

if(!trim($pin))
  return "";

  $all_pincodes = explode("\n",trim(file_get_contents("./github_pin_and_lat_long.csv")));
  unset($all_pincodes[0]);

  $code = "IN/".trim($pin);
  foreach ($all_pincodes as $line) {
    if(stripos($line, $code) !== false) {
      $arr = explode(",", trim($line));
      return $arr[3].",".$arr[4];
    }
  }

  $code = substr($code,0,8);
  foreach ($all_pincodes as $line) {
    if(stripos($line, $code) !== false) {
      $arr = explode(",", trim($line));
      return $arr[3].",".$arr[4];
    }
  }

  $code = substr($code,0,7);
  foreach ($all_pincodes as $line) {
    if(stripos($line, $code) !== false) {
      $arr = explode(",", trim($line));
      return $arr[3].",".$arr[4];
    }
  }
return "";
}

include "lib/header.php";
?>

<!-- BEGIN: FEATURES 1 -->
  <div class="c-content-box c-size-md c-bg-white" style="margin-top: 20px; min-height: 400px;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="c-content-feature-1">
            <h3 class="c-font-uppercase c-font-bold">Thank you for registering.</h3>
            <p class="c-font-thin">
              Your registration will be processed and activated within then next 2-3 working days. Please contact us for any queries. 
              You may access the Free sections for now. Click <a href = login.ruby><u>here to Login</u></a> now.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END: FEATURES 1 -->
  


<?php
include "lib/footer.php";
?>