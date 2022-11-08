
<link href="<?= base_url('assets/vendors/');?>lib/main.css" rel="stylesheet" />
<script src="<?= base_url('assets/vendors/');?>lib/main.js"></script>

    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">Inspeksi</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Inspeksi</li>
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
                                <div class="col-md-6"><span class="subtitle fw-bolder">List Inspeksi</span></div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col-xl-2 pa-0 inspeksi">
                                    <div class="w-100 mb-2">
                                        <a data-bs-toggle="modal" data-bs-target="#rencanainspeksi" style="cursor: pointer;" class="btn btn-orange w-100">
                                            Rencana Inspeksi
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="rencanainspeksi" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="centerModalLabel">Add Agenda</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <?=form_open('inspeksi/save/', array('method'=>'post'));?>
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="alert alert-danger" role="alert">
                                                                    Anda Tidak Dapat Membuat Rencana Inspeksi Melebihin Pukul 11.00 WIB !
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-12">
                                                                <label>Proyek</label>
                                                                <select name="project" class="form-control">
                                                                    <option selected>--Pilih--</option>
                                                                    <?php foreach ($project as $r) { ?>
                                                                        <option value="<?= $r->id?>"><?= $r->nama_proyek ?></option>    
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-12">
                                                                <label>Deskripsi</label>
                                                                <textarea name="keterangan" class="form-control" rows="4"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-12">
                                                                <label>Tanggal Inspeksi</label>
                                                                <input type="date" class="form-control" name="tanggal">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-6">
                                                            <div class="form-group col-md-6">
                                                                <input class="btn btn-primary"  type="submit" name="submit" value="Submit" role="button">
                                                                <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100 mb-2">
                                        <a data-bs-toggle="modal" data-bs-target="#mwt" style="cursor: pointer;" class="btn btn-blue w-100">
                                            MWT
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="mwt" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="centerModalLabel">Add Agenda</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <form>
                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-12">
                                                                <label>Proyek</label>
                                                                <select class="form-select">
                                                                    <option selected>Pilih salah satu</option>
                                                                    <option value="1">One</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-12">
                                                                <label>Deskripsi</label>
                                                                <textarea class="form-control" rows="4"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-12">
                                                                <label>Tanggal Inspeksi</label>
                                                                <input type="date" class="form-control" name="">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-12">
                                                                <label>Nama</label>
                                                                <select class="form-select">
                                                                    <option selected>Pilih salah satu</option>
                                                                    <option value="1">One</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-3">
                                                                <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    if ($this->session->userdata('admin_level')=='3'){ ?>
                                    
                                    <div class="w-100 mb-2">
                                        <a data-bs-toggle="modal" data-bs-target="#realisasiinspeksi" style="cursor: pointer;" class="btn btn-green w-100">
                                            Realisasi Inspeksi
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="realisasiinspeksi" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="centerModalLabel">Add Realisasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <form>
                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-12">
                                                                <label>Inspeksi</label>
                                                                <select name="inspeksi" class="form-control">
                                                                    <option selected>--Pilih--</option>
                                                                    <?php foreach ($inspeksi as $r) { ?>
                                                                        <option value="<?= $r->id?>"><?= $r->keterangan ?></option>    
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-12">
                                                                <label>Deskripsi</label>
                                                                <textarea class="form-control" rows="4"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="form-group col-md-12">
                                                                <label>Tanggal Realisasi</label>
                                                                <input type="date" class="form-control" name="tanggal">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-6">
                                                            <div class="form-group col-md-6">
                                                                <input class="btn btn-primary"  type="submit" name="submit" value="Submit" role="button">
                                                                <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    
                                    <div class="w-100 mb-2 mt-4">
                                        <a href="<?= site_url('inspeksi/createExcel')?>" class="btn btn-export w-100"> <span class="material-icons-round material-22">file_present</span> Export</a>
                                    </div>
                                    <div class="w-100 mb-2 mt-2">
                                        <a href="<?= site_url('validasi');?>" class="btn btn-dark w-100">Commit Validasi</a>
                                    </div>

                                    <?php }
                                    ?>

                                </div>
                                <div class="col-xl-10 pa-0">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- End Content -->

<?php
    /* Mencrettt
        $arr = array();
        foreach ($data as $a) {
            $arr['title'] = $a->keterangan;
            $arr['start'] = $a->tanggal;
        }
    */

    /* Wadaw ... Joss revisian dari pak Rusmana */

    $arr = array();
    foreach ($inspeksi as $a) {
        $arr[] = [
            'title' => $a->keterangan,
            'start' => $a->tanggal
        ];
    }

?>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: "<?= date('Y-m-d')?>",
      editable: true,
      selectable: true,
      businessHours: true,
      dayMaxEvents: true, 
      events: <?= json_encode($arr); ?>
    });

    calendar.render();
  });

</script>