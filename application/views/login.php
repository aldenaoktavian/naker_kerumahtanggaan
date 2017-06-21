<!DOCTYPE HTML>
<html>
<head>
<title>Login - Naker Kerumahtanggan</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />-->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?php echo base_url(); ?>assets/css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet"> 
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"> </script>
</head>
<body>
	<div class="login">
		<h1><a href="<?php echo base_url(); ?>">Naker Kerumahtanggan</a></h1>
		<div class="login-bottom">
			<form action="<?php echo base_url().'login'; ?>" method="POST">
				<div class="col-md-12 login-do">
					<div class="login-mail">
						<input type="text" placeholder="Username" name="user" required="">
						<i class="fa fa-envelope"></i>
					</div>
					<div class="login-mail">
						<input type="password" placeholder="Password" name="pass" required="">
						<i class="fa fa-lock"></i>
					</div>
					<label class="hvr-shutter-in-horizontal login-sub">
						<input type="submit" value="Login">
					</label>
				</div>
				<div class="clearfix"> </div>
			</form>
		</div>
	</div>
<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
</body>
</html>

