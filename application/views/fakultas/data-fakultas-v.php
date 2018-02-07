<div class="unirow bts-ats">
  <div class="col-md-8 unipd">
    <div class="whitebox2">
      <div class="prfbox">
        <div class="bts-ats bts-bwh3">
          <div class="media">
            <div class="media-left media-middle">
              <div class="dashsubttl"><i class="fa fa-institution"></i></div>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Daftar Fakultas</h4>
              <div class="txtabu">Informasi Fakultas yang terdaftar dalam UNIDAYAN</div>
            </div>
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
          <?php foreach ($dtafk as $dfk ): ?>
            <tr>
              <td>
                <div class="dashsubttl3 u15">
                  ID:<?php echo $dfk->id_fakultas; ?>
                  <span class="unispan bghijau"><?php echo $dfk->kode_fakultas ?></span>
                </div>
              </td>
              <td>
                <h5 class="media-heading nobold">Fakultas <?php echo $dfk->nama_fakultas; ?>
                	<span class="unispan bghijau"><?php echo $dfk->status_fakultas ?></span>
                </h5>
                <div class="txtabu u11 nobold"><?php echo $dfk->ket_fakultas; ?></div>
              </td>
              <td>
                <div class="dashsubttl3 u20"><b><?php echo $dfk->akreditasi_fakultas; ?></b></div>
              </td>
              <td>
                <a href="<?php echo base_url('index.php/fakultas/fakultas/detailfk/'.$dfk->id_fakultas); ?>"><div class="buttonlist bgbirut txtputih"><b>Detail</b></div></a>
              </td>
            </tr>
            <?php endforeach; ?>
        </table>
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
                <h4 class="media-heading">Buat Fakultas Baru</h4>
                <div class="txtabu">Membuat Prodi Baru dengan Mengisi form di bawah ini</div>
              </div>
            </div>
          </div>
          <form class="bts-ats2" action="<?php echo base_url('admin/Administrator_c/proses_add_fakultas'); ?>" method="post">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><b>KF</b></span>
              <input type="text" name="kode_fakultas" class="form-control" placeholder="Kode Fakultas">
            </div>
            <div class="input-group bts-ats">
              <span class="input-group-addon" id="basic-addon1"><b>NF</b></span>
              <input type="text" name="nama_fakultas" class="form-control" placeholder="Nama Fakultas">
            </div>
            <div class="input-group bts-ats">
              <span class="input-group-addon" id="basic-addon1"><b>JP</b></span>
              <select class="form-control" name="id_jenjang_pend">
                <option value="1">-- Jenjang Pendidikan --</option>
                <?php foreach ($dtajp as $djp): ?>
                  <option value="<?php echo $djp->id_jenj_didik ?>"><?php echo $djp->nm_jenj_didik ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="input-group bts-ats">
              <span class="input-group-addon" id="basic-addon1"><b>SF</b></span>
              <input type="text" name="status_fakultas" class="form-control" placeholder="Status Fakultas">
            </div>
            <div class="input-group bts-ats">
              <span class="input-group-addon" id="basic-addon1"><b>AF</b></span>
              <input type="text" name="akreditasi_fakultas" class="form-control" placeholder="Akreditasi Fakultas">
            </div>
            <button type="submit" name="submit" value="submit" class="btn btn-default bts-bwh submbtn"><b>BUAT FAKULTAS</b></button>
          </form>
        </div>
      </div>
    </div>
  </div>
