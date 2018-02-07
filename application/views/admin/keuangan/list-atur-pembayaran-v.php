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
            <div class="txtabu">Data list <?php echo $title; ?></div>
          </div>
          <div class="media-right">
            <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Tambah Jenis Pembayaran</button>
          </div>
        </div>
        <div class="bts-ats2">
          <div class="col-md-8">
            <table border="1" width="100%">
              <thead>
                <tr>
                  <th class="tengah fkpading">No</th>
                  <th class="tengah fkpading">Nama</th>
                  <th class="tengah fkpading">Kode</th>
                  <th class="tengah fkpading">Angkatan</th>
                  <th class="tengah fkpading">Biaya</th>
                  <th class="tengah fkpading">Action</th>
                </tr>
              </thead>
              <tbody>
               <?php $nomor =1 ?>
               <?php foreach ($hasil as $data): ?>
                 <?php if ($data->id_atur_pembayaran !== 99): ?>
                   <tr>
                     <td class="tengah fkpading"><?php echo $nomor; ?></td>
                     <td class="tengah fkpading"><?php echo $data->nama_jenis_pembayaran; ?></td>
                     <td class="tengah fkpading"><?php echo $data->kode_jenis_pembayaran; ?></td>
                     <td class="tengah fkpading"><?php echo $data->kode_angkatan; ?></td>
                     <td class="tengah fkpading"><?php echo $data->biaya; ?></td>
                     <td class="tengah fkpading">
                       <a href="<?php echo base_url('index.php/admin/keuangan/jenis_pembayaran/edit__jenis_pembayaran/'.$data->id_atur_pembayaran); ?>" class="label label-success"><i class="fa fa-pencil"></i> edit</a>
                     </td>
                   </tr>
                 <?php else: ?>
                 <?php endif ?>
                 <?php $nomor++ ?>
               <?php endforeach ?>
             </tbody>
           </table>
         </div>
         <div class="sambungfloat"></div>
       </div>
     </div>
   </div>
   </div>
 <div class="sambungfloat"></div>
</div>
<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Jenis Pembayaran</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('index.php/admin/keuangan/atur_pembayaran/create'); ?>" method = "post">
            <div class="bts-ats">
                <label>Nama Jenis Pembayaran</label>
                <select class="form-control" name="id_jenis_pembayaran">
                  <?php foreach ($listjenis as $data): ?>
                    <option value="<?php echo $data->id_jenis_pembayaran; ?>"><?php echo $data->nama_jenis_pembayaran; ?></option>
                  <?php endforeach ?>
                </select>
            </div>
            <div class="bts-ats">
                <label>Angkatan</label>
                <select class="form-control" name="kode_angkatan">
                  <?php foreach ($angkatan as $data): ?>
                    <option value="<?php echo $data->kode_angkatan; ?>"><?php echo $data->kode_angkatan; ?></option>
                  <?php endforeach ?>
                </select>
            </div>
            <div class="bts-ats">
                <label>Jumlah Biaya Yang Harus Dibayar</label>
                <input type="text" name="biaya" class="form-control" placeholder="100000 tanpa titik">
            </div>
            <button class="bts-ats2 btn btn-success" style="width:100%" name="submit" type="submit" value="submit">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>