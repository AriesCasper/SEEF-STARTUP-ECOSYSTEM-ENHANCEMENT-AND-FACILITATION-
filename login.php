<?php
include 'lib/config.php';

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	header("Location: welcome.php"); die("Force header");
}

//AutoLogin
if(isset($_COOKIE['REMEMBER_ME_TOKEN']) && strlen($_COOKIE['REMEMBER_ME_TOKEN'])>2) {
	//die($_COOKIE['REMEMBER_ME_TOKEN']);
	header("Location: verify.php"); die("Force header");
}


include 'lib/header.php';
?>
<!-- BEGIN: PAGE CONTAINER -->
<div class="c-layout-page">
		<!-- BEGIN: PAGE CONTENT -->
 
<!-- BEGIN: CONTENT/MISC/ABOUT-1 -->
<div class="c-content-box c-size-md c-bg-white">
	<div class="container" style="padding-top: 100px;">
		<div class="row">

			
			<div class="c-content-title-1" >
			
				<p class="c-font-lowercase">
					Please Login:
				</p>
				 <h3 class="box-title"><?php print $_GET['msg'] ?? "";?></h3>
			</div>

			<div class="row">
			<div class="col-md-4" align="center"></div>
			<div class="col-md-4" align="center">
			<form  method="POST" action="verify.php">
				
				<div class="form-group">
					<input type="email" required name="email" placeholder="Your Email" class="form-control c-square c-theme input-lg" value="<?php if( isset($_GET['email'])) print $_GET['email']; ?>">
				</div>
				
				<div class="form-group">
					<input type="password" required  name="password" placeholder="Password" class="form-control c-square c-theme input-lg">
				</div>
				
				<div class="form-group">
					<table >
					<tr>
						<td><input type="checkbox"   name="remember"  value = "true"> &nbsp; </td>
						<td>Remember Me</td>
					</tr>
					</table>
				</div>
				
				<button type="submit" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">Login</button>
			</form>

			<br>
			<table width="100%">
				<tr>
					<td><div style = "text-align: left; "><A HREF = "register_simple" >New User? Register. </A></div></td>
					<td><div style = "text-align: right; "><A HREF = "forgot_password" >Forgot Password? </A></div></td>
				</tr>
			</table>
			
			

			</div>
			<div class="col-md-4" align="center"></div>
			</div>


		</div>
	</div> 
</div><!-- END: CONTENT/MISC/ABOUT-1 -->
		<!-- END: PAGE CONTENT -->

</div>

<!-- END: PAGE CONTAINER -->
		

<?php
include 'lib/footer.php';
?>

