<style>
    .form-select {
        width: 60px !important;
    }
</style>
    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">QSIA</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item">QSIA</li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
                 <?= tgl_indo(date('Y-m-d')); $status_lock = $this->session->userdata('status_lock'); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Masukkan Nilai QSIA</span>
                            <span class="subtitle fw-bolder"></span>
                            <span class="subtitle fw-bolder">
                                <a class="btn btn-warning" href="javascript:history.go(-1)"><i class='fa fa-angle-double-left'></i> Kembali</a>
                            </span>
                        </div>

                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 80%;">Perencanaan</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($perencanaan as $r) {  ?>
                                            <tr>
                                                <td class="text-primary fw-bolder"><?= $no; ?></td>
                                                <td><?= $r->item_penilaian; ?></td>
                                                <td class="text-center m-auto">
                                                    <div class="form-group col-md-12">
                                                    <select id="<?= $r->id; ?>" name="test_<?= $no; ?>" class="form-select form-select-qa" <?= $status_lock == "Y" ? "disabled" : "" ?> >
                                                        <option value="-1" <?= $r->nilai ==  "N/A" ? 'selected' : ''; ?> >N/A</option>
                                                        <option value="0" <?= $r->nilai ==  "0" ? 'selected' : ''; ?> >0</option>
                                                        <option value="1" <?= $r->nilai ==  "1" ? 'selected' : ''; ?> >1</option>
                                                        <option value="3" <?= $r->nilai ==  "3" ? 'selected' : ''; ?> >3</option>
                                                        <option value="4" <?= $r->nilai ==  "4" ? 'selected' : ''; ?> >4</option>
                                                    </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2">Total Nilai</th>
                                                <th><input readonly type="text" id="total_1_1" name="total_1_1" value="<?= $total_nilai_perencanaan; ?>" class="form-control" placeholder="0" style="width: 60px; !important;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4 grafik-qsia">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Masukkan Nilai QSIA</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 80%;">Koordinasi & Komunikasi</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($koordinasi as $r) {  ?>
                                            <tr>
                                                <td class="text-primary fw-bolder"><?= $no; ?></td>
                                                <td><?= $r->item_penilaian; ?></td>
                                                <td class="text-center m-auto">
                                                    <div class="form-group col-md-12">
                                                    <select <?= $status_lock == "Y" ? "disabled" : "" ?> id="<?= $r->id; ?>" name="test_<?= $no; ?>" class="form-select form-select-qa">
                                                        <option value="-1" <?= $r->nilai ==  "N/A" ? 'selected' : ''; ?> >N/A</option>
                                                        <option value="0" <?= $r->nilai ==  "0" ? 'selected' : ''; ?> >0</option>
                                                        <option value="1" <?= $r->nilai ==  "1" ? 'selected' : ''; ?> >1</option>
                                                        <option value="3" <?= $r->nilai ==  "3" ? 'selected' : ''; ?> >3</option>
                                                        <option value="4" <?= $r->nilai ==  "4" ? 'selected' : ''; ?> >4</option>
                                                    </select>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2">Total Nilai</th>
                                                <th><input class="form-control" value="<?= $total_nilai_kordinasi; ?>" readonly type="text" id="total_2_1" name="total_2_1" placeholder="0" style="width: 60px; !important;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4 grafik-qsia">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Masukkan Nilai QSIA</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 80%;">Pengendalian Aspek & Sumber Daya</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($sumber_daya as $r) {  ?>
                                            <tr>
                                                <td class="text-primary fw-bolder"><?= $no; ?></td>
                                                <td><?= $r->item_penilaian; ?></td>
                                                <td class="text-center m-auto">
                                                    <div class="form-group col-md-12">
                                                    <select <?= $status_lock == "Y" ? "disabled" : "" ?> id="<?= $r->id; ?>" name="test_<?= $no; ?>" class="form-select form-select-qa">
                                                        <option value="-1" <?= $r->nilai ==  "N/A" ? 'selected' : ''; ?> >N/A</option>
                                                        <option value="0" <?= $r->nilai ==  "0" ? 'selected' : ''; ?> >0</option>
                                                        <option value="1" <?= $r->nilai ==  "1" ? 'selected' : ''; ?> >1</option>
                                                        <option value="3" <?= $r->nilai ==  "3" ? 'selected' : ''; ?> >3</option>
                                                        <option value="4" <?= $r->nilai ==  "4" ? 'selected' : ''; ?> >4</option>
                                                    </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2">Total Nilai</th>
                                                <th><input class="form-control" value="<?= $total_nilai_sumber_daya; ?>" readonly type="text" id="total_3_1" name="total_3_1" placeholder="0" style="width: 60px; !important;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4 grafik-qsia">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Masukkan Nilai QSIA</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 80%">Pengendalian Aspek Penunjang</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($penunjang as $r) {  ?>
                                            <tr>
                                                <td class="text-primary fw-bolder"><?= $no; ?></td>
                                                <td><?= $r->item_penilaian; ?></td>
                                                <td class="text-center m-auto">
                                                    <div class="form-group col-md-12">
                                                    <select <?= $status_lock == "Y" ? "disabled" : "" ?> id="<?= $r->id; ?>" name="test_<?= $no; ?>" class="form-select form-select-qa">
                                                        <option value="-1" <?= $r->nilai ==  "N/A" ? 'selected' : ''; ?> >N/A</option>
                                                        <option value="0" <?= $r->nilai ==  "0" ? 'selected' : ''; ?> >0</option>
                                                        <option value="1" <?= $r->nilai ==  "1" ? 'selected' : ''; ?> >1</option>
                                                        <option value="3" <?= $r->nilai ==  "3" ? 'selected' : ''; ?> >3</option>
                                                        <option value="4" <?= $r->nilai ==  "4" ? 'selected' : ''; ?> >4</option>
                                                    </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2">Total Nilai</th>
                                                <th><input class="form-control" value="<?= $total_nilai_penunjang; ?>" readonly type="text" id="total_4_1" name="total_4_1" placeholder="0" style="width: 60px; !important;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4 grafik-qsia">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Masukkan Nilai QSIA</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 80%;">Pengendalian Proses</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($proses as $r) {  ?>
                                            <tr>
                                                <td class="text-primary fw-bolder"><?= $no; ?></td>
                                                <td><?= $r->item_penilaian; ?></td>
                                                <td class="text-center m-auto">
                                                    <div class="form-group col-md-12">
                                                    <select <?= $status_lock == "Y" ? "disabled" : "" ?> id="<?= $r->id; ?>" name="test_<?= $no; ?>" class="form-select form-select-qa">
                                                        <option value="-1" <?= $r->nilai ==  "N/A" ? 'selected' : ''; ?> >N/A</option>
                                                        <option value="0" <?= $r->nilai ==  "0" ? 'selected' : ''; ?> >0</option>
                                                        <option value="1" <?= $r->nilai ==  "1" ? 'selected' : ''; ?> >1</option>
                                                        <option value="3" <?= $r->nilai ==  "3" ? 'selected' : ''; ?> >3</option>
                                                        <option value="4" <?= $r->nilai ==  "4" ? 'selected' : ''; ?> >4</option>
                                                    </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2">Total Nilai</th>
                                                <th><input class="form-control" value="<?= $total_nilai_proses; ?>" readonly type="text" id="total_5_1" name="total_5_1" placeholder="0" style="width: 60px; !important;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->