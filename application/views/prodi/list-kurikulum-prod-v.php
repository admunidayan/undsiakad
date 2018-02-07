<div class="unirow" id="mainpage">
  <?php $this->load->view('nav/nav-prodi') ?>
  <div class="col-md-10 unipd">
    <div class="whitebox2 bts-ats fk-min">
     <div class="prfbox">
      <div class="bts-ats">
       <div class="media">
        <div class="media-left media-middle">
         <div class="dashsubttl"><i class="fa fa-graduation-cap"></i></div>
       </div>
       <div class="media-body">
         <h4 class="media-heading">Daftar Kurikulum Prodi <?php echo $getprod->nm_lemb ?> </h4>
         <div class="txtabu">Daftar kurikulum Universitas Dayanu Ikhsanuddin Baubau</div>
       </div>
       <div class="media-right media-middle">
         <button class="btn btn-success" data-toggle="modal" data-target="#addmhs"><i class="fa fa-plus-circle"></i> <b>Buat Kurikulum</b></button>
       </div>
     </div>
   </div>
   <div class="bts-ats2">
     <div class="">
      <table border="1" width="100%">
       <thead>
        <tr>
          <th class="tengah fkpading" rowspan="2">No.</th>
          <th class="tengah fkpading" rowspan="2">Nama Kurikulum</th>
          <th class="tengah fkpading" rowspan="2">Mulai Berlaku</th>
          <th class="tengah fkpading" colspan="3">SKS</th>
          <th class="tengah fkpading" rowspan="2">SYC</th>
          <th class="tengah fkpading" rowspan="2" colspan="2">ACTION</th>
        </tr>
        <tr>
          <th class="tengah fkpading">Wajib</th>
          <th class="tengah fkpading">Pilihan</th>
          <th class="tengah fkpading">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1 ?>
        <?php foreach ($hasil as $mhs): ?>
         <tr>
         <td class="tengah fkpading"><?php echo $no ?>.</td>
           <td class="fkpading">
            <a href="<?php echo base_url('index.php/prodi/kurikulum/mkbyprod/'.$getprod->kode_prodi.'/'.$mhs->id) ?>"><b><?php echo $mhs->nm_kurikulum_sp; ?></b></a>
         </td>
         <td class="tengah fkpading"><?php echo $mhs->id_smt; ?></td>
         <td class="tengah fkpading"><?php echo $mhs->jml_sks_wajib ?></td>
         <td class="tengah fkpading"><?php echo $mhs->jml_sks_pilihan ?></td> 
         <td class="tengah fkpading"><?php echo $mhs->jml_sks_lulus ?></td>
         <td class="tengah fkpading">
           <?php if ($mhs->id_kurikulum_sp== NULL): ?>
             <label class="label label-warning">not exported</label>
           <?php else: ?>
             <label class="label label-success">exported</label>
           <?php endif ?>
         </td>
         <td class="tengah fkpading"><a href="<?php echo base_url('index.php/prodi/kurikulum/mkbyprod/'.$getprod->kode_prodi.'/'.$mhs->id) ?>"><i class="fa fa-pencil"></i></a></td>
         <td class="tengah fkpading"><a href="<?php echo base_url('index.php/prodi/kurikulum/delete_kurikulum/'.$mhs->id); ?>" onclick="javascript: return confirm('Yakin menghapus Kurikulum ini ?')" class="label label-danger"><i class="fa fa-trash"></i></a></td>
       </tr>
     <?php $no++ ?>
   <?php endforeach; ?>
 </tbody>
</table>
</div>
<div class="sambungfloat"></div>
</div>
<div class="sambungfloat"></div>
</div>
<div class="sambungfloat"></div>
</div>
<div class="sambungfloat"></div>
</div>
<!-- modal Add kur -->
<div class="modal fade" id="addmhs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Buat Kurikulum</h4>
      </div>
      <div class="prfbox">
        <form method="post" action="<?php echo base_url('index.php/prodi/kurikulum/proses_add_kurikulum') ?>">
          <div class="form-group">
            <input type="hidden" name="id_prodi" value="<?php echo $dtamhsprod->id_prodi ?>">
            <input type="hidden" name="kode_jurusan" value="<?php echo $dtamhsprod->kode_prodi ?>">
            <input type="hidden" name="id_jenjang_pend" value="<?php echo $dtamhsprod->id_jenjang_pend ?>">
            <label for="nama_kur">Nama Kurikulum</label>
            <input type="text" name="nama_kur" class="form-control input-lg" id="nama_kur" placeholder="Nama Kurikulum">
          </div>
          <div class="form-group">
            <label for="mulai_berlaku">Mulai Berlaku</label>
            <input type="text" name="mulai_berlaku" class="form-control input-lg" id="mulai_berlaku" placeholder="Mulai Berlaku">
          </div>
          <div class="form-group">
            <label for="jml_sks_wajib">Jumlah SKS Wajib</label>
            <input type="text" name="jml_sks_wajib" class="form-control input-lg" id="jml_sks_wajib" placeholder="Jumlah SKS Wajib">
          </div>
          <div class="form-group">
            <label for="jml_sks_pilihan">Jumlah SKS Pilihan</label>
            <input type="text" name="jml_sks_pilihan" class="form-control input-lg" id="jml_sks_pilihan" placeholder="Jumlah SKS Pilihan">
          </div>
          <button style="width:100%" class="btn btn-lg btn-info tengah bts-ats" type="submit" name="submit" value="submit">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
