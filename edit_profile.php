<?php
include "lib/config.php";
include "lib/login_check.php";

if(isset($_POST['update_user_id'])) {

    $update_user_id = $_SESSION['logged_in_user_id'];// For Safety! Dont use Post.;
    $latlong = getLatLong($_POST['pincode']);

    $sql = "UPDATE `users` 
            SET 
                `fullname` = '$_POST[fullname]',
                `qualification` = '$_POST[qualification]',
                `gender` = '$_POST[gender]',
                `email` = '$_POST[email]',
                `phone` = '$_POST[phone]',

                `projects` = '$_POST[projects]',
                `skills` = '$_POST[skills]',
                `about` = '$_POST[about]',


                `address_line_1` = '$_POST[address_line_1]',
                `address_line_2` = '$_POST[address_line_2]',
                `address_city` = '$_POST[address_city]',
                `address_state` = '$_POST[address_state]',
                `address_country` = '$_POST[address_country]',
                `address_pin` = '$_POST[pincode]',
                `address_latlong` = '$latlong'
             WHERE `user_id` = '$update_user_id' ";
    $db->query($sql);
    //Header("Location: user_msg.php?msg=1");

    $msg = "Your profile has been updated.";
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
     
      <form action = edit_profile name = rForm class="form-horizontal" method="POST" enctype="multipart/form-data" >
        
        <?php
        if( isset( $msg) )
            print "<div class = \"alert alert-success\" style = \"width: 50%;\"> <b>$msg</b> </div><hr>";
        ?>  

       <input type="hidden" name="update_user_id" value = "<?php print $update_row['user_id'];?>">

        <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Full Name *</label>
            <div class="col-md-4">
             <input type="text" class="form-control c-square c-theme" id="inputEmail3" placeholder="Your Full Name" name="fullname" value = "<?php print $update_row['fullname'];?>" required>
            </div>
        </div>

      <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label"> &nbsp; </label>
            <div class="col-md-4">
             <table>
                <tr>
                    <td>Select Gender </td>
                    <?php
                    $m=$f="";
                    ($update_row['gender'] == "Male")?$m = "checked":$f="checked";
                    ?>
                    <td>&nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; Female &nbsp;   </td>
                    <td> <input type="radio"  name="gender" value = "Female" required <?php print $f;?> ></td>
                    <td> &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; Male &nbsp;  </td>
                    <td> <input type="radio"  name="gender" value = "Male" required <?php print $m;?>></td>
                </tr>
              </table>
            
            </div>
        </div>

        <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Email *</label>
            <div class="col-md-4">
             <input type="email" name="email" class="form-control c-square c-theme" id="inputPassword3" placeholder="Email" required value = "<?php print $update_row['email'];?>" >
              </div>
        </div>
        
        <div class="form-group">
         <label for="text" class="col-md-2 control-label">Highest Qualification</label>
            <div class="col-md-4">
             <input type="text" class="form-control c-square c-theme" id="inputPassword3" placeholder="Highest Qualification"name="qualification" required value = "<?php print $update_row['qualification'];?>" >
            </div>
        </div>
          
        <div class="form-group">
         <label for="inputPassword3" class="col-md-2    control-label">Phone *
         </label>
             <div class="col-md-4">
              <input type="text" class="form-control c-square c-theme" id="inputPassword3" placeholder="10 digit Phone" name="phone"required  title="Please enter a 10 digit phone with any starting 0 or country code"  value = "<?php print $update_row['phone'];?>" > <!-- pattern="[1-9]{1}[0-9]{9}" --> 
             </div>
        </div>

            
        <div class="form-group">
         <label for="inputPassword3" class="col-md-2 control-label">About Me
         </label>
             <div class="col-md-4">
              <textarea name="about" rows="3" cols="6" class="form-control c-square c-theme" id="inputPassword3" name="nm5" placeholder="Something about you"><?php print $update_row['about'];?></textarea>
            </div>
        </div>  
      
        <div class="form-group">
         <label for="inputPassword3" class="col-md-2 control-label">My Skills
         </label>
             <div class="col-md-4">
              <textarea name="skills" rows="3" cols="6" class="form-control c-square c-theme" id="inputPassword3" name="nm5" placeholder="Something about your skills"><?php print $update_row['skills'];?></textarea>
            </div>
        </div>  
      
        <div class="form-group">
         <label for="inputPassword3" class="col-md-2 control-label">Projects
         </label>
             <div class="col-md-4">
              <textarea name="projects" rows="3" cols="6" class="form-control c-square c-theme" id="inputPassword3" name="nm5" placeholder="Something which you did"><?php print $update_row['projects'];?></textarea>
            </div>
        </div>  
       

        <div class="form-group">
         <label for="text" class="col-md-2 control-label">Address Line 1</label>
            <div class="col-md-4">
             <input type="text" class="form-control c-square c-theme" id="address_line_1" name="address_line_1" required value = "<?php print $update_row['address_line_1'];?>" >
            </div>
        </div>

        <div class="form-group">
         <label for="text" class="col-md-2 control-label">Address Line 2</label>
            <div class="col-md-4">
             <input type="text" class="form-control c-square c-theme" id="address_line_2"  name="address_line_2"  value = "<?php print $update_row['address_line_2'];?>" >
            </div>
        </div>

      <div class="form-group">
         <label for="inputEmail3" class="col-md-2 control-label">Address City *</label>
            <div class="col-md-4">
             <table>
                <tr>
                    <td><input type="text" class="form-control c-square c-theme" id="address_city" placeholder="City" name="address_city" required value = "<?php print $update_row['address_city'];?>" ></td>
                    <td> State </td>
                    <td><select class="form-control c-square c-theme" id="address_state" name="address_state" required>
                    <option value="<?php print $update_row['address_state'];?>"><?php print $update_row['address_state'];?></option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                    <option value="Daman and Diu">Daman and Diu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Lakshadweep">Lakshadweep</option>
                    <option value="Puducherry">Puducherry</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telangana">Telangana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="West Bengal">West Bengal</option>
                    <option value="Other">Other</option>
                    </select> </td>
                </tr>
              </table>
            
            </div>
        </div>

        <div class="form-group">
         <label for="text" class="col-md-2 control-label">Country</label>
            <div class="col-md-4">
             <select class="form-control c-square c-theme" id="address_country" name="address_country">
                 <option value = "<?php print $update_row['address_country'];?>" ><?php print $update_row['address_country'];?></option>
                 <option value="Afganistan">Afghanistan</option>
                 <option value="Albania">Albania</option>
                 <option value="Algeria">Algeria</option>
                 <option value="American Samoa">American Samoa</option>
                 <option value="Andorra">Andorra</option>
                 <option value="Angola">Angola</option>
                 <option value="Anguilla">Anguilla</option>
                 <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                 <option value="Argentina">Argentina</option>
                 <option value="Armenia">Armenia</option>
                 <option value="Aruba">Aruba</option>
                 <option value="Australia">Australia</option>
                 <option value="Austria">Austria</option>
                 <option value="Azerbaijan">Azerbaijan</option>
                 <option value="Bahamas">Bahamas</option>
                 <option value="Bahrain">Bahrain</option>
                 <option value="Bangladesh">Bangladesh</option>
                 <option value="Barbados">Barbados</option>
                 <option value="Belarus">Belarus</option>
                 <option value="Belgium">Belgium</option>
                 <option value="Belize">Belize</option>
                 <option value="Benin">Benin</option>
                 <option value="Bermuda">Bermuda</option>
                 <option value="Bhutan">Bhutan</option>
                 <option value="Bolivia">Bolivia</option>
                 <option value="Bonaire">Bonaire</option>
                 <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                 <option value="Botswana">Botswana</option>
                 <option value="Brazil">Brazil</option>
                 <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                 <option value="Brunei">Brunei</option>
                 <option value="Bulgaria">Bulgaria</option>
                 <option value="Burkina Faso">Burkina Faso</option>
                 <option value="Burundi">Burundi</option>
                 <option value="Cambodia">Cambodia</option>
                 <option value="Cameroon">Cameroon</option>
                 <option value="Canada">Canada</option>
                 <option value="Canary Islands">Canary Islands</option>
                 <option value="Cape Verde">Cape Verde</option>
                 <option value="Cayman Islands">Cayman Islands</option>
                 <option value="Central African Republic">Central African Republic</option>
                 <option value="Chad">Chad</option>
                 <option value="Channel Islands">Channel Islands</option>
                 <option value="Chile">Chile</option>
                 <option value="China">China</option>
                 <option value="Christmas Island">Christmas Island</option>
                 <option value="Cocos Island">Cocos Island</option>
                 <option value="Colombia">Colombia</option>
                 <option value="Comoros">Comoros</option>
                 <option value="Congo">Congo</option>
                 <option value="Cook Islands">Cook Islands</option>
                 <option value="Costa Rica">Costa Rica</option>
                 <option value="Cote DIvoire">Cote DIvoire</option>
                 <option value="Croatia">Croatia</option>
                 <option value="Cuba">Cuba</option>
                 <option value="Curaco">Curacao</option>
                 <option value="Cyprus">Cyprus</option>
                 <option value="Czech Republic">Czech Republic</option>
                 <option value="Denmark">Denmark</option>
                 <option value="Djibouti">Djibouti</option>
                 <option value="Dominica">Dominica</option>
                 <option value="Dominican Republic">Dominican Republic</option>
                 <option value="East Timor">East Timor</option>
                 <option value="Ecuador">Ecuador</option>
                 <option value="Egypt">Egypt</option>
                 <option value="El Salvador">El Salvador</option>
                 <option value="Equatorial Guinea">Equatorial Guinea</option>
                 <option value="Eritrea">Eritrea</option>
                 <option value="Estonia">Estonia</option>
                 <option value="Ethiopia">Ethiopia</option>
                 <option value="Falkland Islands">Falkland Islands</option>
                 <option value="Faroe Islands">Faroe Islands</option>
                 <option value="Fiji">Fiji</option>
                 <option value="Finland">Finland</option>
                 <option value="France">France</option>
                 <option value="French Guiana">French Guiana</option>
                 <option value="French Polynesia">French Polynesia</option>
                 <option value="French Southern Ter">French Southern Ter</option>
                 <option value="Gabon">Gabon</option>
                 <option value="Gambia">Gambia</option>
                 <option value="Georgia">Georgia</option>
                 <option value="Germany">Germany</option>
                 <option value="Ghana">Ghana</option>
                 <option value="Gibraltar">Gibraltar</option>
                 <option value="Great Britain">Great Britain</option>
                 <option value="Greece">Greece</option>
                 <option value="Greenland">Greenland</option>
                 <option value="Grenada">Grenada</option>
                 <option value="Guadeloupe">Guadeloupe</option>
                 <option value="Guam">Guam</option>
                 <option value="Guatemala">Guatemala</option>
                 <option value="Guinea">Guinea</option>
                 <option value="Guyana">Guyana</option>
                 <option value="Haiti">Haiti</option>
                 <option value="Hawaii">Hawaii</option>
                 <option value="Honduras">Honduras</option>
                 <option value="Hong Kong">Hong Kong</option>
                 <option value="Hungary">Hungary</option>
                 <option value="Iceland">Iceland</option>
                 <option value="Indonesia">Indonesia</option>
                 <option value="India">India</option>
                 <option value="Iran">Iran</option>
                 <option value="Iraq">Iraq</option>
                 <option value="Ireland">Ireland</option>
                 <option value="Isle of Man">Isle of Man</option>
                 <option value="Israel">Israel</option>
                 <option value="Italy">Italy</option>
                 <option value="Jamaica">Jamaica</option>
                 <option value="Japan">Japan</option>
                 <option value="Jordan">Jordan</option>
                 <option value="Kazakhstan">Kazakhstan</option>
                 <option value="Kenya">Kenya</option>
                 <option value="Kiribati">Kiribati</option>
                 <option value="Korea North">Korea North</option>
                 <option value="Korea Sout">Korea South</option>
                 <option value="Kuwait">Kuwait</option>
                 <option value="Kyrgyzstan">Kyrgyzstan</option>
                 <option value="Laos">Laos</option>
                 <option value="Latvia">Latvia</option>
                 <option value="Lebanon">Lebanon</option>
                 <option value="Lesotho">Lesotho</option>
                 <option value="Liberia">Liberia</option>
                 <option value="Libya">Libya</option>
                 <option value="Liechtenstein">Liechtenstein</option>
                 <option value="Lithuania">Lithuania</option>
                 <option value="Luxembourg">Luxembourg</option>
                 <option value="Macau">Macau</option>
                 <option value="Macedonia">Macedonia</option>
                 <option value="Madagascar">Madagascar</option>
                 <option value="Malaysia">Malaysia</option>
                 <option value="Malawi">Malawi</option>
                 <option value="Maldives">Maldives</option>
                 <option value="Mali">Mali</option>
                 <option value="Malta">Malta</option>
                 <option value="Marshall Islands">Marshall Islands</option>
                 <option value="Martinique">Martinique</option>
                 <option value="Mauritania">Mauritania</option>
                 <option value="Mauritius">Mauritius</option>
                 <option value="Mayotte">Mayotte</option>
                 <option value="Mexico">Mexico</option>
                 <option value="Midway Islands">Midway Islands</option>
                 <option value="Moldova">Moldova</option>
                 <option value="Monaco">Monaco</option>
                 <option value="Mongolia">Mongolia</option>
                 <option value="Montserrat">Montserrat</option>
                 <option value="Morocco">Morocco</option>
                 <option value="Mozambique">Mozambique</option>
                 <option value="Myanmar">Myanmar</option>
                 <option value="Nambia">Nambia</option>
                 <option value="Nauru">Nauru</option>
                 <option value="Nepal">Nepal</option>
                 <option value="Netherland Antilles">Netherland Antilles</option>
                 <option value="Netherlands">Netherlands (Holland, Europe)</option>
                 <option value="Nevis">Nevis</option>
                 <option value="New Caledonia">New Caledonia</option>
                 <option value="New Zealand">New Zealand</option>
                 <option value="Nicaragua">Nicaragua</option>
                 <option value="Niger">Niger</option>
                 <option value="Nigeria">Nigeria</option>
                 <option value="Niue">Niue</option>
                 <option value="Norfolk Island">Norfolk Island</option>
                 <option value="Norway">Norway</option>
                 <option value="Oman">Oman</option>
                 <option value="Pakistan">Pakistan</option>
                 <option value="Palau Island">Palau Island</option>
                 <option value="Palestine">Palestine</option>
                 <option value="Panama">Panama</option>
                 <option value="Papua New Guinea">Papua New Guinea</option>
                 <option value="Paraguay">Paraguay</option>
                 <option value="Peru">Peru</option>
                 <option value="Phillipines">Philippines</option>
                 <option value="Pitcairn Island">Pitcairn Island</option>
                 <option value="Poland">Poland</option>
                 <option value="Portugal">Portugal</option>
                 <option value="Puerto Rico">Puerto Rico</option>
                 <option value="Qatar">Qatar</option>
                 <option value="Republic of Montenegro">Republic of Montenegro</option>
                 <option value="Republic of Serbia">Republic of Serbia</option>
                 <option value="Reunion">Reunion</option>
                 <option value="Romania">Romania</option>
                 <option value="Russia">Russia</option>
                 <option value="Rwanda">Rwanda</option>
                 <option value="St Barthelemy">St Barthelemy</option>
                 <option value="St Eustatius">St Eustatius</option>
                 <option value="St Helena">St Helena</option>
                 <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                 <option value="St Lucia">St Lucia</option>
                 <option value="St Maarten">St Maarten</option>
                 <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                 <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                 <option value="Saipan">Saipan</option>
                 <option value="Samoa">Samoa</option>
                 <option value="Samoa American">Samoa American</option>
                 <option value="San Marino">San Marino</option>
                 <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                 <option value="Saudi Arabia">Saudi Arabia</option>
                 <option value="Senegal">Senegal</option>
                 <option value="Seychelles">Seychelles</option>
                 <option value="Sierra Leone">Sierra Leone</option>
                 <option value="Singapore">Singapore</option>
                 <option value="Slovakia">Slovakia</option>
                 <option value="Slovenia">Slovenia</option>
                 <option value="Solomon Islands">Solomon Islands</option>
                 <option value="Somalia">Somalia</option>
                 <option value="South Africa">South Africa</option>
                 <option value="Spain">Spain</option>
                 <option value="Sri Lanka">Sri Lanka</option>
                 <option value="Sudan">Sudan</option>
                 <option value="Suriname">Suriname</option>
                 <option value="Swaziland">Swaziland</option>
                 <option value="Sweden">Sweden</option>
                 <option value="Switzerland">Switzerland</option>
                 <option value="Syria">Syria</option>
                 <option value="Tahiti">Tahiti</option>
                 <option value="Taiwan">Taiwan</option>
                 <option value="Tajikistan">Tajikistan</option>
                 <option value="Tanzania">Tanzania</option>
                 <option value="Thailand">Thailand</option>
                 <option value="Togo">Togo</option>
                 <option value="Tokelau">Tokelau</option>
                 <option value="Tonga">Tonga</option>
                 <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                 <option value="Tunisia">Tunisia</option>
                 <option value="Turkey">Turkey</option>
                 <option value="Turkmenistan">Turkmenistan</option>
                 <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                 <option value="Tuvalu">Tuvalu</option>
                 <option value="Uganda">Uganda</option>
                 <option value="United Kingdom">United Kingdom</option>
                 <option value="Ukraine">Ukraine</option>
                 <option value="United Arab Erimates">United Arab Emirates</option>
                 <option value="United States of America">United States of America</option>
                 <option value="Uraguay">Uruguay</option>
                 <option value="Uzbekistan">Uzbekistan</option>
                 <option value="Vanuatu">Vanuatu</option>
                 <option value="Vatican City State">Vatican City State</option>
                 <option value="Venezuela">Venezuela</option>
                 <option value="Vietnam">Vietnam</option>
                 <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                 <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                 <option value="Wake Island">Wake Island</option>
                 <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                 <option value="Yemen">Yemen</option>
                 <option value="Zaire">Zaire</option>
                 <option value="Zambia">Zambia</option>
                 <option value="Zimbabwe">Zimbabwe</option>
             </select>
            </div>
        </div>
        <div class="form-group">
         <label for="text" class="col-md-2 control-label">Pin</label>
            <div class="col-md-4">
              <input type="text" class="form-control c-square c-theme" name = "pincode" required value = "<?php print $update_row['address_pin'];?>" />
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