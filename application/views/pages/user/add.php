    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">User</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">User</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
            <?php if($this->session->flashdata('msg_alert')) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Warning!</strong> <?=$this->session->flashdata('msg_alert');?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Add User</span></div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <?=form_open('user/save/', array('method'=>'post'));?>
                                <div class="row mb-3">
                                    <div class="form-group col-md-12">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama_lengkap">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-12">
                                        <label>NRP</label>
                                        <input type="text" class="form-control" name="nrp">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-12">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-12">
                                        <label>Projek</label>
                                        <select class="form-control" name="project" id="project">
                                       <!--
                                        <select multiple="multiple"  class="form-control" name="project[]" id="project">
                                        -->
                                            <?php foreach ($project as $r) { ?>
                                            <option value="<?= $r->id ?>"><?= $r->nama_proyek ?></option>    
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-12">
                                        <label>Role</label>
                                        <select class="form-control" name="level">
                                            <option value="" disabled selected>-- Pilih -- </option>
                                            <?php foreach ($level as $r) { ?>
                                            <option value="<?= $r->id; ?>"><?= $r->nama_level ?></option>    
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-12">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="form-group col-md-3">
                                        <input type="submit" class="btn btn-primary" value='Submit' >
                                        <a class="btn btn-danger" href="<?= site_url('personal'); ?>"> Batal </a>
                                    </div>
                                </div>
                            <?=form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- End Content -->