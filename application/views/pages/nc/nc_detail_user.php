<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
    .berdampingan {
        display: inline-flex;
    }
    .date {
        height: 42px;
        padding-right: 10px;
    }
</style>

<script src="<?= base_url() ?>assets/js/modules/highcharts/highcharts.js"></script>
<script src="<?= base_url() ?>assets/js/modules/highcharts/exporting.js"></script>
<script src="<?= base_url() ?>assets/js/modules/highcharts/export-data.js"></script>
<script src="<?= base_url() ?>assets/js/modules/highcharts/accessibility.js"></script>

<style>
    #containers .highcharts-figure,
    .highcharts-data-table table {
        max-height: 300px;
    }
</style>

<!-- Content -->
<div class="wrapper css-page">
    <div class="page-title">
        <div class="form-group fortitlenc" style="width: 100px;">
            <select class="form-select" id="project_nc">
                <?php foreach ($project as $r) { ?>
                    <option value="<?= $r->id; ?>"><?= $r->nama_proyek ?></option>    
                <?php } ?>
            </select>
        </div>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb subtitle">
                <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                <li class="breadcrumb-item active" aria-current="page">NC</li>
            </ol>
            <?= $tanggal = tgl_indo(date('Y-m-d')); $thn_sekarang = date('Y'); ?>
        </nav>
    </div>

    <div class="content-wrapper">

        <div class="row gap-m-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">Graphic NC</span>
                        <div class="form-group mb-0">
                            <select class="form-select" id="tahun">
                                <?php
                                    foreach ($tahun as $t) { ?>
                                        <option value="<?= $t->tahun?>" <?= $t->tahun ==  $thn_sekarang ? 'selected' : ''; ?> ><?= $t->tahun?></option>
                                    <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="containerss" class="w-100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pad-cus">
                        <span class="subtitle fw-bolder">Closed NC</span>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="containers" class="w-100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <input type="hidden" id="<?=$this->security->get_csrf_token_name();?>" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

            <input type="hidden" id="project_id" value="<?= $project_id; ?>">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row w-100">
                            <div class="col-md-6"><span class="subtitle fw-bolder">List Laporan NC</span></div>
                            <div class="col-md-6 text-right">
                                <div class="form-group forstatusnc">
                                    <select class="form-select" id="status_nc">
                                        <option value="All" <?= $status_nc == "All" ? 'selected' : '' ?>>Semua</option>
                                        <option value="Closed" <?= $status_nc == "Closed" ? 'selected' : '' ?> >Closed</option>
                                        <option value="Open" <?= $status_nc == "Open" ? 'selected' : '' ?> >Open</option>
                                    </select>
                                </div>
                                <a href="<?= site_url('nc/add_nc');?>" class="btn btn-primary"><i class="fas fa-plus"></i> <?= date('d') <=30 ? "Buat Laporan Baru" : "" ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="exampletype" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nomor</th>
                                            <th>Tanggal</th>
                                            <th>SOM</th>
                                            <th>GSP</th>
                                            <th>Mandor</th>
                                            <th>Temuan</th>
                                            <th>Type</th>
                                            <th>Pekerjaan</th>
                                            <th>Status</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="isi">

                                        <?php

                                        $i = 1;

                                        if (!empty($data_nc)) {


                                        foreach ($data_nc as $row) {
                                            $class = $row->status_nc == "Open" ? "badge badge-danger" : "badge badge-success";

                                            ?>
                                            <tr>
                                                <td class="text-primary fw-bolder"><?= $i++ ;?></td>
                                                <td><?= $row->nomor_nc; ?></td>
                                                <td><?= $row->tanggal; ?></td>
                                                <td><?= $row->som_nc; ?></td>
                                                <td><?= $row->gps_nc; ?></td>
                                                <td><?= $row->mandor; ?></td>
                                                <td><?= $row->uraian_temuan; ?></td>
                                                <td><?= $row->type_nc; ?></td>
                                                <td><?= $row->pekerjaan; ?></td>
                                                <td><span class="<?= $class?>"><?= $row->status_nc ?></span></td>
                                                <td>
                                                    <?php
                                                        if ($row->status_nc=="Open"){ ?>
                                                            <a href="<?= site_url('nc/edit_nc/'.$row->id); ?>"><span class="material-icons-round text-success">edit</span></a> 
                                                        <?php }else{ ?>
                                                            <a href="<?= site_url('nc/lihat_nc/'.$row->id); ?>"><span class="material-icons-round text-info">visibility</span></a> 
                                                        <?php }
                                                    ?>
                                                </td>
                                            </tr>

                                        <?php }  }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>