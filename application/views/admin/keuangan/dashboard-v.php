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
                        <h4 class="media-heading">Tahun Ajaran</h4>
                        <div class="txtabu">Data keuangan Mahasiswa berdasarkan Tahun Ajaran</div>
                    </div>
                </div>
                <div class="bts-ats2">
                    <table border="1" width="100%">
                            <thead>
                                <tr>
                                    <th class="tengah fkpading">No</th>
                                    <th class="tengah fkpading">ID</th>
                                    <th class="tengah fkpading">T.A</th>
                                    <th class="tengah fkpading">Kode</th>
                                    <th class="tengah fkpading">K.Index</th>
                                    <th class="tengah fkpading">Keterangan</th>
                                    <th class="tengah fkpading">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1 ?>
                                <?php foreach ($allta as $dfk): ?>
                                    <tr>
                                        <td class="tengah fkpading"><?php echo $no ?>.</td>
                                        <td class="tengah fkpading">
                                            ID:<?php echo $dfk->id_tahun_ajaran;?>
                                        </td>
                                        <td class="tengah fkpading">
                                            <?php echo $dfk->nama_tahun_ajaran ?>
                                        </td>
                                        <td class="tengah fkpading">
                                            <?php echo $dfk->kode_tahun_ajaran; ?>
                                        </td>
                                        <td class="tengah fkpading">
                                            <?php echo $dfk->k_index_ta ?>
                                        </td>
                                        <td class="fkpading">
                                            <?php echo $dfk->ket_tahun_ajaran ?>
                                        </td>
                                        <td class="tengah fkpading">
                                            <a href="<?php echo base_url('index.php/admin/keuangan/sistem/prodi_by_ta/'.$dfk->id_tahun_ajaran); ?>"><div class="btn label label-success"><b>Lihat</b></div></a>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

  <div class="sambungfloat"></div>
</div>