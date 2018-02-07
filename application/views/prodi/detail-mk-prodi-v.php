<script>
  $(function () {
    $('#sember').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<div class="unirow bts-ats">
  <div class="col-md-8 unipd">
    <div class="whitebox2">
      <div class="prfbox">
        <div class="bts-ats">
          <div class="media">
            <div class="media-left media-middle">
              <div class="dashsubttl"><i class="fa fa-graduation-cap"></i></div>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Daftar Mahasiswa</h4>
              <div class="txtabu">Daftar lengkap Mahasiswa Universitas Dayanu Ikhsanuddin Baubau</div>
            </div>
            <div class="media-right media-middle">
             <button class="btn buttonlist bghijau txtputih" data-toggle="modal" data-target="#addexcel"><i class="fa fa-plus-circle"></i> <b>Upload Data Exel</b></button>
            </div>
            <div class="media-right media-middle">
              <button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target="#addmhs"><i class="fa fa-plus-circle"></i> <b>Tambah Mahasiswa</b></button>
            </div>
          </div>
        </div>
        <div class="bts-ats2">
          <div class="table-responsive">
            <table id="sember" class="table table-hover">
              <thead>
                <tr>
                  <td></td><td></td> <td></td><td></td><td></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dtamhs as $mhs): ?>
                  <tr>
                    <td>
                      <div class="editfpbox mdling">
                        <img class="media-object" src="<?php echo base_url('asset/img/userimage'); ?>/<?php echo $mhs->foto_profil_mhs ?>" alt="<?php echo $mhs->foto_profil_mhs ?>">
                      </div>
                    </td>
                    <td>
                      <div class="dashsubttl3"><?php echo $mhs->npm ?>
                        <?php if ($mhs->status_mhs == 'Nonaktif'): ?>
                          <span class="unispan bgmerah"><?php echo $mhs->status_mhs ?></span>
                          <?php else: ?>
                            <span class="unispan bghijau"><?php echo $mhs->status_mhs ?></span>
                        <?php endif; ?>
                      </div>
                    </td>
                    <td>
                      <h5 class="media-heading nobold"><?php echo $mhs->nama_mhs; ?></h5>
                      <div class="txtabu nobold u11">
                        Mahasisa fakultas <?php echo $mhs->nama_fakultas ?> program studi <?php echo $mhs->nama_prodi ?>
                        semester <?php echo $mhs->semester_mhs ?> Universitas Dayanu Ikhsanuddin Baubau
                      </div>
                    </td>
                    <td>
                      <div class="dashsubttl3 nobold"><?php echo $mhs->nama_jenjang_pend ?></div>
                    </td>
                    <td>
                      <a href="<?php echo base_url('adm-detail-mahasiswa/'.$mhs->id_mhs); ?>"><div class="buttonlist bgbirut txtputih"><b>Detail</b></div></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 unipd"></div>
</div>
<!-- modal add excel -->
<div class="modal fade addpangkat" id="addexcel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="prfbox">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Upload Data Excel</h4>
        <form action="<?php echo base_url('admin/importund_c/proses_import_mhs_prod'); ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_prodi" value="<?php echo $dtamhsprod->id_prodi; ?>">
          <input type="hidden" name="kode_prodi" value="<?php echo $dtamhsprod->kode_prodi; ?>">
          <input type="hidden" name="id_jenjang_pend" value="<?php echo $dtamhsprod->id_jenjang_pend; ?>">
          <input type="hidden" name="id_fakultas" value="<?php echo $dtamhsprod->id_fakultas; ?>">
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
<!-- modal Add Mahasiswa -->
<div class="modal fade" id="addmhs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambahkan Mahasiswa Baru</h4>
      </div>
      <form class="" action="<?php echo base_url('admin/Administrator_c/proses_add_mahasiswa'); ?>" method="post">
        <div class="modal-body">
          <div class="input-group input-group-lg bts-ats">
            <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">NPM</div></span>
            <input type="hidden" name="foto_profil_mhs" value="avatar.png">
            <input type="text" name="npm" class="form-control" placeholder="Nomor Pokok Mahasiswa">
          </div>
          <div class="input-group input-group-lg bts-ats">
            <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">NMA</div></span>
            <input type="text" name="nama_mhs" class="form-control" placeholder="Nama Mahasiswa">
          </div>
          <div class="unirow">
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">USR</div></span>
                <input type="text" name="username" class="form-control" placeholder="Username">
              </div>
            </div>
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">PSS</div></span>
                <input type="password" name="pass" class="form-control" placeholder="Password">
              </div>
            </div>
            <div class="sambungfloat"></div>
          </div>
          <div class="unirow">
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">JPD</div></span>
                <input type="hidden" name="id_jenjang_pend" value="<?php echo $dtamhsprod->id_jenjang_pend; ?>">
                <div class="form-control"><?php echo $dtamhsprod->nama_jenjang_pend; ?></div>
              </div>
            </div>
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">FKS</div></span>
                <input type="hidden" name="id_fakultas" value="<?php echo $dtamhsprod->id_fakultas; ?>">
                <div class="form-control"><?php echo $dtamhsprod->nama_fakultas; ?></div>
              </div>
            </div>
            <div class="sambungfloat"></div>
          </div>
          <div class="unirow">
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">PRD</div></span>
                <input type="hidden" name="id_prodi" value="<?php echo $dtamhsprod->id_prodi; ?>">
                <div class="form-control"><?php echo $dtamhsprod->nama_prodi; ?></div>
              </div>
            </div>
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">STR</div></span>
                <select class="form-control" name="semester_mhs">
                  <option value="1">-- Semester --</option>
                  <?php foreach ($dtsmstr as $djp): ?>
                    <option value="<?php echo $djp->kode_semester ?>"><?php echo $djp->nama_semester ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="sambungfloat"></div>
          </div>
          <div class="unirow">
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">THA</div></span>
                <select class="form-control" name="id_tahun_ajaran">
                  <option value="Aktif">-- Tahun Ajaran --</option>
                  <?php foreach ($dtta as $ta): ?>
                    <option value="<?php echo $ta->id_tahun_ajaran ?>"><?php echo $ta->nama_tahun_ajaran ?> - <?php echo $ta->kode_tahun_ajaran ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">STS</div></span>
                <select class="form-control" name="status_mhs">
                  <option value="Aktif">-- Status --</option>
                  <option value="Aktif">Aktif</option>
                  <option value="Nonaktif">Nonaktif</option>
                </select>
              </div>
            </div>
            <div class="sambungfloat"></div>
          </div>
          <div class="input-group input-group-lg bts-ats">
            <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">AKT</div></span>
            <input type="text" name="angkatan" class="form-control" placeholder="Angkatan">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="submit" value="submit" class="btn btn-lg btn-info">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
