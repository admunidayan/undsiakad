<div class="unirow" id="mainpage">
  <?php $this->load->view('nav/nav-keuangan') ?>
  <div class="col-md-10 unipd" >
        <div class="whitebox2 bts-ats fk-min">
            <div class="prfbox">
                <div class="media bts-bwh">
                    <div class="media-left media-middle">
                        <div class="dashsubttl"><i class="fa fa-th-list"></i></div>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $title; ?></h4>
                        <div class="txtabu">Halaman edit <?php echo $title; ?></div>
                    </div>
                </div>
                <div class="bts-ats2">
                    <div class="col-md-6">
                      <form action="<?php echo base_url('index.php/admin/keuangan/jenis_pembayaran/proses_edit'); ?>" method = "post">
                        <div class="bts-ats">
                          <input type="hidden" name="id_jenis_pembayaran" value="<?php echo $hasil->id_jenis_pembayaran; ?>">
                          <label>Nama Jenis Pembayaran</label>
                          <input type="text" name="nama_jenis_pembayaran" class="form-control" placeholder="Nama Jenis Pembayaran" value="<?php echo $hasil->nama_jenis_pembayaran; ?>">
                        </div>
                        <div class="bts-ats">
                          <label>Kode Jenis Pembayaran</label>
                          <input type="text" name="kode_jenis_pembayaran" class="form-control" placeholder="Kode Jenis Pembayaran" value="<?php echo $hasil->kode_jenis_pembayaran; ?>">
                        </div>
                        <button class="bts-ats2 btn btn-success" style="width:100%" name="submit" type="submit" value="submit">Ubah</button>
                      </form>
                    </div>
                    <div class="sambungfloat"></div>
                </div>
            </div>
        </div>
    </div>

  <div class="sambungfloat"></div>
</div>