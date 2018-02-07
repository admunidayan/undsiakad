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
                    <h4 class="media-heading">Jenis Pembayaran</h4>
                    <div class="txtabu">Daftar jenis pembayaran mahasiswa</div>
                </div>
            </div>
            <div class="bts-ats2">
                <div class="row">
                    <?php $nomor=1 ?>
                    <?php foreach ($list as $data): ?>
                        <div class="col-md-3 unipd">
                            <div class="prfbox fkpanelbox">
                            <img src="<?php echo base_url('asset/img/icon/'.$nomor.'.png'); ?>">
                                <h4><b><?php echo $data->nama_jenis_pembayaran; ?></b></h4>
                                <a href="<?php echo base_url('index.php/admin/keuangan/sistem/jenisbayar/'.$thn.'/'.$idprod.'/'.$data->id_jenis_pembayaran); ?>" class="btn btn-success">lihat Detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
                            </div>
                        </div>
                        <?php $nomor++ ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sambungfloat"></div>
</div>