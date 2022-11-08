    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">Pengaturan Umum</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pengaturan Umum</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
            <div class="row gap-m-2">

                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Side Banner Login</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input class="form-control" type="file" id="file" name="photo" onchange="previewFile(this);" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="hover09 column">
                                    <div>
                                        <figure>
                                            <a href="<?= base_url('uploads/general/'.$banner);?>" download>
                                                <img id="previewImg" src="<?= base_url('uploads/general/'.$banner);?>" class="w-100"/>
                                            </a>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Logo</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input class="form-control" type="file" id="fileLogo" name="photoLogo" onchange="previewFileLogo(this);" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="hover09 column">
                                    <div class="preview">
                                        <figure>
                                            <a href="<?= base_url('uploads/general/'.$logo);?>" download>
                                                <img id="previewImgLogo" src="<?= base_url('uploads/general/'.$logo);?>" class="w-100"/>
                                            </a>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Dokumentasi</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input class="form-control" type="file" id="formFile" multiple>
                                </div>
                            </div>
                            <div class="row">
                                <div class="hover09 column">
                                    <div>
                                        <figure><a href="<?= base_url('assets/images/');?>PP-QHSE.pdf" download><img src="<?= base_url('assets/images/');?>icon_pdf.png" class="w-100"/></a></figure>
                                        <!-- <span>Nama project</span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
        </div>
        <!-- End Content -->