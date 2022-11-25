    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">Non Conformance</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">NC</li>
                </ol>
                Sabtu, 23 Oktober 2021
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
                                        <th>Proyek</th>
                                        <th>Nama Lengkap</th>
                                        <th>Area</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($data as $row)  { ?>
                                        <tr>
                                            <td class="text-primary fw-bolder"><?= $no ?></td>
                                            <td><?= $row->nama_proyek ?></td>
                                            <td><?= $row->nama_lengkap ?></td>
                                            <td>Area-1</td>
                                            <td>PM</td>
                                            <td class="text-center">
                                                <select class="form-select">
                                                    <option selected="">Ok</option>
                                                    <option value="1">Not Ok</option>
                                                </select>
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
