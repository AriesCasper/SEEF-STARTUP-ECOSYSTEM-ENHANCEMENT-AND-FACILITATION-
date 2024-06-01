<?php
include "lib/config.php";
include "lib/login_check.php";
include "lib/header.php";
?>

<div class="c-layout-page" style="margin-top: 0px; margin-bottom: 0px;">
<img src="./assets/base/img/content/backgrounds/header2.jpg" width="100%"  style="margin-top: -120px;">

	<!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
	<div class="c-layout-breadcrumbs-1 c-fonts-uppercase c-fonts-bold">
		<div class="container" >
			<div class="c-page-title c-pull-left" >
				<h2 class="c-font-bold">Welcome, <?php print $_SESSION['logged_in_user_name'];?></h2>
			</div>
			<ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
				<li>
					<a href="#">&nbsp;</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
	<!-- BEGIN: PAGE CONTENT -->
	<!-- BEGIN: CONTENT/CONTACT/CONTACT-1 -->


	<!-- BEGIN: FULL PAGE TEXT CONTENT -->

		<div class="c-content-box c-size-md c-bg-white" style="margin-top: 0px; min-height: 400px;">
		<div class="container">
			<div class="row" style="margin-top: -40px; ">
					

				<div class="col-sm-3" style="border: 0px solid silver;">
				
				<?php
				$show_sidebar_account = true;
				include "lib/sidebar.php";
				?>				

				</div>

				<div class="col-sm-9" style="border: 1px solid silver;">
					<div class="c-content-feature-1">
						<h3 class="c-font-uppercase c-font-bold">WELCOME TO THE SEEF PLATFORM.</h3>
						<p class="c-font-thin">
							You can use SEEF to connect with other members and make your idea into a reality.

							<hr>
							<?php


							$sql = "SELECT * FROM `users` WHERE `user_id` = '$_SESSION[logged_in_user_id]' ";
							$res = $db->query($sql) or die($db->error);
							$row = $res->fetch_array();

							if($row['photo'] == "")
								print "<br><div class = \"alert alert-danger\">Please upload your photo</div><br>";

							if($row['about'] == "" && $row['skills'] == "" && $row['address_city'] == "" )
								print "<br><div class = \"alert alert-danger\">Please update your profile <a href = \"./edit_profile\">here</a> and add more details about you.</div><br>";
							?>
							
							<a href="./all_messages" class="btn btn-md c-btn c-btn-square c-theme-btn c-font-white c-font-bold c-center c-font-uppercase"> Messages</a>
							
							&nbsp; &nbsp; 
							<a href="./connections" class="btn btn-md c-btn c-btn-square c-theme-btn c-font-white c-font-bold c-center c-font-uppercase"> View My Connects</a>

						</p>
					</div>
				



					<div class="c-content-team-1-slider" data-slider="owl" data-items="3">
					<!-- Begin: Title 1 component -->
					<div class="c-content-title-1">
						<hr>
						<h3 class=" c-font-uppercase c-font-bold">Suggested Connections</h3>
						<div class="c-line-center c-theme-bg"></div>
					</div>

					<?php

					$already_friends = [];
					$already_friends[]  = $_SESSION['logged_in_user_id']; //Dont suggest self as a friend

					$sql = "SELECT * FROM `user_connections` WHERE `sender_user_id` = '$_SESSION[logged_in_user_id]' AND `connection_status` = 'accepted'  ";
					$res = $db->query($sql) or die($db->error);
					while($row = $res->fetch_array()) 
					$already_friends[] = $row['receiver_user_id'];


					$sql = "SELECT * FROM `user_connections` WHERE `receiver_user_id` = '$_SESSION[logged_in_user_id]' AND `connection_status` = 'accepted'  ";
					$res = $db->query($sql) or die($db->error);
					while($row = $res->fetch_array()) 
					$already_friends[] = $row['sender_user_id'];

					$count_suggested = 0;					
					$sql2 = "SELECT * FROM `users` WHERE 1 ORDER BY rand()";
					$res2 = $db->query($sql2) or die($db->error);
					while($row2 = $res2->fetch_array()) {

						//Ignore me and friends
						if( in_array($row2['user_id'], $already_friends) || $count_suggested > 3)
							continue;

						//Is this a Good match?
						if( is_good_match($_SESSION['logged_in_user_id'], $row2['user_id']) ) {

							$fullname  = $row2['fullname'];
							$fullname   = substr( $fullname, 0, 15);

							$count_suggested++;

							print <<<EOF

								<!-- start record -->
								<!-- start record -->
								<div class="col-md-3 col-sm-4	 c-margin-b-10">
									<div class="c-content-person-1 c-option-2">
							  			<a href="./profiles/$row2[user_id]"><div class="c-caption c-content-overlay">
							  				<div class="c-overlay-wrapper">
								  				 
							  				</div>
							  				<img class="c-overlay-object img-responsive" src="$row2[photo]" alt="" style="width: 100%;" >
							  			</div></a>
							  			<div class="c-body">
								  			<div class="c-head">
								  				<div class="c-name c-font-uppercase c-font-bold"><a href="./profiles/$row2[user_id]">$fullname</a></div>
								  				
								  			</div>
									  		
							    </div>
								</div>
								</div>
								<!-- end record -->
								<!-- end record -->

EOF;	

						}

					}

					
					function is_good_match($main_user,  $stranger_user_id ) {

						global $db;

						//Get Data of Main User

						$sql_Main_User = "SELECT * FROM `users` WHERE `user_id` = '$main_user'  ";
						$res_Main_User = $db->query($sql_Main_User) or die($db->error);
						$row_Main_User = $res_Main_User->fetch_array();

						$Main_User_Fullname = $row_Main_User['fullname'];
						$Main_User_Age = $row_Main_User['age'];
						$Main_User_Gender = $row_Main_User['gender'];
						$Main_User_About = $row_Main_User['about'];
						$Main_User_Skills = $row_Main_User['skills'];
						$Main_User_Projects = $row_Main_User['projects'];
						$Main_User_Country = $row_Main_User['address_country'];

						//Find all Connections of the main user
						$Main_User_Connections = [];

						$sql = "SELECT * FROM `user_connections` WHERE `sender_user_id` = '$main_user' AND `connection_status` = 'accepted'  ";
						$res = $db->query($sql) or die($db->error);
						while($row = $res->fetch_array()) 
							$Main_User_Connections[] = $row['receiver_user_id'];
						
						$sql = "SELECT * FROM `user_connections` WHERE `receiver_user_id` = '$main_user' AND `connection_status` = 'accepted'  ";
						$res = $db->query($sql) or die($db->error);
						while($row = $res->fetch_array()) 
							$Main_User_Connections[] = $row['sender_user_id'];


						// I want to suggest some strangers to a main user to add as a connection.
						//Similarly, find all Data of Stranger User & His friends too
						// Based on some complex matching algo, either return true or false for the is_good_match for a new connetion

						return 1;
					}
					 
