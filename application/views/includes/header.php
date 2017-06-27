<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $title." - Naker Kerumahtanggan"; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />-->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url(); ?>assets/css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet"> 

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>

<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/screenfull.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
<script>
$(function () {
	$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);
	if (!screenfull.enabled) {
		return false;
	}
	$('#toggle').click(function () {
		screenfull.toggle($('#container')[0]);
	});	
});

base_url = '<?php echo base_url(); ?>';
</script>
</head>
<body>
<div id="wrapper">
	<nav class="navbar-default navbar-static-top" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			    <span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			</button>
			<h1><a class="navbar-brand" href="<?php echo base_url(); ?>" style="font-size: 18px;">Naker Kerumahtanggan</a></h1>         
		</div>
		<div class=" border-bottom">
			<div class="full-left">
				<section class="full-top"></section>
				<div class="clearfix"> </div>
			</div>

	    	<div class="drop-men" style="margin-top: 12px;margin-right: 50px;">
		        <ul class=" nav_1">
		           
		    		<li class="dropdown at-drop">
						<a href="#" class="dropdown-toggle dropdown-at " data-toggle="dropdown"><i class="fa fa-globe"></i> <span class="number" id="count_unread_message"><?php echo $unread_notif_count; ?></span></a>
							<ul class="dropdown-menu menu1 " id="dropdown-notif" role="menu">
							<?php foreach($notif_updates as $notif){ ?>
								<li>
	                                <a href="<?php echo $notif['notif_url'].($notif['notif_status'] == 0 ? '/'.md5($notif['id']) : ''); ?>">
	                                    <div class="user-new" style="width:100px;">
	                                        <p><?php echo $notif['notif_desc']; ?>...</p>
	                                        <span><?php echo $notif['notif_time']; ?></span>
	                                    </div>
	                                    <div class="user-new-left">
	                                        <?php echo $notif['notif_icon']; ?>
	                                    </div>
	                                    <div class="clearfix"> </div>
	                                </a>
	                            </li>
							<?php } ?>
								<li><a href="<?php echo base_url().'notifikasi/all'; ?>" class="view">Lihat semua notifikasi</a></li>
							</ul>
		            </li>
					<li class="dropdown">
		              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><?php echo $_SESSION['login']['nama_user']; ?><i class="caret"></i></span></a>
		              <ul class="dropdown-menu " role="menu">
		                <li><a href="profile.html"><i class="fa fa-user"></i>Edit Profile</a></li>
		                <li><a href="<?php echo base_url().'login/logout'; ?>"><i class="fa fa-danger"></i>Logout</a></li>
		              </ul>
		            </li>
		        </ul>
	    	</div>
			<div class="clearfix"></div>

		    <div class="navbar-default sidebar" role="navigation">
		        <div class="sidebar-nav navbar-collapse">
			        <ul class="nav" id="side-menu">
			        	<li style="text-align: center;margin: 15px 0px 15px 0px;">
			        		<span><?php echo $_SESSION['login']['nama_user']; ?></span>
			        	</li>
			            <?php echo $left_menu; ?>
			        </ul>
		    	</div>
			</div>
	</nav>
	<div id="page-wrapper" class="gray-bg dashbard-1">
    	<div class="content-main">