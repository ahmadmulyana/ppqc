    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">Laporan NC</h5>
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
                            <span class="subtitle fw-bolder">List Laporan NC</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pekerjaan</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $urut =1 ;
                                    foreach ($project as $r) {  ?>
                                        <tr>
                                        <td class="text-primary fw-bolder"><?= $urut; ?></td>
                                        <td><?= $r->nama_proyek; ?></td>
                                        <td class="text-center"><a href="<?= site_url('nc/list_laporan_detail/'.$r->id)?>"><span class="material-icons-round text-success">edit</span></a> </td>
                                    </tr>    
                                    <?php $urut++; } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- End Content -->
