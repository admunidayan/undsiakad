<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <link rel="shortcut icon" href="<?php echo base_url('asset/img/unidayanbrand2.png'); ?>" alt="forufans Brand">
  <link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap.css'); ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('asset/css/font-awesome.css'); ?>" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url('asset/js/jquery.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/js/jui/jquery-ui.js'); ?>"></script>
  <!-- <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet"> -->
  <script type="text/javascript" src="<?php echo base_url('asset/js/bootstrap.js'); ?>"></script>
  <!-- cssunidayan -->
  <link rel="stylesheet" href="<?php echo base_url('asset/css/unidayan.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('asset/css/fakultas.css'); ?>" type="text/css" />
</head >
<body >
  <nav class="dashuninav navbar-fixed-top" role="navigation">
    <div class="mainbox2">
      <div class="col-md-8 paddingnone">
        <div class="bguni">
          <a href="<?php echo base_url('uni-admin'); ?>"><div class="dashunibrand"><img class="dashlogo" src="<?php echo base_url('asset/img/unidayanbrand2.png'); ?>" alt="logo Unidayan" /></div></a>
          <a href="<?php echo base_url('uni-admin'); ?>"><div class="dashunilogospan">Universitas Dayanu Ikshanuddin</div></a>
        </div>
      </div>
      <div class="col-md-4 paddingnone">
      <div class="dashmenu kanan">
        <img src="<?php echo base_url('asset/img/users/'); ?><?php echo $dtadm->profile; ?>" style="width:18px; border:1px solid white" >
      </div>
      <a href="<?php echo base_url('index.php/login/logout'); ?>"><div class="dashmenu kanan">Logout <i class="fa fa-power-off"></i></div></a>
      </div>
      <div class="sambungfloat"></div>
    </div>
  </nav>
  <div class="dashuninav" role="navigation">
    <div class="mainbox2">
      <div class="col-md-8 paddingnone">
        <div class="bguni">
          <a href="#" class="dashunibrand"><img class="dashlogo" src="<?php echo base_url('asset/img/unidayanbrand2.png'); ?>" alt="logo Unidayan" /></a>
          <a href="#" class="dashunilogospan">Universitas Dayanu Ikshanuddin</a>
        </div>
      </div>
      <div class="col-md-4 paddingnone">
        <a href="#"><div class="dashmenu kanan">Logout <i class="fa fa-power-off"></i></div></a>
      </div>
      <div class="sambungfloat"></div>
    </div>
  </div>
  <div class="col-md-2 paddingnone">
    <div class="unipd">
      <!-- bagian menu dashuni -->
      <?php $this->load->view($nav); ?>
      <div class="dashmenuftr"></div>
    </div>
  </div>
  <div class="col-md-2 paddingnone"></div>
  <div class="col-md-10 paddingnone">
    <div class="unipd" style="height: 100%">
      <?php $this->load->view($page); ?>
    </div>
  </div>
</body>
</html>