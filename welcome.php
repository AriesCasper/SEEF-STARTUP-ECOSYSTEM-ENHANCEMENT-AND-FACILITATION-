<?php
include "lib/config.php";
include "lib/login_check.php";
include "lib/header.php";
?>

<div class="c-layout-page" style="margin-top: 10px; margin-bottom: 0px;">
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
				include "lib/sidebar.php";
				?>				

				</div>

				<div class="col-sm-9" style="border: 1px solid silver;">
					<div class="c-content-feature-1">
						<h3 class="c-font-uppercase c-font-bold">WELCOME TO THE SEEF PLATFORM.</h3>
						<p class="c-font-thin">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
					</div>
				</div>


			</div>
		</div>
	<!-- BEGIN: FULL PAGE TEXT CONTENT -->

</div>

<?php
include "lib/footer.php";
?>