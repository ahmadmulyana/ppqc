  <script src="<?= base_url() ?>assets/js/modules/highcharts/highcharts.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/sunburst.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/exporting.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/export-data.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/accessibility.js"></script>

    <?php
      $project_id = $this->session->userdata('project_id');

      foreach ($sumber_nc as $r) {
          $sql= "SELECT sumber_nc FROM tr_nc WHERE sumber_nc='".$r->sumber_nc."' AND project_id='".$project_id."'";
          $jumlah = $this->db->query($sql)->num_rows();
          if ($jumlah >= 0){
            $nilai_sumber[] = (float) $jumlah;
          }else{
            $nilai_sumber[] = 0;
          }
          $nama_sumber[] = $r->sumber_nc;

          $data_sumber[] = array(
                  'name' => $r->sumber_nc,
                  'y' => (float) $jumlah
            );

      }
    ?>

    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder"><a href="<?= site_url('cari_nc');?>"><i class="fas fa-chevron-left mr-3"></i></a> Detail</h5>
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
                  <div class="card-body subtitle overflow-auto p-4">
                    <div id="grafik_bocal"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Level NC</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div id="grafik_level"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Disposisi</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div id="grafik_disposisi"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Sumber NC</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div id="grafik_sumber_nc"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Total Sumber NC</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table class="table-bordered">
                                <tr>
                                    <th>Pek. Vendor</th>
                                    <th>Pek. Internal</th>
                                    <th>Cust. Complain</th>
                                    <th>Material SBO</th>
                                </tr>
                                <tr>
                                    <td><?= $nilai_sumber[0]; ?></td>
                                    <td><?= $nilai_sumber[1]; ?></td>
                                    <td><?= $nilai_sumber[2]; ?></td>
                                    <td><?= $nilai_sumber[3]; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->

        <?php
          $messages = array();
          /*
          for ($i = 1; $i <= 12; $i++){
              $messages[] = array(
                  'name' => 'Bahan_'.$i,
                  'y' => $i,
              );
          }*/

          $bocal = array("Bahan", "Orang", "Cara", "Alat");

          $project_id = $this->session->userdata('project_id');
          
          foreach ($bocal as $r) {
              $sql= "SELECT COUNT($r) AS total FROM tr_nc WHERE $r <>'-' AND project_id='".$project_id."'";
              $jumlah = $this->db->query($sql)->row()->total;
              $messages[] = array(
                  'name' => $r,
                  'y' => (float) $jumlah,
              );
          }
        ?>

    

    <?php
      $project_id = $this->session->userdata('project_id');

      foreach ($level_nc as $r) {
          $sql= "SELECT level_nc FROM tr_nc WHERE level_nc='".$r->level_nc."' AND project_id='".$project_id."'";
          $jumlah = $this->db->query($sql)->num_rows();
          if ($jumlah >= 0){
            $nilai[] = (float) $jumlah;
          }else{
            $nilai[] = 0;
          }
          $level[] = $r->level_nc;

      }
    ?>
    <script>
      Highcharts.chart('grafik_level', {
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
          categories: 
            <?= json_encode($level)?>
          ,
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
          name: 'Total',
          data: <?= json_encode($nilai); ?>
        }]
      });
    </script>

    <?php
      $project_id = $this->session->userdata('project_id');

      foreach ($disposisi as $r) {
          $sql= "SELECT disposisi_pm FROM tr_nc WHERE disposisi_pm='".$r->disposisi."' AND project_id='".$project_id."'";
          $jumlah = $this->db->query($sql)->num_rows();
          if ($jumlah >= 0){
            $nilai_disposisi[] = (float) $jumlah;
          }else{
            $nilai_disposisi[] = 0;
          }
          $categories[] = $r->disposisi;

      }
    ?>

    <script>
      Highcharts.chart('grafik_disposisi', {
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
          categories: <?= json_encode($categories)?>,
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
          name: 'Total',
          data: <?= json_encode($nilai_disposisi)?>

        }]
      });
    </script>

    <script>
      Highcharts.chart('grafik_sumber_nc', {
          chart: {
              type: 'pie'
          },
          title: {
              text: ''
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          accessibility: {
              point: {
                  valueSuffix: '%'
              }
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                  }
              }
          },
          series: [{
              name: 'Sumber NC',
              colorByPoint: true,
              data: <?= json_encode($data_sumber)?>
          }]
      });
  </script>


  <?php

      $Bahan = $this->db->get('m_bahan')->result_array();
      $nomor = 1000; 
      $id=1;

      $count = count($Bahan);

      $ulang=1;
      $ok ="";
      foreach ($Bahan as $row) {

        $jumlah = $this->db->get_where('tr_nc', array('bahan'=>$row['bahan']))->num_rows();

        if ($ulang== $count){
          $ok .= '{id:"'.$id++.'",parent:"1.1"'.',name:"'.$row['bahan'].'",value:'.intval($jumlah);  
        }else{
          $ok .= '{id:"'.$id++.'",parent:"1.1"'.',name:"'.$row['bahan'].'",value:'.intval($jumlah)."},";
        }
        $ulang++;
      }
      $ok .="}";


      /* Alat */
      $Alat = $this->db->get('m_alat')->result_array();
      $nomor = 1000; 
      $id=1;

      $count = count($Alat);

      $ulang=1;
      $alat_ok ="";
      foreach ($Alat as $row) {

        $jumlah = $this->db->get_where('tr_nc', array('alat'=>$row['alat']))->num_rows();

        if ($ulang == $count){
          $alat_ok .= '{id:"2.'.$id++.'",parent:"1.2"'.',name:"'.$row['alat'].'",value:'.intval($jumlah);  
        }else{
          $alat_ok .= '{id:"2.'.$id++.'",parent:"1.2"'.',name:"'.$row['alat'].'",value:'.intval($jumlah)."},";
        }
        $ulang++;
      }
      $alat_ok .="}";

      /* Orang */
      $Orang = $this->db->get('m_orang')->result_array();
      $id=1;
      $count = count($Orang);

      $ulang=1;
      $orang_ok ="";
      foreach ($Orang as $row) {

        $jumlah = $this->db->get_where('tr_nc', array('orang'=>$row['orang']))->num_rows();

        if ($ulang == $count){
          $orang_ok .= '{id:"3.'.$id++.'",parent:"1.3"'.',name:"'.$row['orang'].'",value:'.intval($jumlah);  
        }else{
          $orang_ok .= '{id:"3.'.$id++.'",parent:"1.3"'.',name:"'.$row['orang'].'",value:'.intval($jumlah)."},";
        }
        $ulang++;
      }
      $orang_ok .="}";


      /* Lingkungan */
      $Lingkungan = $this->db->get('m_lingkungan')->result_array();
      $id=1;
      $count = count($Lingkungan);

      $ulang=1;
      $lingkungan_ok ="";
      foreach ($Lingkungan as $row) {

        $jumlah = $this->db->get_where('tr_nc', array('lingkungan'=>$row['lingkungan']))->num_rows();

        if ($ulang == $count){
          $lingkungan_ok .= '{id:"4.'.$id++.'",parent:"1.4"'.',name:"'.$row['lingkungan'].'",value:'.intval($jumlah);  
        }else{
          $lingkungan_ok .= '{id:"4.'.$id++.'",parent:"1.4"'.',name:"'.$row['lingkungan'].'",value:'.intval($jumlah)."},";
        }
        $ulang++;
      }
      $lingkungan_ok .="}";

    ?>

    <script type="text/javascript">
      
    var data = [{
        id: '0.0',
        parent: '',
        name: 'BOCAL'
        }, {
            id: '1.1',
            parent: '0.0',
            name: 'Bahan'
        }, {
            id: '1.2',
            parent: '0.0',
            name: 'Alat'
        }, {
            id: '1.3',
            parent: '0.0',
            name: 'Orang'
        }, {
            id: '1.4',
            parent: '0.0',
            name: 'Lingkungan'
        }, 

        <?= $ok.","?>
        <?= $alat_ok.","?>
        <?= $orang_ok.","?>
        <?= $lingkungan_ok.","?>

  ];


    Highcharts.chart('grafik_bocal', {

        chart: {
            height: '60%'
        },

        colors: ['transparent'].concat(Highcharts.getOptions().colors),
        title: {
            text: 'Akar Masalah NC'
        },
        series: [{
            type: 'sunburst',
            data: data,
            name: 'root',
            allowDrillToNode: true,
            cursor: 'pointer',
            dataLabels: {
                format: '{point.name}',
                filter: {
                    property: 'innerArcLength',
                    operator: '>',
                    value: 16
                },
                rotationMode: 'circular'
            },
            levels: [{
                level: 1,
                levelIsConstant: false,
                dataLabels: {
                    filter: {
                        property: 'outerArcLength',
                        operator: '>',
                        value: 64
                    }
                }
            }, {
                level: 2,
                colorByPoint: true
            },
            {
                level: 3,
                colorVariation: {
                    key: 'brightness',
                    to: -0.5
                }
            }, {
                level: 4,
                colorVariation: {
                    key: 'brightness',
                    to: 0.5
                }
            }]

        }],

        tooltip: {
            headerFormat: '',
            pointFormat: 'Total <b>{point.name}</b> is <b>{point.value}</b>'
        }
    });

    </script>