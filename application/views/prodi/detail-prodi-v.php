<script>
  $(function () {
    $('#detailprodi').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false
    });
  });
</script>
<div class="unirow bts-ats">
  <div class="col-md-8 unipd">
    <?php if ($this->session->flashdata('import')): ?>
      <?php echo $this->session->flashdata('import');?>
    <?php endif ?>
    <div class="whitebox2">
      <div class="prfbox">
        <div class="bts-ats">
          <div class="media">
            <div class="media-left media-middle">
              <div class="dashsubttl"><i class="fa fa-institution"></i></div>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Matakuliah di Program Studi <?php echo $getprod->nama_prodi ?></h4>
              Daftar Matakuliah di Program Studi <?php echo $getprod->nama_prodi ?>.
            </div>
            <div class="media-right media-middle">
              <button class="btn buttonlist bghijau txtputih" data-toggle="modal" data-target=".addpangkat"><i class="fa fa-plus-circle"></i> <b>Upload Data Exel</b></button>
            </div>
            <div class="media-right media-middle">
              <button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target="#addmatkul"><i class="fa fa-plus-circle"></i> <b>Tambah Matakuliah</b></button>
            </div>
          </div>
        </div>
        <div class="table-responsive bts-ats2">
          <table id="detailprodi" class="table">
            <thead>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($getdtprodmk as $dfk ): ?>
                <tr>
                  <td>
                    <div class="u11 tengah">SMTR <?php echo $dfk->id_semester; ?></div>
                  </td>
                  <td>
                    <div class="dashsubttl3"><?php echo $dfk->kode_matakuliah; ?>
                      <?php if ($dfk->status_matakuliah == 'Nonaktif'): ?>
                        <span class="unispan bgmerah"><?php echo $dfk->status_matakuliah ?></span>
                        <?php else: ?>
                          <span class="unispan bghijau"><?php echo $dfk->status_matakuliah ?></span>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td>
                    <h5 class="media-heading nobold"><?php echo $dfk->nama_matakuliah; ?>
                      <?php if ($dfk->tipe_matakuliah == 'Wajib'): ?>
                        <span class="unispan bghijau"><?php echo $dfk->tipe_matakuliah ?></span>
                        <?php else: ?>
                          <span class="unispan bgpink"><?php echo $dfk->tipe_matakuliah ?></span>
                        <?php endif; ?>
                    </h5>
                    <div class="txtabu nobold u11"><?php $ket = $dfk->ket_matakuliah; echo character_limiter($ket, 140);?></div>
                  </td>
                  <td>
                    <div class="dashsubttl3 nobold"><?php echo $dfk->jumlah_sks; ?> sks</div>
                  </td>
                  <td>
                    <a href="<?php echo base_url('admin/Administrator_c/delete_aturan_matkuldi_prodi/'); ?>/<?php echo $getprod->id_prodi ?>/<?php echo $dfk->id_atur_matkul; ?>"><div class="buttonlist bgpink txtputih"><b>Hapus</b></div></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php if (!empty($getprod)): ?>
      <div class="akumulasibox bgbirut txtputih">
        <div class="media">
          <div class="media-body media-middle">
            <h5 class="media-heading">Jumlah total Matakuliah di Prodi <?php echo $getprod->nama_prodi ?></h5>
            Akumulasi dari Jumlah Matakuliah di Prodi <?php echo $getprod->nama_prodi ?>.
          </div>
          <div class="media-right media-middle">
            <div class="dashsubttl3"><b><?php echo $this->Prodi_m->count_matkul_prod($getprod->id_prodi) ?> Matkul</b></div>
          </div>
          <div class="media-right media-middle">
            <div class="dashsubttl3"><b><?php echo $this->Prodi_m->count_mhs_prod($getprod->id_prodi) ?> Mhs</b></div>
          </div>
        </div>
      </div>
    <?php else: ?>

    <?php endif ?>
  </div>
  <div class="col-md-4 unipd">
    <div class="whitebox2">
      <div class="prfbox">
        <div class="bts-ats">
          <div class="media">
            <div class="media-left media-middle">
              <div class="dashsubttl"><i class="fa fa-institution"></i></div>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Detail Program Studi <?php echo $getprod->nama_prodi ?></h4>
              Informasi Program Studi <?php echo $getprod->nama_prodi ?>.
            </div>
          </div>
        </div>
        <?php if ($this->session->flashdata('message')): ?>
          <div class="alert alert-info alert-dismissible bts-ats bts-bwh" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
          </div>
        <?php endif ?>
        <form class="bts-ats2" action="<?php echo base_url('admin/Administrator_c/proses_update_prodi'); ?>" method="post">
          <div class="input-group">
            <span class="input-group-addon"><div class="bts-sm">KDP</div></span>
            <input type="hidden" name="id_prodi" value="<?php echo $getprod->id_prodi ?>">
            <input type="text" name="kode_prodi" class="form-control" placeholder="Kode prodi" value="<?php echo $getprod->kode_prodi ?>">
          </div>
          <div class="input-group bts-ats">
            <span class="input-group-addon"><div class="bts-sm">NMP</div></span>
            <input type="text" name="nama_prodi" class="form-control" placeholder="Nama prodi" value="<?php echo $getprod->nama_prodi ?>">
          </div>
          <div class="input-group bts-ats">
            <span class="input-group-addon"><div class="bts-sm">JEN</div></span>
            <select class="form-control" name="id_jenjang_pend">
              <option value="<?php echo $getprod->id_jenjang_pend ?>">-- <?php echo $getprod->nama_jenjang_pend ?> --</option>
              <?php foreach ($dtajp as $jen): ?>
                <option value="<?php echo $jen->id_jenjang_pend ?>"><?php echo $jen->nama_jenjang_pend ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="input-group bts-ats">
            <span class="input-group-addon"><div class="bts-sm">FKS</div></span>
            <select class="form-control" name="id_fakultas">
              <option value="<?php echo $getprod->id_fakultas ?>">-- <?php echo $getprod->nama_fakultas ?> --</option>
              <?php foreach ($dtafk as $fk): ?>
                <option value="<?php echo $fk->id_fakultas ?>"><?php echo $fk->nama_fakultas ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="input-group bts-ats">
            <span class="input-group-addon"><div class="bts-sm">AKR</div></span>
            <input type="text" name="akreditasi_prodi" class="form-control" placeholder="Akreditasi prodi" value="<?php echo $getprod->akreditasi_prodi ?>">
          </div>
          <div class="input-group bts-ats">
            <span class="input-group-addon"><div class="bts-sm">STS</div></span>
            <select class="form-control" name="status_prodi">
              <option value="<?php echo $getprod->status_prodi ?>">-- <?php echo $getprod->status_prodi ?> --</option>
              <option value="Aktif">Aktif</option>
              <option value="Nonaktif">Nonaktif</option>
            </select>
          </div>
          <textarea class="form-control bts-ats bts-bwh" placeholder="Keterangan prodi" name="ket_prodi" rows="5"><?php echo $getprod->ket_prodi ?></textarea>
          <button type="submit" name="submit" value="submit" class="btn btn-default btn-lg bts-bwh kanan"><b>Simpan</b></button>
        </form>
        <div class="sambungfloat"></div>
      </div>
    </div>
  </div>
  <div class="sambungfloat"></div>
