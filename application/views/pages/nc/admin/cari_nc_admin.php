<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">Evaluasi</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">NC</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">

            <div class="row mt-4 gap-m-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Laporan Potensi Masalah</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            
                          <form class="container-fluid">
                            <div class="row mb-2">
                                <div class="form-group col-md-6">
                                    <label>Pilih Type NC</label>
                                    <select class="form-select">
                                        <option>--Pilih--</option>
                                      <?php foreach ($type_nc as $r) { ?>
                                          <option value="<?= $r->id; ?>"><?= $r->type_nc ?></option>    
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                              <div class="form-group col-md-6">
                                  <label>Tanggal</label>
                                  <input type="date" class="form-control" value="">
                              </div>
                              <div class="form-group col-md-6">
                                  <label>Level</label>
                                  <select class="form-control" value="">
                                      <option>--Pilih--</option>
                                      <?php foreach ($level_nc as $r) { ?>
                                          <option value="<?= $r->id; ?>"><?= $r->level_nc ?></option>    
                                      <?php } ?>
                                  </select>
                              </div>
                            </div>
                            <div class="row mb-2">
                              <div class="form-group col-md-6">
                                  <label>Sumber NC</label>
                                  <select class="form-control" value="">
                                      <option>--Pilih--</option>
                                      <?php foreach ($sumber_nc as $r) { ?>
                                          <option value="<?= $r->id; ?>"><?= $r->sumber_nc ?></option>    
                                      <?php } ?>
                                  </select>
                              </div>

                              <div class="form-group col-md-6">
                                  <label>Disposisi</label>
                                  <select class="form-control" value="">
                                      <option>--Pilih--</option>
                                      <?php foreach ($disposisi as $r) { ?>
                                          <option value="<?= $r->id; ?>"><?= $r->disposisi ?></option>    
                                      <?php } ?>
                                  </select>
                              </div>

                            </div>
                            
                            <a href="#" role="button" class="btn btn-primary">Cari</a>
                          </form>

                          <div class="container-fluid mt-4">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Project a</th>
                                        <th>Type NC</th>
                                        <th>Tanggal</th>
                                        <th>Level</th>
                                        <th>Sumber NC</th>
                                        <th>Disposisi</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                      <?php
                                        foreach ($data_nc as $r) { ?>
                                          <tr>
                                            <td class="text-primary fw-bolder">1</td>
                                        <td><?= $r->nama_project; ?></td>
                                        <td><?= $r->type_nc; ?></td>
                                        <td><?= $r->tanggal; ?></td>
                                        <td><?= $r->level_nc; ?></td>
                                        <td><?= $r->sumber_nc; ?></td>
                                        <td><?= $r->disposisi_pm; ?></td>
                                        <td class="text-center"><a href="<?= site_url('cari_nc_detail');?>"><span class="material-icons-round text-success">search</span></a> </td>
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

            <div class="row mt-4 gap-m-2">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body subtitle overflow-auto p-4">
                    <div id="charthasil"></div>
                  </div>
                </div>
              </div>
            </div>
        
        </div>
        <!-- End Content -->


    <script>
      Highcharts.chart('charthasil', {
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
            'Berlubang/ Robek',
            'Bocor/ tidak rapat',
            'Cold Joint',
            'Geripis',
            'Honeycomp/Keropos',
            'Kotor',
            'Miring',
            'Permukaan tidak rata',
            'Retak',
            'Rusak/ cacat',
            'Sambungan tidak rata',
            'Sattle/ landslide/ Longsor',
            'Tidak berfungsi',
            'Tidak Kokoh',
            'Tidak Lurus',
            'Tidak Merata/ Tidak Seragam',
            'Tidak padat',
            'Tidak sesuai Shop Drawing',
            'Tidak sesuai spesifikasi',
            'Tidak sesuai WMS'
          ],
          crosshair: true
        },
        yAxis: {
          min: 0,
          title: {
            text: ''
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
          name: 'Result',
          data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4, 20, 10, 52, 82, 12.3, 102, 10, 20]

        }]
      });
    </script>