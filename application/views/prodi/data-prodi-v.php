<div class="unirow bts-ats">
  <div class="col-md-8 unipd">
    <div class="whitebox2">
      <div class="prfbox">
        <div class="bts-ats">
          <div class="media">
            <div class="media-left media-middle">
              <div class="dashsubttl"><i class="fa fa-institution"></i></div>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Daftar Program Studi</h4>
              <div class="txtabu">Informasi Program Studi yang terdaftar dalam Universtas Dayanu Ikhsanuddin Baubau</div>
            </div>
          </div>
          <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-info alert-dismissible bts-ats bts-bwh" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
            </div>
          <?php endif ?>
          <!-- data fakultas -->
          <table class="table bts-ats2">
            <?php foreach ($dtaprod as $dfk ): ?>
              <tr>
                <td>
                  <div class="dashsubttl3 u15">ID:<?php echo $dfk->id_prodi; ?>
                     <span class="unispan bghijau"><?php echo $dfk->kode_prodi ?></span>
                  </div>
                </td>
                <td>
                  <h5 class="media-heading nobold">Program Studi <?php echo $dfk->nama_prodi; ?>
                     <?php if ($dfk->status_prodi == 'Aktif'): ?>
                      <span class="unispan bghijau"><?php echo $dfk->status_prodi ?></span>
                        <?php else: ?>
                          <span class="unispan bgpink"><?php echo $dfk->status_prodi ?></span>
                    <?php endif; ?>
                  </h5>
                  <div class="txtabu u11 nobold"><?php echo $dfk->ket_prodi; ?></div>
                </td>
                <td>
                  <div class="dashsubttl3 u20"><b><?php echo $dfk->akreditasi_prodi; ?></b></div>
                </td>
                <td>
                  <a href="<?php echo base_url('adm-detail-prodi/'.$dfk->id_prodi); ?>"><div class="buttonlist bgbirut txtputih"><b>Detail</b></div></a>
                </td>
              </tr>
              <?php endforeach; ?>
          </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 unipd">
      <div class="whitebox2">
        <div class="prfbox">
          <div class="bts-ats">
            <div class="media">
              <div class="media-left media-middle">
                <div class="dashsubttl"><i class="fa fa-plus-circle"></i></div>
              </div>
              <div class="media-body">
                <h4 class="media-heading">Buat Prodi Baru</h4>
                <div class="txtabu">Membuat Prodi Baru dengan Mengisi form di bawah ini</div>
              </div>
            </div>
          </div>
          <form class="bts-ats2" action="<?php echo base_url('admin/Administrator_c/proses_add_prodi'); ?>" method="post">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><b>KP</b></span>
              <input type="text" name="kode_prodi" class="form-control" placeholder="Kode Prodi">
            </div>
            <div class="input-group bts-ats">
              <span class="input-group-addon" id="basic-addon1"><b>NP</b></span>
              <input type="text" name="nama_prodi" class="form-control" placeholder="Nama Prodi">
            </div>
            <div class="input-group bts-ats">
              <span class="input-group-addon" id="basic-addon1"><b>JP</b></span>
              <select class="form-control" name="id_jenjang_pend">
                <option value="1">-- Jenjang Pendidikan --</option>
                <?php foreach ($dtajp as $djp): ?>
                  <option value="<?php echo $djp->id_jenjang_pend ?>"><?php echo $djp->nama_jenjang_pend ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="input-group bts-ats">
              <span class="input-group-addon" id="basic-addon1"><b>FK</b></span>
              <select class="form-control" name="id_fakultas">
                <option value="1">-- Nama Fakultas --</option>
                <?php foreach ($dtafk as $dfk): ?>
                  <option value="<?php echo $dfk->id_fakultas ?>"><?php echo $dfk->nama_fakultas ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="unirow">
              <div class="col-md-6 unipd">
                <div class="input-group bts-ats">
                  <span class="input-group-addon" id="basic-addon1"><b>SP</b></span>
                  <input type="text" name="status_prodi" class="form-control" placeholder="Status Prodi">
                </div>
              </div>
              <div class="col-md-6 unipd">
                <div class="input-group bts-ats">
                  <span class="input-group-addon" id="basic-addon1"><b>AP</b></span>
                  <input type="text" name="akreditasi_prodi" class="form-control" placeholder="Akreditasi Prodi">
                </div>
              </div>
            </div>
            <button type="submit" name="submit" value="submit" class="btn btn-default bts-bwh submbtn"><b>BUAT PRODI</b></button>
          </form>
        </div>
      </div>
      <div class="whitebox2">
        <div class="prfbox">
          <div class="bts-ats">
            <div class="media">
              <div class="media-left media-middle">
                <div class="dashsubttl"><i class="fa fa-trophy"></i></div>
              </div>
              <div class="media-body">
                <h4 class="media-heading">Akumulasi Mahasiswa</h4>
                <div class="txtabu">Total jumlah mahasiswa berdasarkan fakultas masing-masing</div>
              </div>
            </div>
          </div>
          <div class="table-responsive garis bts-ats2">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Program Studi</th>
                  <th class="tengah">Jml Mhs</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dtaprod as $dfk): ?>
                  <tr>
                    <td><?php echo $dfk->nama_prodi ?></td>
                    <td class="tengah"><?php echo $this->Administrator_m->count_mhs_prod($dfk->id_prodi) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="akumulasibox bgbirut txtputih">
        <div class="media">
          <div class="media-body media-middle">
            <h5 class="media-heading">Jumlah total Mahasiswa</h5>
            Akumulasi dari Jumlah SKS Matakuliah yang di ambil
          </div>
          <div class="media-right media-middle">
            <div class="dashsubttl3"><b><?php echo $this->Administrator_m->count_mhs_prod(0) ?> Mhs</b></div>
          </div>
        </div>
      </div>
    </div>
  </div>
