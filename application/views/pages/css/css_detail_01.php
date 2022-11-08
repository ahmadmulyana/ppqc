<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<?php

if ($project){
    $proses_kerja1 = $project->pengelolaan_proses_kerja_50;
    $proses_kerja2 = $project->pengelolaan_proses_kerja_100;
    $kapasitas_sdm_50 = $project->kapasitas_sdm_50;
    $kapasitas_sdm_100 = $project->kapasitas_sdm_100;
    $kualitas_produk_50 = $project->kualitas_produk_50;
    $kualitas_produk_100 = $project->kualitas_produk_100;
    $ketepatan_waktu_penyelesaian_50 = $project->ketepatan_waktu_penyelesaian_50;
    $ketepatan_waktu_penyelesaian_100 = $project->ketepatan_waktu_penyelesaian_100;
    $pengelolaan_ktiga_50 = $project->pengelolaan_ktiga_50;
    $pengelolaan_ktiga_100 = $project->pengelolaan_ktiga_100;
    $kepedulian_terhadap_lingkungan_50 = $project->kepedulian_terhadap_lingkungan_50;
    $kepedulian_terhadap_lingkungan_100 = $project->kepedulian_terhadap_lingkungan_100;
    $fleksibilitas_layanan_50 = $project->fleksibilitas_layanan_50;
    $fleksibilitas_layanan_100 = $project->fleksibilitas_layanan_100;
    $kecepatan_respon_50 = $project->kecepatan_respon_50;
    $kecepatan_respon_100 = $project->kecepatan_respon_100;
    $komunikasi_interpersonal_50 = $project->komunikasi_interpersonal_50;
    $komunikasi_interpersonal_100 = $project->komunikasi_interpersonal_100;
    $kesesuaian_anggaran_50 = $project->kesesuaian_anggaran_50;
    $kesesuaian_anggaran_100 = $project->kesesuaian_anggaran_100;
}else{
    $proses_kerja1 = '';
    $proses_kerja2 = '';
    $kapasitas_sdm_50 = '';
    $kapasitas_sdm_100 = '';
    $kualitas_produk_50 ='';
    $kualitas_produk_100 ='';
    $ketepatan_waktu_penyelesaian_50 ='';
    $ketepatan_waktu_penyelesaian_100 ='';
    $pengelolaan_ktiga_50 ='';
    $pengelolaan_ktiga_100 ='';
    $kepedulian_terhadap_lingkungan_50 = '';
    $kepedulian_terhadap_lingkungan_100 = '';
    $fleksibilitas_layanan_50 = '';
    $fleksibilitas_layanan_100 = '';
    $kecepatan_respon_50 = '';
    $kecepatan_respon_100 = '';
    $komunikasi_interpersonal_50 = '';
    $komunikasi_interpersonal_100 = '';
    $kesesuaian_anggaran_50 = '';
    $kesesuaian_anggaran_100 = '';
}

