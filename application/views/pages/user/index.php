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
            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">List User</span></div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-primary" href="<?= site_url('user/add'); ?>"> <i class="fas fa-plus"></i> Tambah User </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NRP</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($user as $r) { ?>
                                        <tr>
                                            <td class="text-primary fw-bolder"><?= $no; ?></td>
                                            <td><?= $r->nrp; ?></td>
                                            <td><?= $r->nama_lengkap; ?></td>
                                            <td><?= $r->email; ?></td>
                                            <td class="text-center">
                                                <a style="cursor: pointer;" href="<?= site_url('user/edit/'.$r->id); ?>"><span class="material-icons-round text-success">edit</span></a> 
                                                <a href="<?= site_url('user/delete/'.$r->id); ?>" ><span class="material-icons-round text-danger">delete</span></a> 
                                            </td>
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