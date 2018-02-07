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
                    <?php if (empty($list)): ?>
                        <div class="media-right">
                            <a class="btn btn-success" href="<?php echo base_url('index.php/admin/keuangan/sistem/tambahmhs/'.$thn.'/'.$kodeprod.'/'.$idbyr); ?>"><i class="fa fa-plus"></i> Tambah Seluruh Mahasisa</a>
                        </div>
                    <?php endif ?>
                </div>
                <div class="bts-ats2">
                 <div style="margin-bottom: 14px;">
                    <a class="btn btn-default" href="<?php echo base_url('index.php/admin/keuangan/sistem/jenisbayar/'.$thn.'/'.$kodeprod.'/'.$idbyr); ?>">Semua</a>
                    <?php foreach ($liststatusbyr as $data): ?>
                        <a class="btn btn-primary" href="<?php echo base_url('index.php/admin/keuangan/sistem/jenisbayarbysts/'.$thn.'/'.$kodeprod.'/'.$idbyr.'/'.$data->id_status_bayar); ?>"><?php echo $data->nama_status_bayar; ?></a>
                    <?php endforeach ?>
                </div>
                    <label class="label label-success"><?php echo $contoh;?></label> Jumlah mahasiswa keseluruhan.
                    <form class="bts-ats" action="<?php echo base_url('index.php/admin/keuangan/sistem/jenisbayar/'.$thn.'/'.$kodeprod.'/'.$idbyr); ?>" method="get">
                        <div class="unirow">
                            <div class="col-md-5 unipd">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="basic-addon1">NPM / Nama :</span>
                                    <input type="text" class="form-control" name="string" placeholder="Masukan NPM atau Nama">
                                </div>
                            </div>
                            <div class="col-md-5 unipd">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="basic-addon1">Angkatan :</span>
                                    <select class="form-control" name="angkatan">
                                    <option value="">Semua Angkatan</option>
                                        <?php foreach ($angkatan as $data): ?>
                                            <option value="<?php echo $data->kode_angkatan; ?>"><?php echo $data->kode_angkatan; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 unipd">
                                <button type="submit" class="btn btn-sm btn-success" style="width:100%"><i class="fa fa-search"></i> Cari ...</button>
                            </div>
                            <div class="sambungfloat"></div>
                        </div>
                    </form>
                    <table class="bts-ats" border="1" width="100%">
                        <thead>
                            <tr>
                                <th class="tengah fkpading">No</th>
                                <th class="tengah fkpading">NPM</th>
                                <th class="tengah fkpading">NAMA</th>
                                <th class="tengah fkpading">PRDI</th>
                                <th class="tengah fkpading">ANGKT</th>
                                <th class="tengah fkpading">BIAYA</th>
                                <th class="tengah fkpading">JML BAYAR</th>
                                <th class="tengah fkpading">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            <?php foreach ($list as $dfk): ?>
                                <tr>
                                    <td class="tengah fkpading"><?php echo $no ?>.</td>
                                    <td class="tengah fkpading">
                                        <?php echo $dfk->npm;?>
                                    </td>
                                    <td class="fkpading">
                                        <a href="<?php echo base_url('index.php/admin/keuangan/sistem/detail_pembayaran/'.$dfk->id_mhs); ?>"><?php echo ucwords(strtolower($dfk->nama_mhs));?></a>
                                    </td>
                                    <td class="tengah fkpading">
                                        <?php echo $this->Keuangan_m->detailprodi($kodeprod)->nama_prodi; ?>
                                    </td>
                                    <td class="tengah fkpading">
                                        <?php echo $dfk->angkatan ?>
                                    </td>
                                    <td class="tengah fkpading">
                                        <?php echo $this->Keuangan_m->get_atur_bayar($dfk->id_atur_pembayaran)->biaya ?>
                                    </td>
                                    <td class="tengah fkpading">
                                        <?php echo $dfk->jumlah_bayar ?>
                                    </td>
                                    <td class="tengah fkpading">
                                        <?php if ($dfk->status_bayar == 3): ?>
                                            <div class="btn label label-success"><b><?php echo $this->Keuangan_m->get_status($dfk->status_bayar)->nama_status_bayar; ?></b></div>
                                        <?php else: ?>
                                            <div class="btn label label-warning"><b><?php echo $this->Keuangan_m->get_status($dfk->status_bayar)->nama_status_bayar; ?></b></div>
                                        <?php endif ?>
                                    </td>
                                </tr>
                                <?php $no++ ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <?php echo $pagging; ?>
                </div>
            </div>
        </div>
    </div>
  <div class="sambungfloat"></div>
</div>