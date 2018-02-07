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
                        <div class="txtabu">Data keuangan Mahasiswa berdasarkan Tahun Ajaran</div>
                    </div>
                </div>
                <div class="bts-ats2">
                    <div class="col-md-6">
                        <form action="<?php echo base_url('index.php/admin/keuangan/sistem/proses_edit_pembayaran'); ?>" method="post">
                            <label>Jenis Pembayaran</label>
                            <div class="form-control"><?php echo $hasil->nama_jenis_pembayaran; ?></div>
                            <div class="bts-ats">
                            <label>Semester</label>
                                <div class="form-control"><?php echo $hasil->k_index_ta; ?></div>
                            </div>
                            <div class="bts-ats">
                                <label>Biaya</label>
                                <div class="form-control"><?php echo $this->Keuangan_m->get_atur_bayar($hasil->id_atur_pembayaran)->biaya ?></div>
                            </div>
                            <div class="bts-ats">
                                <label>Jumlah Pembayaran</label>
                                <input type="hidden" name="id_mhs" value="<?php echo $hasil->id_mhs; ?>">
                                <input type="hidden" name="id_atur_pembayaran" value="<?php echo $hasil->id_atur_pembayaran; ?>">
                                <input type="hidden" name="id_pembayaran_mhs" value="<?php echo $hasil->id_pembayaran_mhs; ?>">
                                <input type="text" name="jumlah_bayar" class="form-control" value="<?php echo $hasil->jumlah_bayar; ?>" placeholder="Jumlah Bayar">
                            </div>
                            <button type="submit" name="submit" value="submit" class="btn bts-ats2 btn-success" style="width: 100%">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="sambungfloat"></div>
</div>