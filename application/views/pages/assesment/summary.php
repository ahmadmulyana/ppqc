<script src="<?= base_url() ?>assets/js/modules/highcharts/highcharts.js"></script>
<script src="<?= base_url() ?>assets/js/modules/highcharts/exporting.js"></script>
<script src="<?= base_url() ?>assets/js/modules/highcharts/export-data.js"></script>
<script src="<?= base_url() ?>assets/js/modules/highcharts/accessibility.js"></script>

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


<!-- Content -->
<div class="wrapper dashboard-page">
    <div class="page-title">
        <h5 class="fw-bolder">Summary Quality Achievement</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb subtitle">
                <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                <li class="breadcrumb-item active" aria-current="page">Summary Quality Achievement</li>
            </ol>
            <?= tgl_indo(date('Y-m-d')); ?>
        </nav>
    </div>

    <input type="text" id="<?=$this->security->get_csrf_token_name();?>" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

    <div class="content-wrapper">

        <div class="row gap-m-2 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">Graphic Item Pekerjaan</span>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group date p-0">
                                <input type="text" value="<?= date('m-Y'); ?>" id="tabul" class="tabul form-control" />
                            </div>
                        </div>
                    </div>
                        <div id="grafik_1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-m-2 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">Graphic Supply Material</span>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group date p-0">
                                <input type="text" value="<?= date('m-Y'); ?>" id="tabul_2" class="tabul form-control" />
                            </div>
                        </div>
                    </div>
                        <div id="grafik_2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-m-2 mb-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">List Project</span>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        Graphic Item Pekerjaan
                        <div id="containers1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">List Project</span>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        Graphic Item Pekerjaan
                        <div class="form-group">
                            <div class="input-group date p-0">
                                <input type="month" name="" id="" class="form-control">
                            </div>
                        </div>
                        <div id="containers2">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row gap-m-2 mb-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">List Project</span>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        Graphic Item Pekerjaan
                        <div id="containers3">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">List Project</span>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        Graphic Item Pekerjaan
                        <div class="form-group">
                            <div class="input-group date p-0">
                                <input type="month" name="" id="" class="form-control">
                            </div>
                        </div>
                        <div id="containers4">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<!-- End Content -->