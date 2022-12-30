<form name="f_nc" id="f_nc">
    <!-- Content -->
    <div class="wrapper css-page">
        <div class="page-title">
            <h5 class="fw-bolder"><a href="<?= site_url('nc_user');?>"><i class="fas fa-chevron-left mr-3"></i></a> Buat Laporan Baru NC</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">NC</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Tambah NC</span>
                        </div>
                        <div class="card-body">
                            <div id="smartwizard">
                                <ul class="nav">
                                    <li>
                                        <a class="nav-link" href="#step-1">
                                            <!-- <span class="material-icons-round d-block">person</span> -->
                                            <span class="subtitle fw-bolder">Temuan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-2">
                                            <!-- <span class="material-icons-round d-block">place</span> -->
                                            <span class="subtitle fw-bolder">Investigasi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-3">
                                            <!-- <span class="material-icons-round d-block">today</span> -->
                                            <span class="subtitle fw-bolder">Rencana Tidak Lanjut</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-4">
                                            <!-- <span class="material-icons-round d-block">check</span> -->
                                            <span class="subtitle fw-bolder">Status</span>
                                        </a>
                                    </li>
                                </ul>
                            
                                <div class="tab-content">
                                    <div id="step-1" class="tab-pane" role="tabpanel">

                                        <div class="container-fluid mb-2">

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h5><strong>Form Laporan Baru</strong></h5>
                                                </div>
                                            </div>
                                            <input type="hidden" name="isTemuan" value="Y">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Proyek</label>
                                                    <input type="hidden" name="project_id" value=<?= $this->session->userdata('project_id')?> >
                                                    <input name="nama_project" type="text" class="form-control" value="<?= $this->session->userdata('nama_project')?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>No. NC</label>
                                                    <input name="nomor_nc" type="text" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Lokasi</label>
                                                    <input name="lokasi" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Tanggal</label>
                                                    <input name="tanggal" type="date" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Type Pekerjaan</label>
                                                    <select name="pekerjaan" class="form-control" required>
                                                        <option value="" selected>--Pilih--</option>
                                                        <?php foreach ($pekerjaan as $r) { ?>
                                                            <option><?= $r->pekerjaan ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Uraian Temuan</label>
                                                    <textarea name="uraian_temuan" class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Photo NC</label>
                                                    <div class="dropzone dropzone-previews form-control" id="upload-temuan"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label>Sumber NC</label>
                                                    <select name="sumber_nc" class="form-control">
                                                        <option value="" selected>--Pilih--</option>
                                                          <?php foreach ($sumber_nc as $r) { ?>
                                                              <option value="<?= $r->sumber_nc?>" ><?= $r->sumber_nc ?></option>    
                                                          <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>SOM</label>
                                                    <select name="som_nc" class="form-control">
                                                        <option value="" selected>--Pilih--</option>
                                                          <?php foreach ($som as $r) { ?>
                                                              <option value="<?= $r->id?>" ><?= $r->nama_lengkap ?></option>    
                                                          <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>GSP</label>
                                                    <select name="gps_nc" class="form-control">
                                                        <option value="" selected>--Pilih--</option>
                                                          <?php foreach ($gsp as $r) { ?>
                                                              <option value="<?= $r->id?>" ><?= $r->nama_lengkap ?></option>    
                                                          <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>SP</label>
                                                    <select name="sp_nc" class="form-control">
                                                        <option value="" selected>--Pilih--</option>
                                                          <?php foreach ($sp as $r) { ?>
                                                              <option value="<?= $r->id?>" ><?= $r->nama_lengkap ?></option>    
                                                          <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Mandor</label>
                                                    <select name="mandor" class="form-control">
                                                        <option value="" selected>--Pilih--</option>
                                                          <?php foreach ($mandor as $r) { ?>
                                                              <option value="<?= $r->id?>" ><?= $r->nama_lengkap ?></option>    
                                                          <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="container-fluid mb-2">
                                            <a href="#" class="btn btn-primary" onclick="return saveDataTemuan();" role="button" type="submit">Submit</a>
                                        </div>

                                    </div>

                                    <div id="step-2" class="tab-pane" role="tabpanel">
                                        <div class="container-fluid mb-2">

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h5><strong>Form Laporan Baru</strong></h5>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Proyek</label>
                                                    <input type="text" class="form-control" value="<?= $this->session->userdata('nama_project')?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>No. NC</label>
                                                    <input type="text" class="form-control" value="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Level</label>
                                                    <select name="level_nc" class="form-control" value="">
                                                         <?php foreach ($level_nc as $r) { ?>
                                                            <option><?= $r->level_nc ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Type</label>
                                                    <select name="type_nc" class="form-control" value="">
                                                        <?php foreach ($type_nc as $r) { ?>
                                                            <option><?= $r->type_nc ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Referensi</label>
                                                    <input type="text" class="form-control" value="-">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Uraian Hasil Investigasi</label>
                                                    <textarea class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="container-fluid mb-2">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Photo NC</label>
                                                    <div class="dropzone dropzone-previews form-control" id="upload-investigasi"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label>Bahan</label>
                                                    <select name="bahan" class="form-control" value="">
                                                        <?php foreach ($bahan as $r) { ?>
                                                            <option><?= $r->bahan ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Orang</label>
                                                    <select name="orang" class="form-control" value="">
                                                        <?php foreach ($orang as $r) { ?>
                                                            <option><?= $r->orang ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Cara</label>
                                                    <select name="cara" class="form-control" value="">
                                                        <option>-</option>
                                                        <option>Eksternal</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Alat</label>
                                                    <select name="alat" class="form-control" value="">
                                                        <option>Mencukupi</option>
                                                        <option>-</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Lingkungan</label>
                                                    <select name="lingkungan" class="form-control" value="">
                                                        <option>Mendukung</option>
                                                        <option>-</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="step-3" class="tab-pane" role="tabpanel">
                                        <div class="container-fluid mb-2">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h5><strong>Form Laporan Baru</strong></h5>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Proyek</label>
                                                    <input type="text" class="form-control" value="<?= $this->session->userdata('nama_project')?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>No. NC</label>
                                                    <input type="text" class="form-control" value="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Diposisi</label>
                                                    <select name="diposisi" class="form-control">
                                                        <option value="" selected>--Pilih--</option>
                                                        <?php foreach ($disposisi as $r) { ?>
                                                            <option><?= $r->disposisi ?></option>    
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Tanggal Rencana Realisasi</label>
                                                    <input type="date" class="form-control" value="Sirkuit Mandalika">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Uraian Tidak Lanjut</label>
                                                    <textarea class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="step-4" class="tab-pane" role="tabpanel" style="overflow: auto;">
                                        <div class="container-fluid mb-2">

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h5><strong>Form Laporan Baru</strong></h5>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Proyek</label>
                                                    <input type="text" class="form-control" value="<?= $this->session->userdata('nama_project')?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>No. NC</label>
                                                    <input name="nomor_nc_closing" type="text" class="form-control" value="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control" value="">
                                                        <option>Open</option>
                                                        <option>Closed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Tanggal Realisasi Clossing</label>
                                                    <input name="tanggal_closing" type="date" class="form-control" value="Sirkuit Mandalika">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Realisasi Biaya</label>
                                                    <input name="realisasi_biaya" type="number" class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Photo NC</label>
                                                    <div class="dropzone dropzone-previews form-control" id="upload-realisasi"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">
                                            <a href="#" class="btn btn-primary" onclick="return saveData();" role="button" type="submit">Submit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- End Content -->
    </div>
</form>

