    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">Non Conformance</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">NC</li>
                </ol>
                <?= $tanggal = tgl_indo(date('Y-m-d')); ?>
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
                                        $i = 1;
                                        foreach ($project as $row) 
                                    { ?>

                                        <tr>
                                        <td class="text-primary fw-bolder"><?= $i;?></td>
                                        <td><?= $row->nama_proyek; ?></td>
                                        <td class="text-center"><a href="<?= site_url('nc/detail/'.$row->id);?>"><span class="material-icons-round text-success">edit</span></a> </td>
                                    </tr>

                                    <?php $i++; } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- End Content -->
