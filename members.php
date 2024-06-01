<?php
include 'lib/config.php';
include 'lib/header.php';

define('RESULT_PER_PAGE', 12);

if( isset($_GET['page']) && $_GET['page'] > 0 ) 
	$current_page = $_GET['page'];
else
	$current_page = 1;
?>


<div class="c-content-box c-size-md c-bg-grey-1">

<!-- BEGIN: CONTENT/MISC/TEAM-3 -->
	<div class="container">

		<div class="c-container c-bg-grey-1 c-bg-img-bottom-right" style="background-image:url(../../assets/base/img/content/misc/feedback_box_2.png)">
				<div class="c-content-title-1">
					<h3 class="c-font-uppercase c-font-bold">Search</h3>


					<form action="members.php" method = "get">
						<div class="input-group input-group-lg c-square">
					      	<input type="text" name = "q" class="form-control c-square" placeholder="Search Keywords"/>
					      	<span class="input-group-btn">
					        	<button class="btn c-theme-btn c-btn-square c-btn-uppercase c-font-bold" type="button">Go!</button>
					      	</span>
					    </div>
					</form>


					
				</div>
			</div>
		</div>

	</div>
	</div>

<!-- BEGIN: CONTENT/MISC/TEAM-3 -->
<div class="c-content-box c-size-md c-bg-grey-1">
	<div class="container">
		<!-- Begin: Testimonals 1 component -->
		<div class="c-content-team-1-slider" data-slider="owl" data-items="3">
			<!-- Begin: Title 1 component -->
			<div class="c-content-title-1">
				<h3 class="c-center c-font-uppercase c-font-bold">Members</h3>
				<div class="c-line-center c-theme-bg"></div>
			</div>
			<!-- End-->
			<div class="row">
				

					<?php

					$start_from = ($current_page-1)*RESULT_PER_PAGE;

					if(isset($_GET['q'])) {

						  $search_part = " AND (`fullname` LIKE '%$_GET[q]%' OR `qualification` LIKE '%$_GET[q]%' ) ";
					}
					else 
						$search_part = "";

					//Num Rows

					$sql = "SELECT * FROM `users` WHERE `status` = 'active' $search_part";
					$res = $db->query($sql);
					$num = $res->num_rows;

					if($num==0)
						print "<div class = \"alert alert-danger\">No results found for <b>$_GET[q]</b> </div> ";
					

				
					$sql = "SELECT * FROM `users` WHERE `status` = 'active' $search_part ORDER BY `user_id` DESC LIMIT $start_from, ".RESULT_PER_PAGE;
					$res = $db->query($sql);
					while($row = $res->fetch_array()) {

							$fullname  = $row['fullname'];

							//Trim long fullnames of design breaks...
							$fullname   = substr( $fullname, 0, 15);


							//Get Role
							$sql2 = "SELECT * FROM `roles` WHERE `role_id` = '$row[primary_role_id]' ";
							$res2 = $db->query($sql2);
							$row2 = $res2->fetch_array();

							if( isset($row2['role_name']))
								$role = $row2['role_name'];
							else
								$role = "-";
							
							print <<<EOF


				<!-- start record -->
				<!-- start record -->
				<div class="col-md-4 col-sm-6 c-margin-b-30">
					<div class="c-content-person-1 c-option-2">
			  			<a href="./profiles/$row[user_id]"><div class="c-caption c-content-overlay">
			  				<div class="c-overlay-wrapper">
				  				 
			  				</div>
			  				<img class="c-overlay-object img-responsive" src="$row[photo]" alt="" style="width: 100%; height: 360px;" >
			  			</div></a>
			  			<div class="c-body">
				  			<div class="c-head">
				  				<div class="c-name c-font-uppercase c-font-bold"><a href="./profiles/$row[user_id]">$fullname</a></div>
				  				
				  			</div>
				  			<div class="c-position">
				  				<a href = "./profiles/$row[user_id]">$role</a>
				  			</div>
					  		<p>
					  			$row[qualification] from $row[address_city]
			          </p>
		        </div>
	        </div>
				</div>
				<!-- end record -->
				<!-- end record -->

EOF;	
					
					}
					?>

				</div>


				<center>
					<ul class="pagination">
		<?php
			$prev_page = $current_page-1;
			
			print "<li class=\"page-item\"><A  class=\"page-link\" href = \"members?page=1\">First</a></li> ";
			
			if($current_page>1)
				print "<li class=\"page-item\"><A class=\"page-link\" href = \"members?page=$prev_page\">PREV</a></li>";

			//Find total number of pages
			$sql = "SELECT * FROM `users` WHERE `status` = 'active' $search_part  ";
			$res = $db->query($sql);
			$num = $res->num_rows;  // 503
			$total_pages = ceil($num/RESULT_PER_PAGE); // ceil(50.3) gives 51, the next highest integer

			//Google Paging logic
			$i_start = 1;
			$i_end   = $total_pages;

				//Logic 1.
				$i_start = $current_page-5;
				$i_end   = $current_page+4;

				//Logic 2.
				$diff = 0;
				if($i_start<1) {

					$diff    = -1*$i_start + 1;
					$i_start = 1;
					$i_end   = $i_end + $diff;
				}

				//Logic 3.
				if($i_end>$total_pages) {
					$diff    = $i_end - $total_pages;
					$i_start = $i_start - $diff;
					$i_end   = $total_pages;
				}

				//Logic 4.
				if($total_pages<10){
					$i_start = 1;
					$i_end   = $total_pages;
				}

			for($i=$i_start; $i<=$i_end; $i++) {
				if($i==$current_page)
					print "<li class=\"page-item active\"><a class=\"page-link\" href = members?page=$i >$i</a></li>";
				else
					print "<li class=\"page-item\"><a class=\"page-link\" href = members?page=$i>$i</a></li>";
			}

			$next_page = $current_page+1;
			if($current_page<$total_pages)
				print "<li class=\"page-item\"><A class=\"page-link\" href = \"members?page=$next_page\">NEXT</a></li>";

			print "<li class=\"page-item\"><A class=\"page-link\" href = \"members?page=$total_pages\">Last</a></li> ";

			?>
		</ul>


		</center>



			</div>
	        <!-- End-->
	    </div>
	    <!-- End-->
	</div>
</div><!-- END: CONTENT/MISC/TEAM-3 -->
  
		

<?php
include 'lib/footer.php';
?>

