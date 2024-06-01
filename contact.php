<?php
include 'lib/config.php';
include 'lib/header.php';

if( isset($_POST['contact_name'])) {

	$name  = trim($_POST['contact_name']);
	$email = trim($_POST['contact_email']);
	$phone = trim($_POST['contact_phone']);
	$message = trim($_POST['contact_message']);

	$sql = "INSERT INTO `contact`(`cname`, `cemail`, `cphone`, `company`, `cmessage`, `timestamp`, `ip`) VALUES ('$name', '$email', '$phone', '',  '$message', '".time()."', '".$_SERVER['REMOTE_ADDR']."' )";
	$db->query($sql);

	$msg = "Thank you for submitting the contact form. We will reach out to you in 2-3 working days.";

	$body = "
	Contact Form filled up on Seef.contact_message

	Name: $name 
	Email: $email
	Phone: $phone 
	Message: $message
	";

	//Send email to admin
	mail("ipeg.solutions@gmail.com", "Contact Form Submission", $body, "From: noreply@seef.com");
}
?>

 
	<!-- BEGIN: PAGE CONTAINER -->
	<div class="c-layout-page">
		<!-- BEGIN: PAGE CONTENT -->
		<!-- BEGIN: LAYOUT/SLIDERS/REVO-SLIDER-2 -->

<img src="./assets/base/img/content/backgrounds/header2.jpg" width="100%"  style="margin-top: -100px;">

<div class="c-layout-breadcrumbs-1 c-fonts-uppercase c-fonts-bold">
	<div class="container">
		<div class="c-page-title c-pull-left">
			<h3 class="c-font-uppercase c-font-sbold">Contact Us</h3>
		</div>
		
	</div>
</div><!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->


<!-- BEGIN: CONTENT/CONTACT/FEEDBACK-1 -->
<div class="c-content-box c-size-md c-bg-white">
	<div class="container">
		<div class="c-content-feedback-1 c-option-1">
			<div class="row">
				<div class="col-md-6">
					<div class="c-container c-bg-green c-bg-img-bottom-right" style="background-image:url(../../assets/base/img/content/misc/feedback_box_1.png)">
						<div class="c-content-title-1 c-inverse">
							<h3 class="c-font-uppercase c-font-bold">Need to know more?</h3>
							<div class="c-line-left"></div>
							<p class="c-font-lowercase">Try visiting our FAQ page to learn more about our greatest ever expanding theme, JANGO.</p>
							<a href="#" class="btn btn-md c-btn-border-2x c-btn-white c-btn-uppercase c-btn-square c-btn-bold">Learn More</a>
						</div>
					</div>
					<div class="c-container c-bg-grey-1 c-bg-img-bottom-right" style="background-image:url(../../assets/base/img/content/misc/feedback_box_2.png)">
						<div class="c-content-title-1">
							<h3 class="c-font-uppercase c-font-bold">Have a question?</h3>
							<div class="c-line-left"></div>
							<form action="#">
								<div class="input-group input-group-lg c-square">
							      	<input type="text" class="form-control c-square" placeholder="Ask a question"/>
							      	<span class="input-group-btn">
							        	<button class="btn c-theme-btn c-btn-square c-btn-uppercase c-font-bold" type="button">Go!</button>
							      	</span>
							    </div>
							</form>
							<p>Ask your questions away and let our dedicated customer service help you look through our FAQs to get your questions answered!</p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="c-contact">
						<div class="c-content-title-1">
							<h3  class="c-font-uppercase c-font-bold">Keep in touch</h3>
							<div class="c-line-left"></div>
							<p class="c-font-lowercase">Our helpline is always open to receive any inquiry or feedback.
							Please feel free to drop us an email from the form below and we will get back to you as soon as we can.</p>

							<?php 
							if(isset($msg))
								print "<div class = \"alert alert-success\">$msg</div>";
							?>
						</div>
						<form action="./contact" method="post">
							<div class="form-group">
                        		<input type="text" placeholder="Your Name" class="form-control c-square c-theme input-lg" name = "contact_name" required>
                        	</div>
                        	<div class="form-group">
                        		<input type="email" placeholder="Your Email" class="form-control c-square c-theme input-lg" name = "contact_email" required>
                        	</div>
                        	<div class="form-group">
                        		<input type="text"  name = "contact_phone" placeholder="Contact Phone" class="form-control c-square c-theme input-lg">
                        	</div>
		                   	<div class="form-group">
                        	   	<textarea rows="8" name="contact_message" placeholder="Write comment here ..." class="form-control c-theme c-square input-lg" required></textarea>
		                    </div>
		                    <input type="submit" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square" value = " Submit ">
	                   	</form>
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>
<!-- END: CONTENT/CONTACT/FEEDBACK-1 -->

</div>

<!-- END: PAGE CONTAINER -->
		

<?php
include 'lib/footer.php';
?>

