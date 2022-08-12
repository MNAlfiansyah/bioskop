<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/vendor/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/vendor/linearicons/style.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/vendor/chartist/css/chartist-custom.css')?>">
	<!-- DATATABLE-->
	<link rel="stylesheet" href="<?php echo base_url('assets/datatable/css/jquery.dataTables.min.css');?>">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/css/main.css')?>">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?= base_url('assets/dashboard/css/demo.css')?>">
	<!-- ICONS -->
	<!-- <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/dashboard/img/apple-icon.png')?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets/dashboard/img/favicon.png')?>"> -->
	<title>Bioskop</title>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="" class="simple-text"><i class="fas fa-film fa-lg"></i> BIOSKOP
				</a>
			</div>
			<div class="container-fluid">
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="#"><span><i class="fas fa-user fa-lg"></i> <?php echo $this->session->userdata("user_nama");?></span></a>
						</li>
						<li>
							<a href="<?php echo base_url('index.php/login/logout');?>" >Logout</a>
						</li>
					</ul>
				</div>
			</div>

		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		
	<!-- END LEFT SIDEBAR -->