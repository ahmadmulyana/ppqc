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

<!-- Content -->
<div class="wrapper qsia-page">
    <div class="page-title">
        <h5 class="fw-bolder">QSIA</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb subtitle">
                <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                <li class="breadcrumb-item active" aria-current="page">QSIA</li>
            </ol>
            <?= tgl_indo(date('Y-m-d')); ?>
        </nav>
    </div>

    <div class="content-wrapper">

        <div class="row gap-m-2">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body overflow-auto p-4">
                        Nilai Yang Diperiksa
                        <div class="bgblue p-2 mt-2"><?= ($total_nilai_1+ $total_nilai_2 + $total_nilai_3 + $total_nilai_4 + $total_nilai_5); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body overflow-auto p-4">
                        Total Nilai Potensi
                        <div class="bgblue p-2 mt-2"><?= $total_nilai_potensi; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body overflow-auto p-4">
                        Skor Sistem
                        <?php
                            if($total_nilai_1==0 || $total_nilai_2 ==0){
                                $score_sistem="";
                            }else{
                                $score_sistem = round(($total_nilai_1 + $total_nilai_2)/($total_nilai_max_1+$total_nilai_max_2)*100);
                            }
                        ?>
                        <div class="bgyellow p-2 mt-2"><?= $score_sistem;?>%</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body overflow-auto p-4">
                        Skor Site Condition

                        <?php
                            if($total_nilai_3==0 || $total_nilai_4 ==0 || $total_nilai_5 ==0){
                                $score_site="";
                            }else{
                                $score_site = round(($total_nilai_3 + $total_nilai_4 + $total_nilai_5)/($total_nilai_max_3+$total_nilai_max_4+$total_nilai_max_5)*100);
                            }
                        ?>

                        <div class="bgblue p-2 mt-2"><?= $score_site ?>%</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body overflow-auto p-4">
                        <!-- Pilih Project & Nilai berdasarkan Bulan -->
                        <div class="form-group mt-2 mb-2">
                            <select class="form-select" id="project_nc" disabled>
                                <option selected><?= $nama_project; ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-group date p-0">
                                <input type="text" id="tahun" class="date-own form-control" placeholder="Pilih Tahun" />
                            </div>
                        </div>
                        <div class="p-5 mt-2">
                            <div id="containers"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-blue nc-blue">
                    <div class="card-body subtitle p-4">
                        <img src="<?= base_url('assets/images/');?>nc.png">

                        <?php
                            $jml =0;
                            $jml_potensi=0;

                            foreach ($nilai as $r) {
                                $jml += $r->nil;
                                $jml_potensi += $r->nil_mak;
                            }
                        ?>
                        <h2>Nilai Bulan Ini</h2>
                        <h1><?= $jml == 0 ? "" : round(($jml/$jml_potensi)*100); ?>%</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">List Item Penilaian</span>
                        <span class="subtitle fw-bolder berdampingan">
                            <div class="form-group">
                                <div class="input-group date">
                                    <input type="text" value="<?= $this->session->userdata('tabul_asli')=="" ? date('m-Y') : $this->session->userdata('tabul_asli'); ?>" id="datepicker" class="form-control" />
                                </div>
                            </div>
                            <a href="<?= site_url('qsia_add');?>" role="button" class="btn btn-primary">
                                <?= $status_lock =="Y" ? "Lihat Nilai QSIA" : "Masukkan Nilai QSIA" ?></a>
                        </span>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <table  class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item Penilaian</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                        <tbody id="isi">

                                        <?php 
                                        $i = 1;
                                        $total=0;
                                        foreach ($nilai as $r) { 
                                            $prosentase = round(($r->nil/$r->nil_mak)*100,0);
                                            ?>
                                                <tr>
                                                    <td class="text-primary fw-bolder"><?= $i++; ?></td>
                                                    <td><?= $r->item_penilaian; ?></td>
                                                    <td><?= $prosentase; ?>%</td>
                                                </tr>
                                            <?php $total += $r->nilai; } ?>
                                        </tbody>

                                        <tfoot id="isi_footer">
                                            <tr>
                                                <th colspan="2" class="text-primary fw-bolder">TOTAL</th>
                                                <th class="text-primary fw-bolder"><?= round(($total/5),0); ?>%</th>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body subtitle overflow-auto p-4">
                            <figure class="highcharts-figure">
                                <div id="grafik_implementasi"></div>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body subtitle overflow-auto p-4">
                            <figure class="highcharts-figure">
                                <div id="grafik_site"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Content -->

        <script>
            Highcharts.chart('grafik_site', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Site Condition'
                },
                xAxis: {
                    categories: [
                    'Pengendalian aspek sumber daya',
                    'Pengendalian aspek penunjang',
                    'Pengendalian proses'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Site Condition'
                    },
                    label : {
                      formatter : function (){
                        return this.value;
                      }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Penilaian',
                    data: [<?= $total_nilai_3 ?>, <?= $total_nilai_4 ?>, <?= $total_nilai_5 ?>]

                }]
            });
        </script>