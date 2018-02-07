<div class="unirow bts-ats">
  <div class="col-md-12 unipd">
    <div class="whitebox2">
      <div class="prfbox">
        <div class="media">
          <div class="media-left media-middle">
            <div class="dashsubttl"><i class="fa fa-laptop"></i></div>
          </div>
          <div class="media-body">
            <h4 class="media-heading">Prodi di Fakultas <?php echo $getfak->nama_fakultas ?></h4>
            <div class="txtabu">Prodi yang terdaftar pada Fakultas <?php echo $getfak->nama_fakultas ?>.</div>
          </div>
          <div class="media-right media-middle">
          <button type="button" class="btn buttonlist bghijau txtputih" data-toggle="modal" data-target="#profile">
              <b>Profil Fakultas</b>
            </button>
          </div>
        </div>
        <div class="bts-ats2">
          <table border="1" width="100%">
            <thead>
              <tr>
                <!-- <th style="padding:2px 4px" rowspan="2" class="tengah"><input type="checkbox" id="select_all"></th> -->
                <th style="padding:2px 4px" rowspan="2" class="tengah">No</th>
                <th style="padding:2px 4px" rowspan="2" class="tengah">Kode</th>
                <th style="padding:2px 4px" rowspan="2" class="tengah">Nama Prodi</th>
                <th style="padding:2px 4px" rowspan="2" class="tengah">Smt Mulai</th>
                <th style="padding:2px 4px" rowspan="2" class="tengah">SKS Lulus</th>
                <th style="padding:2px 4px" rowspan="2" class="tengah">SK Selenggara</th>
                <th style="padding:2px 4px" colspan="2" class="tengah">Tanggal</th>
                <th style="padding:2px 4px" rowspan="2" class="tengah">Status</th>
                <th style="padding:2px 4px" rowspan="2" class="tengah">Action</th>
              </tr>
              <tr>
                <th style="padding:2px 4px" class="tengah">Tanggal SK</th>
                <th style="padding:2px 4px" class="tengah">Tanggal Berdiri</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; ?>
              <?php foreach ($getdtprodfak as $dfk ): ?>
               <tr>
                <td style="padding:2px 4px">
                  <div class="dashsubttl3 nobold tengah"><?php echo $no; ?></div>
                </td>
                <td style="padding:2px 4px">
                  <div class="dashsubttl3 nobold tengah"><?php echo $dfk->kode_prodi ?></div>
                </td>
                <td style="padding:2px 4px">
                  <div class="dashsubttl3" style="text-align:left"><?php echo $this->Fakultas_m->jenpend($dfk->id_jenjang_pend)->nama_jenjang_pend;?> <?php echo $dfk->nama_prodi ?></div>
                </td>
                <td style="padding:2px 4px">
                  <div class="dashsubttl3 nobold"><?php echo $dfk->smt_mulai ?></div>
                </td>
                <td style="padding:2px 4px">
                  <div class="dashsubttl3 nobold"><?php echo $dfk->sks_lulus ?></div>
                </td>
                <td style="padding:2px 4px">
                  <div class="dashsubttl3 nobold"><?php echo $dfk->sk_selenggara ?></div>
                </td>
                <td style="padding:2px 4px">
                  <div class="dashsubttl3 nobold"><?php echo $dfk->tgl_sk_selenggara ?></div>
                </td>
                <td style="padding:2px 4px">
                  <div class="dashsubttl3 nobold"><?php echo $dfk->tgl_berdiri ?></div>
                </td>
                <td style="padding:2px 4px">
                  <div class="dashsubttl3 nobold"><?php echo $dfk->stat_prodi ?></div>
                </td>
                <td style="padding:2px 4px">
                  <a href="<?php echo base_url('index.php/prodi/prodi/dataprodi/'.$dfk->id_prodi); ?>"><div class="buttonlist bgbirut txtputih"><b>Detail</b></div></a>
                </td>
              </tr>
              <?php $no++ ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="akumulasibox bgbirut txtputih">
    <div class="media">
      <div class="media-body media-middle">
        <h5 class="media-heading">Jumlah total Prodi</h5>
        Akumulasi dari Jumlah Prodi Fakultas <?php echo $getfak->nama_fakultas ?>.
      </div>
      <div class="media-right media-middle">

      </div>
    </div>
  </div>
</div>
<div class="sambungfloat"></div>
</div>
<!--  -->
<!-- modal -->
<div class="modal fade" id="profile" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Info Fakultas</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12 unipd">
          <div class="">
            <div class="prfbox bts-ats">
              <div class="media">
                <div class="media-left media-middle">
                  <div class="dashsubttl"><i class="fa fa-institution"></i></div>
                </div>
                <div class="media-body">
                  <h4 class="media-heading">Detail Fakultas <?php echo $getfak->nama_fakultas ?></h4>
                  <div class="txtabu">Informasi Lengkpang tentang Fakultas <?php echo $getfak->nama_fakultas ?>.</div>
                </div>
              </div>
              <?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-info alert-dismissible bts-ats bts-bwh" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
                </div>
              <?php endif ?>
              <form class="bts-ats2" action="<?php echo base_url('admin/Administrator_c/proses_update_fakultas'); ?>" method="post">
                <div class="input-group">
                  <span class="input-group-addon"><div class="bts-sm">KDF</div></span>
                  <input type="hidden" name="id_fakultas" value="<?php echo $getfak->id_fakultas ?>">
                  <input type="text" name="kode_fakultas" class="form-control" placeholder="Kode fakultas" value="<?php echo $getfak->kode_fakultas ?>">
                </div>
                <div class="input-group bts-ats">
                  <span class="input-group-addon"><div class="bts-sm">NMF</div></span>
                  <input type="text" name="nama_fakultas" class="form-control" placeholder="Nama fakultas" value="<?php echo $getfak->nama_fakultas ?>">
                </div>
                <div class="input-group bts-ats">
                  <span class="input-group-addon"><div class="bts-sm">JEN</div></span>
                  <select class="form-control" name="id_jenjang_pend">
                    <option value="<?php echo $getfak->id_jenjang_pend ?>">-- <?php echo $getfak->nama_jenjang_pend ?> --</option>
                    <?php foreach ($dtajp as $jen): ?>
                      <option value="<?php echo $jen->id_jenjang_pend ?>"><?php echo $jen->nama_jenjang_pend ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="input-group bts-ats">
                  <span class="input-group-addon"><div class="bts-sm">AKR</div></span>
                  <input type="text" name="akreditasi_fakultas" class="form-control" placeholder="Akreditasi fakultas" value="<?php echo $getfak->akreditasi_fakultas ?>">
                </div>
                <div class="input-group bts-ats">
                  <span class="input-group-addon"><div class="bts-sm">STS</div></span>
                  <select class="form-control" name="status_fakultas">
                    <option value="<?php echo $getfak->status_fakultas ?>">-- <?php echo $getfak->status_fakultas ?> --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                  </select>
                </div>
                <textarea class="form-control bts-ats bts-bwh" placeholder="Keterangan Fakultas" name="ket_fakultas" rows="5"><?php echo $getfak->ket_fakultas ?></textarea>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" value="submit" class="btn btn-primary"><b>Save changes</b></button>
              </form>
              <div class="sambungfloat"></div>
            </div>
          </div>
        </div>
        <div class="sambungfloat"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
