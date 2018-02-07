<div class="unirow" id="mainpage">
  <?php $this->load->view('nav/nav-dosen-detail') ?>
  <div class="col-md-10 unipd">
    <div class="whitebox2 fk-min bts-ats fk-min">
      <div class="prfbox">
        <div class="media">
          <div class="media-left media-middle">
            <div class="dashsubttl"><i class="fa fa-book"></i></div>
          </div>
          <div class="media-body">
            <h4 class="media-heading"><?php echo $title; ?></h4>
            <div class="txtabu"><?php echo $title; ?> dari Web Service Feeder</div>
          </div>
        </div>
        <div class="hasil"></div>
        <div class="bts-ats2"><label class="label label-success"><?php echo $contoh; ?></label> Jumlah data Dosen Feeder</div>
        <table border="1" class="bts-ats" width="100%">
          <thead>
            <tr>
              <th rowspan="2" class="tengah fkpading">NO</th>
              <th rowspan="2" class="tengah fkpading">KODE</th>
              <th rowspan="2" class="tengah fkpading">MATAKULIAH</th>
               <th rowspan="2" class="tengah fkpading">SMT</th>
              <th rowspan="2" class="tengah fkpading">SKS</th>
              <th rowspan="2" class="tengah fkpading">PRODI</th>
              <th rowspan="2" class="tengah fkpading">KELAS</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=$nomor+1 ?>
            <?php foreach ($hasil as $data): ?>
              <tr>
                <td class="tengah fkpading"><?php echo $no;?></td>
                <td class="tengah fkpading"><?php echo $data->kode_mk;?></td>
                <td class="fkpading"><?php echo ucwords(strtolower($data->nm_mk));?></td>
                <td class="tengah fkpading"><?php echo $this->Dosen_m->get_smt_kls($data->id_kls)->semester;?></td>
                <td class="tengah fkpading"><?php echo $data->sks_mk;?></td>
                <td class="fkpading"><?php echo $this->Dosen_m->get_prodi($data->id_prodi)->nama_prodi;?></td>
                <td class="tengah fkpading"><?php echo $data->nm_kls;?></td>
              </tr>
              <?php $no++ ?>
            <?php endforeach ?>
          </tbody>
        </table>
        <?php echo $pagging; ?>
      </div> 
    </div>
  </div>
  <div class="sambungfloat"></div>
</div>