?>


    <!-- Content -->
    <div class="wrapper css-page">
        <input type="hidden" id="project_id" value="<?= $this->session->userdata('project_id'); ?>">
        <div class="page-title">
            <h5 class="fw-bolder">Customer Satisfaction Survey</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item">CSS</li>
                  <li class="breadcrumb-item active" aria-current="page">Input</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">

            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card card-blue">
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col text-left forh1">46%</div>
                                <div class="col text-center forh4">Silahkan Isi CSS 50%</div>
                                <div class="col text-right forh4">+90 Hari ( Belum Isi )</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header w-100">
                            <div class="row w-100">
                                <div class="col-md-6">
                                    <span class="subtitle fw-bolder">List Item Survey</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#areapekerjaannc" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Upload CSS</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="areapekerjaannc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Upload Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>File</label>
                                                            <input type="file" class="form-control" value="">
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
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Survey</th>
                                                <th>CSS 50%</th>
                                                <th>CSS 100%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-primary fw-bolder">1</td>
                                                <td>PENGELOLAAN PROSES KERJA</td>
                                                <td><input value="<?= $proses_kerja1; ?>" id="proses_kerja1" type="text" name="proses_kerja1" placeholder="49%"></td>
                                                <td><input value="<?= $proses_kerja2; ?>" id="proses_kerja2" type="text" name="proses_kerja2" placeholder="98%"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bolder">2</td>
                                                <td>KAPASITAS SDM</td>
                                                <td><input value="<?= $kapasitas_sdm_50; ?>" type="text" placeholder="49%"></td>
                                                <td><input value="<?= $kapasitas_sdm_100; ?>" type="text" placeholder="98%"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bolder">3</td>
                                                <td>KUALITAS PRODUK</td>
                                                <td><input value="<?= $kualitas_produk_50; ?>" type="text" placeholder="49%"></td>
                                                <td><input value="<?= $kapasitas_sdm_100; ?>" type="text" placeholder="98%"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bolder">4</td>
                                                <td>KETEPATAN WAKTU PENYELESAIAN</td>
                                                <td><input type="text" value="<?= $ketepatan_waktu_penyelesaian_50; ?>" placeholder="49%"></td>
                                                <td><input type="text" value="<?= $ketepatan_waktu_penyelesaian_100; ?>" placeholder="98%"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bolder">5</td>
                                                <td>PENGELOLAAN K3</td>
                                                <td><input type="text" value="<?= $pengelolaan_ktiga_50; ?>" placeholder="49%"></td>
                                                <td><input type="text" value="<?= $pengelolaan_ktiga_100; ?>" placeholder="98%"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bolder">6</td>
                                                <td>KEPEDULIAN TERHADAP LINGKUNGAN</td>
                                                <td><input type="text" value="<?= $kepedulian_terhadap_lingkungan_50?>" placeholder="49%"></td>
                                                <td><input type="text" value="<?= $kepedulian_terhadap_lingkungan_100?>" placeholder="98%"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bolder">7</td>
                                                <td>FLEKSIBILITAS LAYANAN</td>
                                                <td><input type="text" value="<?= $fleksibilitas_layanan_50?>" placeholder="49%"></td>
                                                <td><input type="text" value="<?= $fleksibilitas_layanan_50?>" placeholder="98%"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bolder">8</td>
                                                <td>KECEPATAN RESPON</td>
                                                <td><input type="text" value="<?= $kecepatan_respon_50?>" placeholder="49%"></td>
                                                <td><input type="text" value="<?= $kecepatan_respon_100?>" placeholder="98%"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bolder">9</td>
                                                <td>KOMUNIKASI & HUB. INTERPERSONAL</td>
                                                <td><input type="text" value="<?= $komunikasi_interpersonal_50?>" placeholder="49%"></td>
                                                <td><input type="text" value="<?= $komunikasi_interpersonal_100?>" placeholder="98%"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bolder">10</td>
                                                <td>KESESUAIAN ANGGARAN THP HASIL KERJA</td>
                                                <td><input type="text" value="<?= $kesesuaian_anggaran_50?>" placeholder="49%"></td>
                                                <td><input type="text" value="<?= $kesesuaian_anggaran_100?>" placeholder="98%"></td>
                                            </tr>
                                        </tbody>
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
                        <div class="card-body subtitle overflow-auto p-4">
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- End Content -->

        <script>
            Highcharts.chart('container', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Grafik Satisfaction Survey'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'CSS'
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                tooltip: {
                    crosshairs: true,
                    shared: true
                },
                plotOptions: {
                    spline: {
                        marker: {
                            radius: 4,
                            lineColor: '#666666',
                            lineWidth: 1
                        }
                    }
                },
                series: [{
                    name: 'CSS',
                    marker: {
                        symbol: 'square'
                    },
                    data: [80, 70, 78, 82, 89, 98, 75, 98, 99, 87, 79, 86]

                }]
            });
        </script>
