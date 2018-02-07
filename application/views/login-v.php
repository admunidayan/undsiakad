<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<link rel="shortcut icon" href="<?php echo base_url('asset/img/unidayanbrand2.png'); ?>" alt="forufans Brand">
  <link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap.css'); ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('asset/css/font-awesome.css'); ?>" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url('asset/js/jquery.js'); ?>"></script>
  
  <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url('asset/js/bootstrap.js'); ?>"></script>
  <!-- cssunidayan -->
  <link rel="stylesheet" href="<?php echo base_url('asset/css/unidayan.css'); ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('asset/css/fakultas.css'); ?>" type="text/css" />
</head>
<body>
  <div class="mainkotak">
    <?php if ($this->session->flashdata('message')): ?>
      <div class="row">
        <div class="alert alert-danger alert-dismissible tengah" role="alert" style="margin-bottom: 7px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-warning"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
      </div>
      </div>
    <?php endif ;?>
    <div class="row">
    <div class="col-md-6 paddingnone" style="background-color: #cccccc; min-height: 465px">
      </div>
      <div class="col-md-6 paddingnone">
        <div class="kotaklgin">
          <h1><?php echo $title; ?></h1>
          <form action="<?php echo base_url('index.php/login/proses_login'); ?>" method="POST">
            <div class="bts-ats2">
              <input type="text" class="fkinput" name="username" placeholder="Username">
              <input type="password" class="fkinput bts-ats2" name="password" placeholder="Password">
              <div class="row bts-ats2">
                <div class="col-md-6" style="text-align: left;">
                  <input type="checkbox"  name="remember"> remember me
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <a href="<?php echo base_url('index.php/login/forgot_password'); ?>">Forgot Password ?</a>
                </div>
                <div class="sambungfloat"></div>
              </div>
            </div>
            <button style="width:100%" class="btn buttonlist-lg bghijau bts-ats2" name="submit" value="submit" type="submit">Log In</button>
          </form>
          <div class="bts-ats2" style="color:#cccccc; margin-top: 20px;" >www.fakultas.und.ac.id</div>
        </div>
      </div>
      <div class="sambungfloat"></div>
    </div>
  </div>
</body>
</html>