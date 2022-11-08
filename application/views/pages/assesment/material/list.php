    <!-- Content -->
    <div class="wrapper dashboard-page">
        <div class="page-title">
            <h5 class="fw-bolder">Assessment Material</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Assessment Material</li>
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
                                        <th>Reg / Jo</th>
                                        <th>Nama Owner</th>
                                        <th>Klasifikasi Bangunan</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $no=1; foreach ($project as $r) { ?>
                                        <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $r->nama_proyek ?></td>
                                        <td><?= $r->konsultan ?></td>
                                        <td><?= $r->owner; ?></td>
                                        <td><?= $r->tipe_bangunan; ?></td>
                                        <td class="text-center"><a href="<?= site_url('assesment/assesment_material_detail/'.$r->id);?>"><span class="material-icons-round text-success">edit</span></a> </td>
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
