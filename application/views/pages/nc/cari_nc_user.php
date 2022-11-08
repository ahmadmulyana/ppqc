  <script src="<?= base_url() ?>assets/js/modules/highcharts/highcharts.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/sunburst.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/exporting.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/export-data.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/accessibility.js"></script>

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
            <input type="hidden" id="<?=$this->security->get_csrf_token_name();?>" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
            <div class="row mt-4 gap-m-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Laporan Potensi Masalah</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                          <div class="container-fluid mt-4">
                            <div class="row mb-2">
                                <div class="form-group col-md-6">
                                    <label>Pilih Type NC</label>
                                    <select id="type_nc" name="type_nc" class="form-select">
                                        <option value="" selected>--Pilih--</option>
                                        <?php foreach ($type_nc as $r) { ?>
                                              <option><?= $r->type_nc ?></option>    
                                          <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                              <div class="form-group col-md-3">
                                  <label>Tanggal Awal</label>
                                  <input id="tanggal_awal" type="date" class="form-control" value="">
                              </div>
                              <div class="form-group col-md-3">
                                  <label>Tanggal Akhir</label>
                                  <input id="tanggal_akhir" type="date" class="form-control" value="">
                              </div>
                              <div class="form-group col-md-6">
                                  <label>Level</label>
                                  <select id="level_nc" name="level_nc" class="form-control" >
                                    <option value="" selected>--Pilih--</option>
                                      <?php foreach ($level_nc as $r) { ?>
                                          <option><?= $r->level_nc ?></option>    
                                      <?php } ?>
                                  </select>
                              </div>
                            </div>
                            <div class="row mb-2">
                              <div class="form-group col-md-6">
                                  <label>Sumber NC</label>
                                  <select id="sumber_nc" name="sumber_nc" class="form-control" >
                                    <option value="" selected>--Pilih--</option>
                                      <?php foreach ($sumber_nc as $r) { ?>
                                          <option><?= $r->sumber_nc ?></option>    
                                      <?php } ?>
                                  </select>
                              </div>
                              <div class="form-group col-md-6">
                                  <label>Disposisi</label>
                                  <select id="disposisi" name="disposisi" class="form-control">
                                    <option value="" selected>--Pilih--</option>
                                      <?php foreach ($disposisi as $r) { ?>
                                          <option><?= $r->disposisi ?></option>    
                                      <?php } ?>
                                  </select>
                              </div>
                            </div>
                            <div style="margin-top: 20px;">
                              <button id="btnCari" class="btn btn-primary" > <span class="material-icons-round">search</span> Cari </button>
                            <a class="btn btn-danger" href="<?= site_url('nc/cari_nc_detail/'.$this->session->userdata('project_id')); ?>"><span class="material-icons-round">pie_chart</span> Lihat Grafik</a> 
                            </div>
                            
                          </div>
                          <div class="container-fluid mt-4">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Project A</th>
                                        <th>Type NC</th>
                                        <th>Tanggal</th>
                                        <th>Level</th>
                                        <th>Sumber NC</th>
                                        <th>Disposisi</th>
                                    </tr>
                                </thead>
                                <tbody id="isi">
                                  <?php
                                  $no=1;
                                    foreach ($data_nc as $r) { ?>
                                      <tr>
                                        <td class="text-primary fw-bolder"><?= $no; ?></td>
                                        <td><?= $r->nama_project; ?></td>
                                        <td><?= $r->type_nc; ?></td>
                                        <td><?= $r->tanggal; ?></td>
                                        <td><?= $r->level_nc; ?></td>
                                        <td><?= $r->sumber_nc; ?></td>
                                        <td><?= $r->disposisi_pm; ?></td>
                                    </tr>
                                    <?php $no++; }
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


    <?php
        /* Mengambil query report*/
        if (!empty($grafik)){
          $default=0;
          $project_id = $this->session->userdata('project_id');
            foreach($grafik as $result){
                $label[] = $result->type_nc; //ambil bulan
                $cekTotal = $this->db->get_where('tr_nc', array('type_nc'=>$result->type_nc, 'project_id' => $project_id))->num_rows();
                if ($cekTotal==0){
                  $value[] = (float) $default; //ambil nilai
                }else{
                  $value[] = (float) $cekTotal; //ambil nilai
                }
            }
        }
        /* end mengambil query*/
    ?>

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
          categories: <?php echo json_encode($label);?>,
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
          name: 'Jumlah',
          data: <?php echo json_encode($value);?>

        }]
      });
    </script>