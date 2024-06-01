<?php
include "lib/config.php";


if(isset($_GET['del_id']))
{
	$sql = "DELETE FROM `courses_syllabus_sections` WHERE `course_syllabus_section_id` = '$_GET[del_id]'";
	$db->query($sql);
	$msg = "<h1>Delete Successful.</h1>";
	print $msg;
}


if( isset($_POST['title']))
{
$sql = "INSERT INTO `courses_syllabus_sections` (`course_id`,`title`,`section_objectives`,`position`) VALUES ('$_GET[course_id]','$_POST[title]','$_POST[section_objectives]','".time()."') ";
	$db->query($sql);
}





//Move a FAQ up in position
if( isset($_GET['move_up_id']) ) {

	//Find the id, position of this FAQ
	$sql = "SELECT * FROM `courses_syllabus_sections` WHERE `course_syllabus_section_id` = '$_GET[move_up_id]'  ";
	$res = $db->query($sql);
	$row = $res->fetch_array();
	
	$current_id = $_GET['move_up_id'];
	$current_position = $row['position'];
	$current_course_id= $row['course_id'];

	//Find the FAQ just Above this one
	$sql = "SELECT * FROM `courses_syllabus_sections` WHERE `course_id` = $current_course_id AND `position` < '$current_position' ORDER BY `position` DESC";
	$res = $db->query($sql);
	if($row = $res->fetch_array()) {
		$neighbor_id = $row['course_syllabus_section_id'];
		$neighbor_position = $row['position'];

		//Exchange Positions
		$sql = "UPDATE `courses_syllabus_sections` SET `position` = '$neighbor_position'  WHERE  `course_syllabus_section_id` = '$current_id' ";
		$db->query($sql);

		$sql = "UPDATE `courses_syllabus_sections` SET `position` = '$current_position'  WHERE  `course_syllabus_section_id` = '$neighbor_id' ";
		$db->query($sql);
	}
}


//Move a FAQ up in position
if( isset($_GET['move_down_id']) ) {

	//Find the id, position of this FAQ
	$sql = "SELECT * FROM `courses_syllabus_sections` WHERE `course_syllabus_section_id` = '$_GET[move_down_id]'  ";
	$res = $db->query($sql);
	$row = $res->fetch_array();
	
	$current_id = $_GET['move_down_id'];
	$current_position = $row['position'];

	$current_course_id= $row['course_id'];

	//Find the FAQ just Above this one
	$sql = "SELECT * FROM `courses_syllabus_sections` WHERE `course_id` = $current_course_id AND  `position` > '$current_position' ORDER BY `position` ASC";
	$res = $db->query($sql);
	if($row = $res->fetch_array()) {
		$neighbor_id = $row['course_syllabus_section_id'];
		$neighbor_position = $row['position'];

		//Exchange Positions
		$sql = "UPDATE `courses_syllabus_sections` SET `position` = '$neighbor_position'  WHERE  `course_syllabus_section_id` = '$current_id' ";
		$db->query($sql);

		$sql = "UPDATE `courses_syllabus_sections` SET `position` = '$current_position'  WHERE  `course_syllabus_section_id` = '$neighbor_id' ";
		$db->query($sql);
	}
}


include "lib/header.php";
?>



<div class="c-layout-page" style="margin-top: 0px; margin-bottom: 0px;">
<img src="./assets/base/img/content/backgrounds/header2.jpg" width="100%"  style="margin-top: -120px;">

     <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12" style="padding-left: 40px;">
	    	<h2>Syllabus of this course </h2>

	    	<H1>Insert into Syllabus Sections </H1>
		<FORM METHOD = POST >

				<div class="form-group row">
					<label class="col-lg-5 col-xl-3 control-label text-lg-right pt-2 mt-1 mb-0">Title</label>
					<div class="col-lg-7 col-xl-6"><input type="text" class="form-control form-control-modern" name="title" placeholder="Title"   maxlength = "1000"  />  	
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-5 col-xl-3 control-label text-lg-right pt-2 mt-1 mb-0">Section Objectives</label>
					<div class="col-lg-7 col-xl-6"><textarea class="form-control form-control-modern" name="section_objectives" rows="3" placeholder="Section Objectives"></textarea> 	
					</div>
				</div>
				

				<div class="form-group row">
						<label class="col-lg-5 col-xl-3 control-label text-lg-right pt-2 mt-1 mb-0"></label>
						<div class="col-lg-7 col-xl-6"><INPUT TYPE = SUBMIT NAME = "form_insert_submit" VALUE = " Insert ">
						</div>
				</div>

		</FORM>


		<hr>
		<h1>Syllabus Sections:</h1>

<TABLE ALIGN = CENTER BORDER = 1 CELLPADDING = 10 class = "table">
<TR>
	
	<TH>course_syllabus_section_id</TH>
	<TH>course_id</TH>
	<TH>title</TH>
	<TH>section_objectives</TH>
	<TH>position</TH>
	<TH>Edit</TH>
	<TH>Delete</TH>
	<TH>Add Topic</TH>

	<TH>UP</TH>
	<TH>DOWN</TH>
</TR>
<?php
$sql = "SELECT * FROM `courses_syllabus_sections` WHERE   `course_id` = '$_GET[course_id]'  ORDER BY `position`";
$res = $db->query($sql);
while($row = $res->fetch_array())
{
	print "
<TR bgcolor = silver>
	<TD>$row[course_syllabus_section_id]</TD>
	<TD>$row[course_id]</TD>
	<TD><b>$row[title]</b></TD>
	<TD><b>$row[section_objectives]</b></TD>
	<TD>$row[position]</TD> 
	<TD><A HREF = \"courses_syllabus_sections_edit.php?edit_id=$row[course_syllabus_section_id]\">Edit</A></TD>
	<TD><A HREF = \"syllabus.php?course_id=$_GET[course_id]&del_id=$row[course_syllabus_section_id]\" ONCLICK = \"javscript: return confirm('Are you sure?');\">Delete</A></TD>

	<TD><A HREF = \"topics.php?course_syllabus_section_id=$row[course_syllabus_section_id]\">Add Topic</A></TD>

	<TD><A HREF = \"syllabus.php?course_id=$_GET[course_id]&move_up_id=$row[course_syllabus_section_id]\"> &#9650; </A></TD>
	<TD><A HREF = \"syllabus.php?course_id=$_GET[course_id]&move_down_id=$row[course_syllabus_section_id]\"> &#9660; </A></TD>

	</TR>";


	$sql2 = "SELECT * FROM `courses_syllabus_topics` 
	            WHERE `course_syllabus_section_id` = '$row[course_syllabus_section_id]'  ORDER BY `position` ";
	$res2 = $db->query($sql2);
	while($row2 = $res2->fetch_array())
	{
		print "<TR>
		<TD>$row2[courses_syllabus_topic_id]</TD>
		<TD>$row2[course_syllabus_section_id]</TD>
		<TD>$row2[title]</TD>
		<TD>$row2[details]</TD>
		<TD>$row2[position]</TD> 
		<TD><A HREF = \"courses_syllabus_topics_edit.php?edit_id=$row2[courses_syllabus_topic_id]\">Edit</A></TD>
		<TD><A HREF = \"courses_syllabus_topics_index.php?del_id=$row2[courses_syllabus_topic_id]\" ONCLICK = \"javscript: return confirm('Are you sure?');\">Delete</A></TD>
		</TR>";
	}
}
?>

</TABLE>

		</div>
	 </div>
		</div>
	 </div>
		</div>
	 </div>
	 
<?php
include "lib/footer.php";
?>
