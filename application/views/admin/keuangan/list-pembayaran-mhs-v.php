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
                    <h4 class="media-heading"><?php echo ucwords(strtolower($title)); ?></h4>
                    <div class="txtabu">Data keuangan Mahasiswa berdasarkan Tahun Ajaran</div>
                </div>
            </div>
            <div class="bts-ats2">
                <table class="bts-ats" border="1" width="100%">
                 <thead>
                     <tr>
                         <th class="tengah fkpading">No</th>
                         <th class="tengah fkpading">Jenis Pembayaran</th>
                         <th class="tengah fkpading">Semester</th>
                         <th class="tengah fkpading">Biaya</th>
                         <th class="tengah fkpading">Jumlah Bayar</th>
                         <th class="tengah fkpading">Status</th>
                         <th class="tengah fkpading">Act</th>
                     </tr>
                 </thead>
                 <tbody>
                    <?php $nomor=1 ?>
                    <?php foreach ($list as $data): ?>
                     <td class="tengah fkpading"><?php echo $nomor; ?></td>
                     <td class="tengah fkpading"><?php echo $data->nama_jenis_pembayaran; ?></td>
                     <td class="tengah fkpading"><?php echo $data->k_index_ta; ?></td>
                     <td class="tengah fkpading"><?php echo $this->Keuangan_m->get_atur_bayar($data->id_atur_pembayaran)->biaya ?></td>
                     <td class="tengah fkpading"><?php echo $data->jumlah_bayar; ?></td>
                     <td class="tengah fkpading">
                        <?php if ($data->status_bayar == 3): ?>
                            <div class="btn label label-success"><b><?php echo $this->Keuangan_m->get_status($data->status_bayar)->nama_status_bayar; ?></b></div>
                        <?php else: ?>
                            <div class="btn label label-warning"><b><?php echo $this->Keuangan_m->get_status($data->status_bayar)->nama_status_bayar; ?></b></div>
                        <?php endif ?>
                    <td class="tengah fkpading">
                        <a href="<?php echo base_url('index.php/admin/keuangan/sistem/edit_pembayaran/'.$data->id_pembayaran_mhs); ?>" class="label label-danger"><i class="fa fa-pencil"></i> edit</a>
                    </td>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<div class="sambungfloat"></div>
</div>