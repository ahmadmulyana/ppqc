    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">QSIA</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">QSIA</li>
                </ol>
                 <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">List Project</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="exampletype" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pekerjaan</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($project as $r) { ?>
                                        <tr>
                                            <td class="text-primary fw-bolder"><?= $no; ?></td>
                                            <td><?= $r->nama_proyek; ?></td>
                                            <?php
                                            if ($this->session->userdata('admin_level')=="3"){ ?>
                                                <td class="text-center" width="10%">
                                                    <a href="<?= site_url('qsia/detail_admin/'.$r->id);?>"><span class="material-icons-round text-success">edit</span></a> 
                                                    <a href="#" onclick="return lockNilai(<?= $r->id ?>);" ><span class="material-icons-round text-danger"><?= $r->status_lock == "Y" ? "lock" : "lock_open"?></span></a> 
                                                </td>
                                            <?php }else{ ?>
                                                <td class="text-center">
                                                    <a href="<?= site_url('qsia/detail_admin/'.$r->id);?>"><span class="material-icons-round text-success"> <?= $r->status_lock == "N" ? "edit" : ""?></span></a> 
                                                </td>
                                           <?php }
                                            ?>
                                            
                                        </tr>
                                    <?php $no++; } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- End Content -->
