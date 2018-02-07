<div class="col-md-2 unipd navbar-fixed-top bts-ats3 visible-lg" style="height:100%;">
  <div class="whitebox dashprofilbox bts-ats">
    <!-- bagian profil -->
    <div class="media">
      <div class="media-left media-middle">
        <a href="#">
          <img class="media-object mdling" src="<?php echo base_url('asset/img/users/'); ?><?php echo $dtadm->profile; ?>" alt="gambar">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">
          <div class="staisi">
            <?php if ($dtadm->active ==1): ?>
              <i class="fa fa-diamond u11 txtmerah"></i>
            <?php endif ?>
          </div>
        </h4>
        <div class="staisi"><b>NIM</b> : <?php echo $dtadm->username; ?> </div>
        <div class="staisi"><b>EML</b> : <?php echo $dtadm->email; ?></div>
      </div>
    </div>
  </div>
  <div class="whitebox" style="height:82%;overflow: scroll;">
    <a href="<?php echo base_url('index.php/admin/dashboard_c'); ?>"><div class="dashmenuaside">
      <div class="media">
        <div class="media-left media-middle">
          <i class="fa fa-diamond u15"></i>
        </div>
        <div class="media-body">
          <h6 class="media-heading nobold">Home</h6>
          <div class="txtabu nobold">Halaman Utama Administrator, berisi menu action admin</div>
        </div>
      </div>
    </div></a>
    <a href="<?php echo base_url('index.php/admin/keuangan/sistem'); ?>"><div class="dashmenuaside">
      <div class="media">
        <div class="media-left media-middle">
          <i class="fa fa-credit-card"></i>
        </div>
        <div class="media-body">
          <h6 class="media-heading nobold">Keuangan</h6>
          <div class="txtabu nobold">Data Keuangan Mahasiswa</div>
        </div>
      </div>
    </div></a>
    <a href="<?php echo base_url('index.php/fakultas/fakultas'); ?>"><div class="dashmenuaside">
      <div class="media">
        <div class="media-left media-middle">
          <i class="fa fa-flag"></i>
        </div>
        <div class="media-body">
          <h6 class="media-heading nobold">Fakultas</h6>
          <div class="txtabu nobold">Daftar lengkap FAkultas</div>
        </div>
      </div>
    </div></a>
    <a href="<?php echo base_url('index.php/prodi/prodi'); ?>"><div class="dashmenuaside">
      <div class="media">
        <div class="media-left media-middle">
          <i class="fa fa-flag"></i>
        </div>
        <div class="media-body">
          <h6 class="media-heading nobold">Program Studi</h6>
          <div class="txtabu nobold">Daftar lengkap prodi</div>
        </div>
      </div>
    </div></a>
    <a href="<?php echo base_url('index.php/admin/dosen'); ?>"><div class="dashmenuaside">
      <div class="media">
        <div class="media-left media-middle">
          <i class="fa fa-heart"></i>
        </div>
        <div class="media-body">
          <h6 class="media-heading nobold">Dosen</h6>
          <div class="txtabu nobold">Daftar Dosen Unidayan</div>
        </div>
      </div>
    </div></a>
    <a href="<?php echo base_url('index.php/admin/groups'); ?>"><div class="dashmenuaside">
      <div class="media">
        <div class="media-left media-middle">
          <i class="fa fa-heart"></i>
        </div>
        <div class="media-body">
          <h6 class="media-heading nobold">Groups</h6>
          <div class="txtabu nobold">Daftar Groups</div>
        </div>
      </div>
    </div></a>
    <a href="<?php echo base_url('index.php/admin/karyawan'); ?>"><div class="dashmenuaside">
      <div class="media">
        <div class="media-left media-middle">
          <i class="fa fa-users"></i>
        </div>
        <div class="media-body">
          <h6 class="media-heading nobold">Karyawan</h6>
          <div class="txtabu nobold">List Karyawan</div>
        </div>
      </div>
    </div></a>
    <a href="<?php echo base_url('index.php/admin/import'); ?>"><div class="dashmenuaside">
      <div class="media">
        <div class="media-left media-middle">
          <i class="fa fa-download"></i>
        </div>
        <div class="media-body">
          <h6 class="media-heading nobold">Import</h6>
          <div class="txtabu nobold">Import data feeder</div>
        </div>
      </div>
    </div></a>
    <a href="<?php echo base_url('index.php/admin/export'); ?>"><div class="dashmenuaside">
      <div class="media">
        <div class="media-left media-middle">
          <i class="fa fa-upload"></i>
        </div>
        <div class="media-body">
          <h6 class="media-heading nobold">Export</h6>
          <div class="txtabu nobold">Export data ke feeder</div>
        </div>
      </div>
    </div></a>
    <a href="<?php echo base_url('index.php/admin/setting'); ?>"><div class="dashmenuaside">
      <div class="media">
        <div class="media-left media-middle">
          <i class="fa fa-gear"></i>
        </div>
        <div class="media-body">
          <h6 class="media-heading nobold">Setting</h6>
          <div class="txtabu nobold">Pengaturan tambahan</div>
        </div>
      </div>
    </div></a>
  </div>
  <div class="dashmenuftr"><i class="fa fa-copyright txtabu"></i> Univesitas Dayanu Ikhsanuddin</div>