/*
I have some tables in a DB like this, given inside triple quotes
'''
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `primary_role_id` int(11) NOT NULL,
  `secondary_role_id` int(11) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  `password_remember_cookie` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `skills` text NOT NULL,
  `projects` text NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NOT NULL,
  `address_city` varchar(100) NOT NULL,
  `address_state` varchar(50) NOT NULL,
  `address_country` varchar(255) NOT NULL,
  `address_pin` varchar(100) NOT NULL,
  `address_latlong` varchar(100) NOT NULL,
  `registered_on_ts` varchar(50) NOT NULL,
  `registered_from_ip` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `admin_comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `user_connections` (
  `user_connection_id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `receiver_user_id` int(11) NOT NULL,
  `connection_status` enum('pending','accepted','rejected','') NOT NULL,
  `sent_on_timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user_education_history` (
  `user_education_history_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL,
  `course` varchar(250) NOT NULL,
  `organization` varchar(250) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `user_connections`
  ADD PRIMARY KEY (`user_connection_id`);

ALTER TABLE `user_education_history`
  ADD PRIMARY KEY (`user_education_history_id`);

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_connections`
  MODIFY `user_connection_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_education_history`
  MODIFY `user_education_history_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

'''
Now, I want to make a function like this is_good_match() which suggests connections(or friends) to a 
user who is logged in (called main_user). I want to make this function deliberately complex with lots of variables like
 $Main_User_Fullname, $Main_User_About, $Main_User_Skills etc to be matched with the stranger and based on some
 complex but perhaps useless logic, it return true or false. True means we will suggest them to be friends or connections and
 false otherwise.

Please complete this function below. Make it hugely complex, no logic required, just I want it to return true or 
false based on random algorithm you develop.

          function is_good_match($main_user,  $stranger_user_id ) {

            global $db;

            //Get Data of Main User

            $sql_Main_User = "SELECT * FROM `users` WHERE `user_id` = '$main_user'  ";
            $res_Main_User = $db->query($sql_Main_User) or die($db->error);
            $row_Main_User = $res_Main_User->fetch_array();

            $Main_User_Fullname = $row_Main_User['fullname'];
            $Main_User_Age = $row_Main_User['age'];
            $Main_User_Gender = $row_Main_User['gender'];
            $Main_User_About = $row_Main_User['about'];
            $Main_User_Skills = $row_Main_User['skills'];
            $Main_User_Projects = $row_Main_User['projects'];
            $Main_User_Country = $row_Main_User['address_country'];

            //Find all Connections of the main user
            $Main_User_Connections = [];

            $sql = "SELECT * FROM `user_connections` WHERE `sender_user_id` = '$main_user' AND `connection_status` = 'accepted'  ";
            $res = $db->query($sql) or die($db->error);
            while($row = $res->fetch_array()) 
              $Main_User_Connections[] = $row['receiver_user_id'];
            
            $sql = "SELECT * FROM `user_connections` WHERE `receiver_user_id` = '$main_user' AND `connection_status` = 'accepted'  ";
            $res = $db->query($sql) or die($db->error);
            while($row = $res->fetch_array()) 
              $Main_User_Connections[] = $row['sender_user_id'];

            // I want to suggest some strangers to a main user to add as a connection.
            //Similarly, find all Data of Stranger User & His friends too
            // Based on some complex matching algo, either return true or false for the is_good_match for a new connetion

            return 1;
          }
*/
		?>
			
		</div>
		</div>

	    </div>
	    <!-- End-->

				</div>
			</div>
		</div>
					}
	<!-- BEGIN: FULL PAGE TEXT CONTENT -->

</div>

<?php
include "lib/footer.php";
?>