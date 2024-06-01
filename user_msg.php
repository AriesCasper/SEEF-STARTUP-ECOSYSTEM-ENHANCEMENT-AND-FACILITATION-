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
						

						<br><br>
					<center>
						<div class="alert alert-success">
						<?php
						switch($_GET['msg'])
						{
						
							case "1":
								print "<h3>Your profile has been successfully edited.</h3>";
								break;

							case "2":
								print "<h3>Your photo has been successfully replaced.</h3>";
								break;

							case "3":
								print "<h3>Your CV has been successfully replaced.</h3>";
								break;

							case "4":
								print "<h3>Your Password has been successfully updated.</h3>";
								break;

							case "5":
								print "<h3>Your Work History has been added.</h3>";
								break;

							case "6":
								print "<h3>Your Work History has been removed.</h3>";
								break;

							case "7":
								print "<h3>Your Work History has been Edited.</h3>";
								break;

							case "8":
								print "<h3>Your Education History has been Added.</h3>";
								break;
								
							case "9":
								print "<h3>Your Education History has been Removed.</h3>";
								break;

							case "10":
								print "<h3>Successfully added the new startup. Best of Luck!!!</h3>";
								break;

						}
						?>
						</div>
					
					</center>
					
					</div>
				</div>


			</div>
		</div>
	<!-- BEGIN: FULL PAGE TEXT CONTENT -->

</div>

<?php
include "lib/footer.php";
?>