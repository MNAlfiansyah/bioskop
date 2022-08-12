<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bioskop</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?= base_url('assets/login/images/icons/favicon.ico')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/vendor/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/fontawesome/css/all.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/vendor/animate/animate.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/vendor/css-hamburgers/hamburgers.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/vendor/animsition/css/animsition.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/vendor/select2/select2.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/vendor/daterangepicker/daterangepicker.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/css/util.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/css/main.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/dashboard/vendor/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/dashboard/vendor/linearicons/style.css')?>">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w" method="post" action="<?php echo base_url('index.php')?>">
					<span class="login100-form-title p-b-32">
						Bioskop 
					</span>
					<span class="txt1 p-b-11">
						<?php if(isset($error)) { echo $error; }; ?>
					</span>
					<?php echo form_error('username'); ?>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>
					<?php echo form_error('password'); ?>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					<div class="flex w-full p-b-48">

					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
</body>	
<script src="<?= base_url('assets/login/vendor/jquery/jquery-3.2.1.min.js')?>"></script>
<script src="<?= base_url('assets/login/vendor/animsition/js/animsition.min.js')?>"></script>
<script src="<?= base_url('assets/login/vendor/bootstrap/js/popper.js')?>"></script>
<script src="<?= base_url('assets/login/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('assets/login/vendor/select2/select2.min.js')?>"></script>
<script src="<?= base_url('assets/login/vendor/daterangepicker/moment.min.js')?>"></script>
<script src="<?= base_url('assets/login/vendor/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?= base_url('assets/login/vendor/countdowntime/countdowntime.js')?>"></script>
<script src="<?= base_url('assets/login/js/main.js')?>"></script>
<script src="<?= base_url('assets/fontawesome/js/all.js')?>"></script>

</html>