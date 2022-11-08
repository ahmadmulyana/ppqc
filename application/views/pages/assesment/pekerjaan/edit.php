<style type="text/css">
    
.edit{
    width: 100%;
    height: 25px;
    border-radius: 5px;
}
.editMode{
    *border: 1px solid black;
}

.txtedit{
    display: none;
    width: 99%;
    height: 30px;
}

.syletext{
    width: 100%;
    height: 26px;
}

</style>

    <!-- Content -->
    <div class="wrapper dashboard-page">
        <div class="page-title">
            <h5 class="fw-bolder">Edit Assessment</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item">Assessment</li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <input type="hidden" name="mode" id="mode" value="tr_assesment_pekerjaan">

        <div class="content-wrapper">
            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Quality Assessment Validation</span>
                            <span class="subtitle fw-bolder">
                                <a class="btn btn-warning" href="javascript:history.go(-1)"><i class='fa fa-angle-double-left'></i> Kembali</a>
                            </span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" value="<?= $nama_pekerjaan; ?>" readonly>
                            </div>
                            <table class="table table-striped" style="width:100%" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Vendor</th>
                                        <th>Satuan</th>
                                        <th>Jumlah Sampling</th>
                                        <th>NC</th>
                                        <th>Nilai</th>
                                        <th>Koreksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($pekerjaan as $d) { 
                                        $nilai = (($d->nilai_pekerjaan - $d->nc_pekerjaan) / $d->nilai_pekerjaan) *100;
                                        ?>
                                        <tr>
                                        <td class="text-primary fw-bolder"><?= $no; ?></td>
                                        <td width="40%"><?= $d->nama_vendor; ?></td>
                                        <td width="10%"><?= $d->satuan_pekerjaan; ?></td>
                                        <td width="20%"><input type="text" class="form-control syletext" value="<?= $d->nilai_pekerjaan; ?>" readonly></td>
                                        <td width="10%"><input type="text" class="form-control syletext" value="<?= $d->nc_pekerjaan; ?>" readonly></td>
                                        <td width="10%"><input type="text" class="form-control syletext" value="<?= round($nilai); ?>" readonly></td>
                                        <td width="10%">
                                            <div class="edit text-center" style="background-color:  #0cadd1 "> <?= $d->koreksi; ?> </div> 
                                            <input type="text" class="form-control txtedit" id="koreksi_<?= $d->id; ?>" value="<?= $d->koreksi; ?>"/>
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

        <!-- Modal -->
        <div class="modal fade" id="centerModal" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                <span class="subtitle fw-bolder">Koreksi</span>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Text Area</label>
                                <textarea type="text" class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </div>
        </div>
