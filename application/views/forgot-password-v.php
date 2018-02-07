<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<link rel="shortcut icon" href="<?php echo base_url('asset/img/unidayanbrand2.png'); ?>" alt="forufans Brand">
  <link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap.css'); ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('asset/css/font-awesome.css'); ?>" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url('asset/js/jquery-2.1.3.js'); ?>"></script>
  
  <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url('asset/js/bootstrap.js'); ?>"></script>
  <!-- cssunidayan -->
  <link rel="stylesheet" href="<?php echo base_url('asset/css/unidayan.css'); ?>" type="text/css" />
  <!-- cssunidayan -->
  <link rel="stylesheet" href="<?php echo base_url('asset/css/fakultas.css'); ?>" type="text/css" />
</head>
<body>
	<div style="max-width: 500px; margin-left: auto;margin-right: auto;margin-top: 90px; ">
		<div class="kotaklogin">
			<div class="tengah">
				<h1>FORGOT PASSWORD</h1>
				<?php echo @$message; ?>
			</div>
			<form action="<?php echo base_url('index.php/login/forgot_password'); ?>" method="post">
				<div class="form-groups">
					<input type="text" name="email" class="form-control input-lg" placeholder="Insert your email">
				</div>
				<button class="btn btn-info btn-lg bts-ats" style="width: 100%" type="submit" value="submit" name="submit">Send Forgot Password</button>
			</form>
			<div class="bts-ats2">
				<a href="<?php echo base_url('index.php/login'); ?>"><i class="fa fa-arrow-left"></i> Back to login page.</a>
 			</div>	
		</div>
	</div>
</body>
</html>
