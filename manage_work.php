<?php
include "lib/config.php";
include "lib/login_check.php";

if(isset($_GET['del_id'])) {


	$sql = "DELETE FROM `user_work_history` WHERE  `user_id` = '$_SESSION[logged_in_user_id]' AND `user_work_history_id` = '$_GET[del_id]' ";
	$db->query($sql);

	Header("Location: user_msg.php?msg=6");

}



//Move a Work up in position
if( isset($_GET['move_up_id']) ) {

   //Find the id, position of this FAQ
   $sql = "SELECT * FROM `user_work_history` WHERE `user_work_history_id` = '$_GET[move_up_id]'  ";
   $res = $db->query($sql);
   $row = $res->fetch_array();
   
   $current_id = $_GET['move_up_id'];
   $current_sort_order = $row['sort_order'];

   //Find the Work just Above this one
   $sql = "SELECT * FROM `user_work_history` WHERE `sort_order` > '$current_sort_order' ORDER BY `sort_order` ASC";
   $res = $db->query($sql);
   if($row = $res->fetch_array()) {
      $neighbor_id = $row['user_work_history_id'];
      $neighbor_sort_order = $row['sort_order'];

      //Exchange Positions
      $sql = "UPDATE `user_work_history` SET `sort_order` = '$neighbor_sort_order'  WHERE  `user_work_history_id` = '$current_id' ";
      $db->query($sql);

      $sql = "UPDATE `user_work_history` SET `sort_order` = '$current_sort_order'  WHERE  `user_work_history_id` = '$neighbor_id' ";
      $db->query($sql);
   }
}



//Move a Work up in position
if( isset($_GET['move_down_id']) ) {

   //Find the id, position of this FAQ
   $sql = "SELECT * FROM `user_work_history` WHERE `user_work_history_id` = '$_GET[move_down_id]'  ";
   $res = $db->query($sql);
   $row = $res->fetch_array();
   
   $current_id = $_GET['move_down_id'];
   $current_sort_order = $row['sort_order'];

   //Find the Work just Above this one
   $sql = "SELECT * FROM `user_work_history` WHERE `sort_order` < '$current_sort_order' ORDER BY `sort_order` DESC";
   $res = $db->query($sql);
   if($row = $res->fetch_array()) {
      $neighbor_id = $row['user_work_history_id'];
      $neighbor_sort_order = $row['sort_order'];

      //Exchange Positions
      $sql = "UPDATE `user_work_history` SET `sort_order` = '$neighbor_sort_order'  WHERE  `user_work_history_id` = '$current_id' ";
      $db->query($sql);

      $sql = "UPDATE `user_work_history` SET `sort_order` = '$current_sort_order'  WHERE  `user_work_history_id` = '$neighbor_id' ";
      $db->query($sql);
   }
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
    
    <h1>My Work History Sections:</h1>

   <TABLE ALIGN = CENTER BORDER = 1 CELLPADDING = 10 class = "table table-striped">
   <TR>
      
      <TH>No.</TH>
      <TH>Start Date</TH>
      <TH>End Date</TH>
      <TH>Designation</TH>
      <TH>Company</TH>
      <TH>Summary</TH>
      <TH>Edit</TH>
      <TH>Delete</TH>
      <TH>UP</TH>
      <TH>DOWN</TH>
   </TR>
   <?php
   $count = 0;
   $sql = "SELECT * FROM `user_work_history` WHERE `user_id` = '$_SESSION[logged_in_user_id]'  ORDER BY `sort_order` DESC";
   $res = $db->query($sql);
   while($row = $res->fetch_array())
   {
      $count++;
      print "
      <TR>
         <TD>$count</TD>
         <TD>$row[start_date]</TD>
         <TD>$row[end_date]</TD>
         <TD>$row[designation]</TD>
         <TD>$row[company_name]</TD>
         <TD>$row[summary]</TD>

         <TD><A HREF = \"edit_work?edit_id=$row[user_work_history_id]\">Edit</A></TD>
         <TD><A HREF = \"manage_work?del_id=$row[user_work_history_id]\" ONCLICK = \"javscript: return confirm('Are you sure?');\">Delete</A></TD>
         <TD><A HREF = \"manage_work?move_up_id=$row[user_work_history_id]\"> &#9650; </A></TD>
         <TD><A HREF = \"manage_work?move_down_id=$row[user_work_history_id]\"> &#9660; </A></TD>
      </TR>";

   }
   ?>

   </TABLE>
        
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