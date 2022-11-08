
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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


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
                <option>Pilih Proyek</option>
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
            <?= $tanggal = tgl_indo(date('Y-m-d')); ?>
        </nav>
    </div>

    <div class="content-wrapper">

        <div class="row gap-m-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">Graphic NC</span>
                        <div class="form-group mb-0">
                            <select class="form-select">
                                <option selected="">2022</option>
                                <option value="1">2021</option>
                                <option value="2">2020</option>
                                <option value="3">2019</option>
                                <option value="4">2018</option>
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
            <!-- <div class="col-md-4">
                <div class="card card-blue nc-blue">
                    <div class="card-body subtitle p-4">
                        <img src="<?= base_url('assets/images/');?>nc.png">
                        <h2>CLOSING NC</h2>
                        <h5>*Target min 90%</h5>
                        <h1><?= $total_closing ."%"; ?></h1>
                    </div>
                </div>
            </div> -->
        </div>

        <div class="row mt-4">
            <input type="hidden" id="project_id" value="<?= $project_id; ?>">
            <!-- <div class="col-md-3">
                <div class="card card-blue nc-blue">
                    <div class="card-body subtitle p-4">
                        <img src="<?= base_url('assets/images/');?>nc.png" class="w-50">
                        <h2>CLOSING NC</h2>
                        <h5>*Target min 90%</h5>
                        <h1><?= $total_closing ."%"; ?></h1>
                    </div>
                </div>
            </div> -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row w-100">
                            <div class="col-md-6"><span class="subtitle fw-bolder">List Laporan NC</span></div>
                            <div class="col-md-6 text-right">
                                <div class="form-group forstatusnc">
                                    <select class="form-select" id="status">
                                        <option value="All" <?= $status_nc == "All" ? 'selected' : '' ?>>Semua</option>
                                        <option value="Closed" <?= $status_nc == "Closed" ? 'selected' : '' ?> >Closed</option>
                                        <option value="Open" <?= $status_nc == "Open" ? 'selected' : '' ?> >Open</option>
                                    </select>
                                </div>
                                <a href="<?= site_url('nc/add_nc');?>" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Laporan Baru</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Project</th>
                                            <th>Nomor NC</th>
                                            <th>Tanggal NC</th>
                                            <th>Temuan</th>
                                            <th>Type NC</th>
                                            <th>Pekerjaan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $i = 1;
                                        foreach ($data_nc as $row) {
                                            $class = $row->status_nc == "Open" ? "badge badge-danger" : "badge badge-success";

                                            ?>
                                            <tr>
                                                <td class="text-primary fw-bolder"><?= $i++ ;?></td>
                                                <td>Tambah Nama Project Khusus di Superadmin</td>
                                                <td><?= $row->nomor_nc; ?></td>
                                                <td><?= $row->tanggal; ?></td>
                                                <td><?= $row->uraian_temuan; ?></td>
                                                <td><?= $row->type_nc; ?></td>
                                                <td><?= $row->pekerjaan; ?></td>
                                                <td><span class="<?= $class?>"><?= $row->status_nc ?></span></td>
                                                <td>
                                                    <a href="<?= site_url('nc/edit_nc/'.$row->id); ?>"><span class="material-icons-round text-success">edit</span></a> 
                                                    <a href="#"><span class="material-icons-round text-info">visibility</span></a> 
                                                </td>
                                            </tr>

                                        <?php }
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
    



    <script>

        var data_open = <?php echo $open; ?>;
        var data_close = <?php echo $close; ?>;

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                'Bulan Lalu',
                'Bulan Ini',
                's.d Bulan Ini'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
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
                name: 'Open',
                data: data_open
            },{
                name: 'Closed',
                data: data_close

            }]
        });
    </script>


    <?php
        /* Mengambil query report*/
        foreach($closed as $result){
            $bulan[] = $result->bulan; //ambil bulan
            $value[] = (float) $result->total; //ambil nilai
        }
        /* end mengambil query*/
         
    ?>

    <script>
        Highcharts.chart('containers', {
            chart: {
                type: 'line'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                //categories: /* <?php echo json_encode($bulan);?> */
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Closed NC',
                // data: [0, 78, 82, 100, 0, 0, 0, 0, 0, 0, 0, 0]
                data: <?php echo json_encode($value);?>
            }]
        });
    </script>

    <script>

        var data_open = <?php echo $open; ?>;
        var data_close = <?php echo $close; ?>;

        Highcharts.chart('containerss', {
          chart: {
            type: 'column'
          },
          title: {
            text: ''
          },
          xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
          },
          yAxis: {
            min: 0,
            title: {
              text: ''
            },
            stackLabels: {
              enabled: true,
              style: {
                fontWeight: 'bold',
                color: ( // theme
                  Highcharts.defaultOptions.title.style &&
                  Highcharts.defaultOptions.title.style.color
                ) || 'gray'
              }
            }
          },
          legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
          },
          tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
          },
          plotOptions: {
            column: {
              stacking: 'normal',
              dataLabels: {
                enabled: true
              }
            }
          },
          series: [{
            name: 'Open',
            data: data_open
            // data: [0, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0]
          }, {
            name: 'Closed',
            data: data_close
            // data: [0, 0, 3, 4, 6, 6, 6, 2, 3, 5, 2, 11]
          }]
        });

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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


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
            <select class="form-select project_nc" id="project_nc">
                <option></option>
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
            <?= $tanggal = tgl_indo(date('Y-m-d')); ?>
        </nav>
    </div>

    <div class="content-wrapper">

        <div class="row gap-m-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">Graphic NC</span>
                        <div class="form-group mb-0">
                            <select class="form-select">
                                <?php
                                    foreach ($tahun as $t) { ?>
                                        <option value="<?= $t->tahun?>"><?= $t->tahun?></option>
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
                                <a href="<?= site_url('nc/add_nc');?>" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Laporan Baru</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Project</th>
                                            <th>Nomor NC</th>
                                            <th>Tanggal NC</th>
                                            <th>Temuan</th>
                                            <th>Type NC</th>
                                            <th>Pekerjaan</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                                <td><?= $row->nama_project; ?></td>
                                                <td><?= $row->nomor_nc; ?></td>
                                                <td><?= $row->tanggal; ?></td>
                                                <td><?= $row->uraian_temuan; ?></td>
                                                <td><?= $row->type_nc; ?></td>
                                                <td><?= $row->pekerjaan; ?></td>
                                                <td><span class="<?= $class?>"><?= $row->status_nc ?></span></td>
                                                <td>
                                                    <a href="<?= site_url('nc/edit_nc/'.$row->id); ?>"><span class="material-icons-round text-success">edit</span></a> 
                                                    <a href="#"><span class="material-icons-round text-info">visibility</span></a> 
                                                </td>
                                            </tr>

                                        <?php } }
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
    



    <script>

        var data_open = <?php echo $open; ?>;
        var data_close = <?php echo $close; ?>;

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                'Bulan Lalu',
                'Bulan Ini',
                's.d Bulan Ini'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
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
                name: 'Open',
                data: data_open
            },{
                name: 'Closed',
                data: data_close

            }]
        });
    </script>


    <?php
        /* Mengambil query report*/
        foreach($closed as $result){
            $bulan[] = $result->bulan; //ambil bulan
            $value[] = (float) $result->total; //ambil nilai
        }
        /* end mengambil query*/
         
    ?>

    <script>
        Highcharts.chart('containers', {
            chart: {
                type: 'line'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                //categories: /* <?php echo json_encode($bulan);?> */
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Closed NC',
                data: [0, 78, 82, 100, 0, 0, 0, 0, 0, 0, 0, 0]
                // data: /* <?php echo json_encode($value);?> */
            }]
        });
    </script>

    <script>

        var data_open = <?php echo $open; ?>;
        var data_close = <?php echo $close; ?>;

        Highcharts.chart('containerss', {
          chart: {
            type: 'column'
          },
          title: {
            text: ''
          },
          xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
          },
          yAxis: {
            min: 0,
            title: {
              text: ''
            },
            stackLabels: {
              enabled: true,
              style: {
                fontWeight: 'bold',
                color: ( // theme
                  Highcharts.defaultOptions.title.style &&
                  Highcharts.defaultOptions.title.style.color
                ) || 'gray'
              }
            }
          },
          legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
          },
          tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
          },
          plotOptions: {
            column: {
              stacking: 'normal',
              dataLabels: {
                enabled: true
              }
            }
          },
          series: [{
            name: 'Open',
            // data: data_open
            data: [0, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0]
          }, {
            name: 'Closed',
            data: data_close
            // data: [0, 0, 3, 4, 6, 6, 6, 2, 3, 5, 2, 11]
          }]
        });

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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


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
            <select class="form-select project_nc" id="project_nc">
                <option></option>
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
            <?= $tanggal = tgl_indo(date('Y-m-d')); ?>
        </nav>
    </div>

    <div class="content-wrapper">

        <div class="row gap-m-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="subtitle fw-bolder">Graphic NC</span>
                        <div class="form-group mb-0">
                            <select class="form-select">
                                <option selected="">2022</option>
                                <option value="1">2021</option>
                                <option value="2">2020</option>
                                <option value="3">2019</option>
                                <option value="4">2018</option>
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
            <input type="text" id="project_id" value="<?= $project_id; ?>">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row w-100">
                            <div class="col-md-6"><span class="subtitle fw-bolder">List Laporan NC</span></div>
                            <div class="col-md-6 text-right">
                                <div class="form-group forstatusnc">
                                    <select class="form-select" id="status">
                                        <option value="All" <?= $status_nc == "All" ? 'selected' : '' ?>>Semua</option>
                                        <option value="Closed" <?= $status_nc == "Closed" ? 'selected' : '' ?> >Closed</option>
                                        <option value="Open" <?= $status_nc == "Open" ? 'selected' : '' ?> >Open</option>
                                    </select>
                                </div>
                                <a href="<?= site_url('nc/add_nc');?>" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Laporan Baru</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body subtitle overflow-auto p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Project</th>
                                            <th>Nomor NC</th>
                                            <th>Tanggal NC</th>
                                            <th>Temuan</th>
                                            <th>Type NC</th>
                                            <th>Pekerjaan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $i = 1;

                                        if (!empty($data_nc)) {

                                        
                                        foreach ($data_nc as $row) {
                                            $class = $row->status_nc == "Open" ? "badge badge-danger" : "badge badge-success";

                                            ?>
                                            <tr>
                                                <td class="text-primary fw-bolder"><?= $i++ ;?></td>
                                                <td>Tambah Nama Project Khusus di Superadmin</td>
                                                <td><?= $row->nomor_nc; ?></td>
                                                <td><?= $row->tanggal; ?></td>
                                                <td><?= $row->uraian_temuan; ?></td>
                                                <td><?= $row->type_nc; ?></td>
                                                <td><?= $row->pekerjaan; ?></td>
                                                <td><span class="<?= $class?>"><?= $row->status_nc ?></span></td>
                                                <td>
                                                    <a href="<?= site_url('nc/edit_nc/'.$row->id); ?>"><span class="material-icons-round text-success">edit</span></a> 
                                                    <a href="#"><span class="material-icons-round text-info">visibility</span></a> 
                                                </td>
                                            </tr>

                                        <?php } }
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
    



    <script>

        var data_open = <?php echo $open; ?>;
        var data_close = <?php echo $close; ?>;

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                'Bulan Lalu',
                'Bulan Ini',
                's.d Bulan Ini'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
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
                name: 'Open',
                data: data_open
            },{
                name: 'Closed',
                data: data_close

            }]
        });
    </script>


    <?php
        /* Mengambil query report*/
        foreach($closed as $result){
            $bulan[] = $result->bulan; //ambil bulan
            $value[] = (float) $result->total; //ambil nilai
        }
        /* end mengambil query*/
         
    ?>

    <script>
        Highcharts.chart('containers', {
            chart: {
                type: 'line'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                //categories: /* <?php echo json_encode($bulan);?> */
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Closed NC',
                // data: [0, 78, 82, 100, 0, 0, 0, 0, 0, 0, 0, 0]
                data: <?php echo json_encode($value);?>
            }]
        });
    </script>

    <script>

        var data_open = <?php echo $open; ?>;
        var data_close = <?php echo $close; ?>;

        Highcharts.chart('containerss', {
          chart: {
            type: 'column'
          },
          title: {
            text: ''
          },
          xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
          },
          yAxis: {
            min: 0,
            title: {
              text: ''
            },
            stackLabels: {
              enabled: true,
              style: {
                fontWeight: 'bold',
                color: ( // theme
                  Highcharts.defaultOptions.title.style &&
                  Highcharts.defaultOptions.title.style.color
                ) || 'gray'
              }
            }
          },
          legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
          },
          tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
          },
          plotOptions: {
            column: {
              stacking: 'normal',
              dataLabels: {
                enabled: true
              }
            }
          },
          series: [{
            name: 'Open',
            data: data_open
            // data: [0, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0]
          }, {
            name: 'Closed',
            data: data_close
            // data: [0, 0, 3, 4, 6, 6, 6, 2, 3, 5, 2, 11]
          }]
        });

    </script>