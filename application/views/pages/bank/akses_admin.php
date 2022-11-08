<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<link href="<?= base_url('assets/');?>vendors/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/');?>vendors/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox-plus-jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?= base_url('assets/');?>vendors/dropify/dist/js/dropify.min.js"></script>
<script src="<?= base_url('assets/');?>vendors/dropzone/dist/dropzone.js"></script>

    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">Good Product</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Good Product</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body overflow-auto p-4">
                            <div class="row mb-3">

                                <input type="hidden" id="<?=$this->security->get_csrf_token_name();?>" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

                                <?=form_open('bank_data/uploadFile', array('method'=>'post', 'class' => 'dropzone form-group')) ;?>
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                    <input name="type" type="hidden" value="4" />
                                    <input id="project_id" name="project_id" type="hidden" />
                                    <input type="hidden" name="pekerjaan" id="pekerjaan_id">
                                    <input type="hidden" name="kriteria_penilaian" id="kriteria_penilaian">
                                
                            </div>
                            
                            <div class="row mb-3">
                                <div class="form-group col-md-12 mb-3">
                                    
                                    <?php
                                    if ($this->session->userdata('admin_level') == "3"){ ?>
                                        <label>Pilih Project : </label>
                                            <select class="form-control" id="project_bank" name="project">
                                                <option value="" disabled selected>-- Pilih -- </option>
                                                <?php foreach ($project as $r) { ?>
                                                <option value="<?= $r->id; ?>"><?= $r->nama_proyek ?></option>    
                                                <?php } ?>
                                            </select>
                                        <?php } ?>
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label>Pilih Item Pekerjaan : </label>
                                    <select class="form-control" id="pekerjaan" name="pekerjaan">
                                        <option value="" disabled selected>-- Pilih -- </option>
                                        <?php foreach ($pekerjaan as $r) { ?>
                                        <option value="<?= $r->id; ?>"><?= $r->pekerjaan ?></option>    
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label>Quality Target : </label>
                                    <select class="form-control" id="penilaian" name="penilaian">
                                        <option disabled selected>-- Pilih -- </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="button" class="btn btn-primary" id='uploadFile' value='Submit'>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4" id="mydiv">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">
                            <h5>Gallery Bank Data</h5>
                            </span>
                            <span class="subtitle fw-bolder berdampingan">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <select class="form-control" name="opt_pekerjaan" id="opt_pekerjaan">
                                            <option value="" disabled selected>-- Pilih -- </option>
                                            <?php foreach ($pekerjaan as $r) { ?>
                                            <option <?= $r->id == $pekerjaan_id ? 'selected' : '' ?> value="<?= $r->id; ?>"><?= $r->pekerjaan ?></option>    
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <div class="card-body overflow-auto p-4">
                            <div class="row mb-2">
                                <?php foreach ($bank as $r) { ?>
                                    <div class="col-md-2 text-center mb-3">
                                        <div class="setimg">
                                            <a href="<?= base_url('uploads/bank_data/'.$r->nama_file);?>" data-lightbox="homePortfolio" title="
                                                <span>Project : PT. ABC</span> <br>
                                                Item Pekerjaan : Tester <br>
                                                Quality Target : Parameter <br>
                                                ">
                                                <img src="<?= base_url('uploads/bank_data/'.$r->nama_file);?>" class=""/>
                                            </a>
                                            <div class="setimgisi">
                                                <a href="<?= base_url('uploads/bank_data/'.$r->nama_file);?>" role="button" class="text text-success" download=""><span class="material-icons-round">download</span></a>
                                                <a href="#" onclick="return hapus(<?= $r->id ?>);" role="button" class="text text-danger" ><span class="material-icons-round">delete</span></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- End Content -->

        <script type="text/javascript">
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone(".dropzone", { 
               autoProcessQueue: false,
               maxFilesize: 1,
               parallelUploads: 10,
               acceptedFiles: ".jpeg,.jpg,.png,.gif",
            });

            $('#uploadFile').click(function(){
                var project_id = $("#project_id").val();
                myDropzone.processQueue();
                myDropzone.on("success", function() {
                    window.location.assign(base_url+"bank_data/admin/" + project_id); 
                });
            });

            $('#pekerjaan').change(function() {
                $("#pekerjaan_id").val(this.value);
            });

            $('#penilaian').change(function() {
                $("#kriteria_penilaian").val(this.value);
            });

            $('#opt_pekerjaan').change(function() {
                window.location.assign(base_url+"bank_data/admin/"+ this.value); 
            });

            function hapus(id) {
                var pekerjaan_id = $("#opt_pekerjaan").val();

                if (confirm('Anda yakin mau hapus data ..?')) {
                    $.ajax({
                        type: "GET",
                        url: base_url+"bank_data/hapus/"+id,
                        success: function(response) {
                            if (response.status == "ok") {
                                window.location.assign(base_url+"bank_data/admin/" + pekerjaan_id); 
                            } else {
                                console.log('gagal');
                            }
                        }
                    });
                }
                return false;
            }
        </script>