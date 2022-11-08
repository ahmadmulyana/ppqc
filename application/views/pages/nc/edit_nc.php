<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<link href="<?= base_url('assets/');?>vendors/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox-plus-jquery.min.js"></script>
    <style type="text/css">
        .dz-message{
          text-align: center;
          font-size: 28px;
        }
        .dz-preview .dz-image img{
          width: 100% !important;
          height: 100% !important;
          object-fit: cover;
        }
    </style>

    <?php
        if ($data == ""){
            $data= $this->db->get_where('tr_nc', array('id'=> $this->session->userdata('nc_id')))->row();
        }
    ?>
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
                            <span class="subtitle fw-bolder">Edit NC</span>
                        </div>
                        <div class="card-body">
                            <div id="smartwizard">
                                <ul class="nav">
                                    <li>
                                        <a class="nav-link" href="#step-1">
                                            <span class="subtitle fw-bolder">Temuan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-2">
                                            <span class="subtitle fw-bolder">Investigasi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-3">
                                            <span class="subtitle fw-bolder">Rencana Tidak Lanjut</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-4">
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
                                            <input type="hidden" name="isTemuan" value="Edit">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Proyek</label>
                                                    <input type="hidden" name="project_id" value=<?= $this->session->userdata('project_id')?> >
                                                    <input name="nama_project" type="text" class="form-control" value="<?= $this->session->userdata('nama_project')?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>No. NC</label>
                                                    <input name="nomor_nc" type="text" class="form-control" value="<?= $data->nomor_nc; ?>" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Lokasi</label>
                                                    <input name="lokasi" type="text" class="form-control" value="<?= $data->lokasi; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Tanggal</label>
                                                    <input name="tanggal" type="date" class="form-control" value="<?= $data->tanggal; ?>" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Pekerjaan</label>
                                                    <select name="pekerjaan" class="form-control" readonly>
                                                        <?php foreach ($pekerjaan as $r) { ?>
                                                            <option value="<?= $r->pekerjaan ?>" <?php if($data->pekerjaan==$r->pekerjaan) echo 'selected="selected"'; ?> ><?= $r->pekerjaan ?></option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Uraian Temuan</label>
                                                    <textarea name="uraian_temuan" class="form-control" rows="4" readonly><?= $data->uraian_temuan; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!--
                                        <div class="container-fluid mb-2">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Photo NC TEMUAN</label>
                                                    <div disabled class="dropzone dropzone-previews form-control" id="upload_temuan_edit"></div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <div class="card-body overflow-auto p-4">
                                            <div class="row mb-2" >
                                            <?php
                                            foreach ($photo_temuan as $key => $p) { ?>
                                                
                                                <div class="setimg" style="width: 160px;">
                                                <a href="<?= base_url('uploads/'.$p->file); ?>" data-lightbox="homePortfolio" title="">
                                                    <img style="border-radius: 10px;border: 1px solid #0066cc;" src="<?= base_url('uploads/'.$p->file); ?>"/>
                                                </a>
                                                <div class="setimgisi" style="margin-right: 10px;">
                                                    <a href="<?= base_url('uploads/'.$p->file); ?>" role="button" class="text text-success" download=""><span class="material-icons-round">download</span></a>
                                                </div>
                                                </div>
                                            
                                            <?php } ?>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label>Sumber NC</label>
                                                    <select name="sumber_nc" class="form-control" readonly>
                                                        <option value="Internal" <?php if($data->sumber_nc=="Internal") echo 'selected="selected"'; ?> >Internal</option>
                                                        <option value="Eksternal" <?php if($data->sumber_nc=="Eksternal") echo 'selected="selected"'; ?> >Eksternal</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>SOM</label>
                                                    <select name="som_nc" class="form-control" readonly>
                                                        <option value="Internal" <?php if($data->som_nc=="Internal") echo 'selected="selected"'; ?> >Internal</option>
                                                        <option value="Eksternal" <?php if($data->som_nc=="Eksternal") echo 'selected="selected"'; ?> >Eksternal</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>GSP</label>
                                                    <select name="gps_nc" class="form-control" readonly>
                                                        <option value="Internal" <?php if($data->gps_nc=="Internal") echo 'selected="selected"'; ?> >Internal</option>
                                                        <option value="Eksternal" <?php if($data->gps_nc=="Eksternal") echo 'selected="selected"'; ?> >Eksternal</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>SP</label>
                                                    <select name="sp_nc" class="form-control" readonly>
                                                        <option value="Internal" <?php if($data->sp_nc=="Internal") echo 'selected="selected"'; ?> >Internal</option>
                                                        <option value="Eksternal" <?php if($data->sp_nc=="Eksternal") echo 'selected="selected"'; ?> >Eksternal</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>SubKon/Mandor</label>
                                                    <input name="mandor" type="text" class="form-control" value="<?= $data->mandor; ?>" readonly>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <!-- Inputan Investigasi -->

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
                                                    <input type="text" class="form-control" value="<?= $this->session->userdata('nama_project')?>" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>No. NC</label>
                                                    <input type="text" class="form-control" value="<?= $data->nomor_nc; ?>" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Level</label>
                                                    <select name="level_nc" class="form-control">
                                                        <option value="">-</option>
                                                         <?php foreach ($level_nc as $r) { ?>
                                                            <option value="<?= $r->level_nc ?>" <?php if($data->level_nc==$r->level_nc) echo 'selected="selected"'; ?> ><?= $r->level_nc ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Type</label>
                                                    <select name="type_nc" class="form-control" >
                                                        <option value="">-</option>
                                                        <?php foreach ($type_nc as $r) { ?>
                                                            <option value="<?= $r->type_nc ?>" <?php if($data->type_nc==$r->type_nc) echo 'selected="selected"'; ?> ><?= $r->type_nc ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Referensi</label>
                                                    <input name="referensi" type="text" class="form-control" value="<?= $data->referensi; ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Uraian Hasil Investigasi</label>
                                                    <textarea name="uraian_investigasi" class="form-control" rows="4"><?= $data->uraian_investigasi; ?></textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="container-fluid mb-2">
                                            <div class="row">
                                                <div class="form-group col-md-12" id="abc">
                                                    <label>Photo NC Investigasi</label>
                                                    <div class="dropzone form-control" id="upload_investigasi_edit"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label>Bahan</label>
                                                    <select name="bahan" class="form-control">
                                                        <option value="-">-</option>
                                                        <?php foreach ($bahan as $r) { ?>
                                                            <option value="<?= $r->bahan?>" <?php if($r->bahan == $data->bahan) echo 'selected="selected"'; ?> ><?= $r->bahan ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Orang</label>
                                                    <select name="orang" class="form-control">
                                                        <option value="-">-</option>
                                                        <?php foreach ($orang as $r) { ?>
                                                            <option value="<?= $r->orang?>" <?php if($r->orang == $data->orang) echo 'selected="selected"'; ?> ><?= $r->orang ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Cara</label>
                                                    <select name="cara" class="form-control">
                                                        <option value="-">-</option>
                                                        <?php foreach ($cara as $r) { ?>
                                                            <option value="<?= $r->cara?>"  <?php if($r->cara == $data->cara) echo 'selected="selected"'; ?>  ><?= $r->cara ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Alat</label>
                                                    <select name="alat" class="form-control">
                                                        <option value="-">-</option>
                                                        <?php foreach ($alat as $r) { ?>
                                                            <option value="<?= $r->alat?>" <?php if($r->alat == $data->alat) echo 'selected="selected"'; ?> ><?= $r->alat ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Lingkungan</label>
                                                    <select name="lingkungan" class="form-control">
                                                        <option value="-">-</option>
                                                        <?php foreach ($lingkungan as $r) { ?>
                                                            <option value="<?= $r->lingkungan?>" <?php if($r->lingkungan == $data->lingkungan) echo 'selected="selected"'; ?> ><?= $r->lingkungan ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">
                                            <a href="#" class="btn btn-primary" onclick="return saveDataInvestigasi();" role="button" type="submit">Submit</a>
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
                                                    <input type="text" class="form-control" value="<?= $this->session->userdata('nama_project')?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>No. NC</label>
                                                    <input type="text" class="form-control" value="<?= $data->nomor_nc?>" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Diposisi</label>
                                                    <select name="disposisi_pm" class="form-control">
                                                        <option value="">--Pilih--</option>
                                                        <?php foreach ($disposisi as $r) { ?>
                                                            <option value="<?= $r->disposisi; ?>"><?= $r->disposisi ?></option>    
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Tanggal Rencana Realisasi</label>
                                                    <input type="date" class="form-control" name="tanggal_rencana" value="<?= $data->tanggal_rencana; ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Uraian Tidak Lanjut</label>
                                                    <textarea name="uraian_tindak_lanjut" class="form-control" rows="4"><?= $data->uraian_tindak_lanjut; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">
                                            <a href="#" class="btn btn-primary" onclick="return saveDataTindakLanjut();" role="button" type="submit">Submit</a>
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
                                                    <input type="text" class="form-control" value="<?= $this->session->userdata('nama_project')?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>No. NC</label>
                                                    <input name="nomor_nc_closing" type="text" class="form-control" value="<?= $data->nomor_nc?>" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Status</label>
                                                    <select name="status_nc" class="form-control">
                                                        <option value="Open" <?php if($data->status_nc=="Open") echo 'selected="selected"'; ?> >Open</option>
                                                        <option value="Closed" <?php if($data->status_nc=="Closed") echo 'selected="selected"'; ?> >Closed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Tanggal Realisasi Clossing</label>
                                                    <input name="tanggal_closing" type="date" class="form-control" value="<?= $data->tanggal_closing; ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Realisasi Biaya</label>
                                                    <input name="realisasi_biaya" type="number" class="form-control" value="<?= $data->realisasi_biaya; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Photo NC</label>
                                                    <div class="dropzone dropzone-previews form-control" id="upload_closing"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container-fluid mb-2">
                                            <a href="#" class="btn btn-primary" onclick="return saveDataClosing();" role="button" type="submit">Submit</a>
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