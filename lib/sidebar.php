<!--  ------------------ --------- ---------------------- -->

<?php
if(  isset($show_sidebar_account ) && $show_sidebar_account==true)
{			

	$sql = "SELECT * FROM `users` WHERE `user_id` = '$_SESSION[logged_in_user_id]' ";
	$res = $db->query($sql) or die($db->error);
	$row = $res->fetch_array();

  if(!$row['photo'])
    $row['photo'] = "images/no_pic.png";
	?>
	
				<img src = "<?php print $row['photo']."?r=".rand(111111,9999999);?>" width = "100%" style = "border: 1px solid silver;" >
        <br>
        <a href = edit_photo >Edit My Photo</a>
					<br>


					<!--  ------------------ --------- ---------------------- -->
					<!--  ------------------ --------- ---------------------- -->
					<!--  ------------------ --------- ---------------------- -->
					<!--  ------------------ --------- ---------------------- -->
					

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

    	<center><h2> &nbsp;<?php print $row['fullname'];?></h2>

        <a href = "./profiles/<?php print $_SESSION['logged_in_user_id'];?>" target="_blank"><input type="button" value="View Public Profile" class="btn btn-success"></a>
        <br><br>
       </center>

      <div class="panel panel-default">
        <div class="panel-heading" id="headingOne" role="tab">
          <h4 class="panel-title" ><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseA" aria-expanded="true" aria-controls="collapseA" style = "color: #3f444a;">
          <img src = "images/profile.png" width = "20" style = "padding: 0px;"> POSTS <b class="pull-right fa fa-chevron-down" style = "color: #3f444a;"></b></a></h4>
        </div>

        <div class="panel-collapse collapse in" id="collapseA" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
          <ul style = "padding-top: 10px;">

              <li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = posts ><b>Latest Posts</b></a></li>
              
              <li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = posts_add>+ Add New POST</a></li>
              
              

              <li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = posts_manage > My Posts</a></li>
              
            </ul>
          </div>
        </div>
       </div>
       <br>

       <div class="panel panel-default">
        <div class="panel-heading" id="headingOne" role="tab">
          <h4 class="panel-title" ><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseT" aria-expanded="true" aria-controls="collapseT" style = "color: #3f444a;">
          <img src = "images/profile.png" width = "20" style = "padding: 0px;"> My Startups / Teams <b class="pull-right fa fa-chevron-down" style = "color: #3f444a;"></b></a></h4>
        </div>

        <div class="panel-collapse collapse" id="collapseT" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
          <ul style = "padding-top: 10px;">
              
              <li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = startup_add>Add New Startup</a></li>
              
              <li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = startups?r >Join/View Startups</a></li>

              <li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = startup_manage >Manage My Startups</a></li>
              
            </ul>
          </div>
        </div>
       </div> 
      <br>


      <div class="panel panel-default">
        <div class="panel-heading" id="headingOne" role="tab">
          <h4 class="panel-title" ><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style = "color: #3f444a;">
          <img src = "images/profile.png" width = "20" style = "padding: 0px;">	My Work History <b class="pull-right fa fa-chevron-down" style = "color: #3f444a;"></b>  </a></h4>
        </div>

        <div class="panel-collapse collapse " id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
          <!--  <p>Anim pariatur cliche reprehenderit, enim eiusmod high life</p>  -->
          <ul style = "padding-top: 10px;">
            	<li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = add_work>Add New Work</a></li>
            	<li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = manage_work >Manage Work History</a></li>
            </ul>
          </div>
        </div>
       </div>
      <br>


      <div class="panel panel-default">
        <div class="panel-heading" id="headingOne" role="tab">
          <h4 class="panel-title" ><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style = "color: #3f444a;">
          <img src = "images/profile.png" width = "20" style = "padding: 0px;"> My Education History <b class="pull-right fa fa-chevron-down" style = "color: #3f444a;"></b> </a></h4>
        </div>

        <div class="panel-collapse collapse " id="collapseTwo" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
          <!--  <p>Anim pariatur cliche reprehenderit, enim eiusmod high life</p>  -->
          <ul style = "padding-top: 10px;">
              <li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = add_education>Add New Education</a></li>
              <li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = manage_education >Manage Education History</a></li>
            </ul>
          </div>
        </div>
       </div>
       <br>


  	<div class="panel panel-default">
        <div class="panel-heading" id="headingOne" role="tab">
          <h4 class="panel-title" ><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style = "color: #3f444a;">
          <img src = "images/profile.png" width = "20" style = "padding: 0px;">	My Account  <b class="pull-right fa fa-chevron-down" style = "color: #3f444a;"></b> </a></h4>
        </div>
        <div class="panel-collapse collapse" id="collapseThree" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
          <!--  <p>Anim pariatur cliche reprehenderit, enim eiusmod high life</p>  -->
          <ul style = "padding-top: 10px;">
            	<li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = edit_profile>Edit Profile</a></li>
            	<li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = edit_photo >Edit Photo</a></li>
            	<li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = edit_cv >Edit CV</a></li>
            	<li style="border-bottom: 1px solid silver; list-style-type:none; margin-left: -40px;padding: 5px;"><a href = edit_password >Change Password</a></li>
            </ul>
          </div>
        </div>
       </div>
<?php
}

?>
  
    </div>
					<!--  ------------------ --------- ---------------------- -->
					<!--  ------------------ --------- ---------------------- -->
					<!--  ------------------ --------- ---------------------- -->
					<!--  ------------------ --------- ---------------------- -->
					<!--  ------------------ --------- ---------------------- -->