</div>
<!-- modal Add Fakultas -->
<div class="modal fade" id="addmatkul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title tengah" id="myModalLabel">Tambahkan Matakuliah</h4>
      </div>
      <div class="modal-body">
        <div class="prfbox">
          <?php foreach ($mkygblumada as $data): ?>
            <form id="formaddmatkul<?php echo $data->id_matakuliah; ?>" action="#" >
              <input type="hidden" name="id_matakuliah" value="<?php echo $data->id_matakuliah; ?>">
              <input type="hidden" name="id_jenjang_pend" value="<?php echo $getprod->id_jenjang_pend ?>">
              <input type="hidden" name="id_fakultas" value="<?php echo $getprod->id_fakultas ?>">
              <input type="hidden" name="id_prodi" value="<?php echo $getprod->id_prodi ?>">
              <div class="media dashunittl">
                <div class="media-left media-middle">
                  <div class="dashsubttl3 u15">S<?php echo $data->id_jenjang_pend; ?></div>
                </div>
                <div class="media-body media-middle">
                  <h5 class="media-heading nobold"><?php echo $data->nama_matakuliah; ?></h5>
                  <div class="txtabu nobold"><?php $ket = $data->ket_matakuliah; echo character_limiter($ket, 100);?></div>
                </div>
                <div class="media-right media-middle">
                  <select class="unisel" name="id_semester">
                    <option value="<?php echo $data->semester_matakuliah ?>">-- smstr <?php echo $data->semester_matakuliah ?> --</option>
                    <?php foreach ($dtsmstr as $jen): ?>
                      <option value="<?php echo $jen->id_semester ?>">smstr <?php echo $jen->id_semester ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="media-right media-middle">
                  <button type="button" id="btnaddmk" onclick="ajaxaddmatkul(<?php echo $data->id_matakuliah; ?>)" class="btn buttonlist bgbirut txtputih"><b>Pilih</b></button>
                </div>
              </div>
            </form>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- modal add pemangkatan -->
<div class="modal fade addpangkat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="prfbox">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Upload Data Excel</h4>
        <form action="<?php echo base_url('admin/importund_c/proses_import_mk_prod'); ?>/<?php echo $getprod->id_jenjang_pend ?>/<?php echo $getprod->id_fakultas ?>/<?php echo $getprod->id_prodi ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputEmail1">Masukan File Exel</label>
            <input type="file" name="semester" class="form-control" placeholder="File.exl">
          </div>
          <button class="btn btn-default kanan" value="submit" name="submit">Upload</button>
        </form>
        <div class="sambungfloat"></div>
      </div>
    </div>
  </div>
</div>
<script>
function ajaxaddmatkul(id){
  $.ajax({
    url : "<?php echo base_url('admin/Administrator_c/proses_add_aturan_matkul_di_prodi'); ?>",
    type: "post",
    data: $('#formaddmatkul'+id).serialize(),
    dataType: "json",
    success:function(data)
    {
      // alert('success adding / Updating data');
      $('#formaddmatkul'+id).hide();
      ajaxreloadmkprod();
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      alert('error adding / Updating data');
    }
  });
}
function ajaxreloadmkprod(){
  $.ajax({
    url : "<?php echo base_url('admin/Administrator_c/reload_mk_prod/'.$this->uri->segment(2, 0)); ?>", // 2, 0 maksudnya mengambil data ke 2 dari url
    type: "get",
    success:function(data)
    {
      $('.reloadmkprod').html(data);
    },
    error: function () // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
    {
      alert('error adding / Updating data');
    }
  });
}
</script>
