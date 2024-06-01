<?php
include 'lib/config.php';
include 'lib/header.php';
?>

 
	<!-- BEGIN: PAGE CONTAINER -->
	<div class="c-layout-page">
		<!-- BEGIN: PAGE CONTENT -->
		<!-- BEGIN: LAYOUT/SLIDERS/REVO-SLIDER-2 -->

<img src="./assets/base/img/content/backgrounds/header2.jpg" width="100%"  style="margin-top: -100px;">

<div class="c-layout-breadcrumbs-1 c-fonts-uppercase c-fonts-bold">
	<div class="container">
		<div class="c-page-title c-pull-left">
			<h3 class="c-font-uppercase c-font-sbold">All <b>SEEF </b>Members</h3>
		</div>
		
	</div>
</div><!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->


<!-- BEGIN: PAGE CONTENT -->
		<!-- BEGIN: BLOG LISTING -->
<div class="c-content-box c-size-md">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="c-content-blog-post-1-list">
					
					<?php

					$sql = "SELECT * FROM `users` WHERE `status` = 'active' ";
					$res = $db->query($sql);
					while($row = $res->fetch_array()) {

							$fullname  = $row['fullname'];
							
							print <<<EOF
							<!-- start member div -->
					<div class="c-content-blog-post-1">


						<a href="./profiles/$row[user_id]"><img src = "$row[photo]" width = 100 align = left style = "padding: 10px; margin: 10px; border: 1px solid silver; border-radius: 4px;"></a>

						<div class="c-title c-font-bold c-font-uppercase">
							<br><a href="./profiles/$row[user_id]">$fullname</a>
						</div>

						<div class="c-desc">
							$row[qualification] from $row[address_city]
						</div>


					</div>
					<!-- end member div -->
EOF;	
					
					}
					?>

					



					<div class="c-pagination">
						<ul class="c-content-pagination c-theme">
							<li class="c-prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
							<li><a href="#">1</a></li>
							<li class="c-active"><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li class="c-next"><a href="#"><i class="fa fa-angle-right"></i></a></li>							
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3">
			<!-- BEGIN: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
<form action="#" method="post">
	<div class="input-group">
      <input type="text" class="form-control c-square c-theme-border" placeholder="Search blog...">
      <span class="input-group-btn">
        <button class="btn c-theme-btn c-theme-border c-btn-square" type="button">Go!</button>
      </span>
    </div>
</form>

<div class="c-content-ver-nav">
	<div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
		<h3 class="c-font-bold c-font-uppercase">Categories</h3>
		<div class="c-line-left c-theme-bg"></div>
	</div>
	<ul class="c-menu c-arrow-dot1 c-theme">
		<li><a href="#">Web Development(2)</a></li>
		<li><a href="#">UX Design(12)</a></li>
		<li><a href="#">Mobile Development(5)</a></li>
		<li><a href="#">Internet Marketing(7)</a></li>
		<li><a href="#">Social Networks(11)</a></li>
		<li><a href="#">Web Design(18)</a></li>
	</ul>
</div>

			</div>
		</div>
	</div> 
</div>
<!-- END: BLOG LISTING  -->
  

</div>

<!-- END: PAGE CONTAINER -->
		

<?php
include 'lib/footer.php';
?>