</div>
<div class="hidden-lg hiduninav bts-ats whitebox2">
  <div class="prfbox">
    <div class="unibtnav u20" data-toggle="collapse" data-parent="#accordion" href="#uninavmen" aria-expanded="false" aria-controls="uninavmen">
      <i class="fa fa-arrow-down txtbiru"></i>
    </div>
    <div id="uninavmen" role="tabpanel" aria-labelledby="uninavmen">
      <a href="<?php echo base_url('uni-administrator'); ?>"><div class="dashmenuaside">
        <div class="media">
          <div class="media-left media-middle">
            <i class="fa fa-diamond u15"></i>
          </div>
          <div class="media-body">
            <h6 class="media-heading nobold">Home</h6>
            <div class="txtabu nobold">Halaman Utama Administrator, berisi menu action admin</div>
          </div>
        </div>
      </div></a>
      <a href="<?php echo base_url('adm-fakultas'); ?>"><div class="dashmenuaside">
        <div class="media">
          <div class="media-left media-middle">
            <i class="fa fa-institution u15"></i>
          </div>
          <div class="media-body">
            <h6 class="media-heading nobold">Fakultas</h6>
            <div class="txtabu nobold">Daftar lengkap fakultas</div>
          </div>
        </div>
      </div></a>
      <a href="<?php echo base_url('adm-prodi'); ?>"><div class="dashmenuaside">
        <div class="media">
          <div class="media-left media-middle">
            <i class="fa fa-flag"></i>
          </div>
          <div class="media-body">
            <h6 class="media-heading nobold">Program Studi</h6>
            <div class="txtabu nobold">Daftar lengkap prodi</div>
          </div>
        </div>
      </div></a>
      <a href="<?php echo base_url('adm-matakuliah'); ?>"><div class="dashmenuaside">
        <div class="media">
          <div class="media-left media-middle">
            <i class="fa fa-television"></i>
          </div>
          <div class="media-body">
            <h6 class="media-heading nobold">Matakuliah</h6>
            <div class="txtabu nobold">List Matakuliah</div>
          </div>
        </div>
      </div></a>
      <a href="<?php echo base_url('adm-mahasiswa'); ?>"><div class="dashmenuaside">
        <div class="media">
          <div class="media-left media-middle">
            <i class="fa fa-graduation-cap"></i>
          </div>
          <div class="media-body">
            <h6 class="media-heading nobold">Mahasiswa</h6>
            <div class="txtabu nobold">Detail mahasiswa</div>
          </div>
        </div>
      </div></a>
      <a href="<?php echo base_url('adm-akun-administrator'); ?>"><div class="dashmenuaside">
        <div class="media">
          <div class="media-left media-middle">
            <i class="fa fa-users"></i>
          </div>
          <div class="media-body">
            <h6 class="media-heading nobold">Akun Administrator</h6>
            <div class="txtabu nobold">List Akun Administrator</div>
          </div>
        </div>
      </div></a>
      <a href="#"><div class="dashmenuaside">
        <div class="media">
          <div class="media-left media-middle">
            <i class="fa fa-gear"></i>
          </div>
          <div class="media-body">
            <h6 class="media-heading nobold">Setting</h6>
            <div class="txtabu nobold">Pengaturan tambahan</div>
          </div>
        </div>
      </div></a>
    </div>
  </div>
</div>
