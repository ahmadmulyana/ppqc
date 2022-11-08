  <script src="<?= base_url() ?>assets/js/modules/highcharts/highcharts.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/sunburst.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/exporting.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/export-data.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/accessibility.js"></script>
    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder"><a href="<?= site_url('list_laporan');?>"><i class="fas fa-chevron-left mr-3"></i></a> <?= $nama_project; ?></h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">NC</li>
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
                                <div class="col text-center forh4"><?= $nama_project; ?> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Sampai Dengan Bulan Ini</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div id="container"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Bulan Ini</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div id="containers"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Presentasi NC Ditinjau Dari Type NC</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div id="grafik_pie"></div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- End Content -->

     <?php
        $default=0;
        $project_id = $this->session->userdata('project_id');
        $januari = date( 'Y' ) . '-01-01';
        foreach($type_nc as $result){
            $type[] = $result->type_nc; 

            $where = array(
              'type_nc'=>$result->type_nc, 
              'project_id' => $project_id,
              'tanggal >=' => $januari,
              'tanggal <=' => date('Y-m-d')
            );

            $cekTotal = $this->db->get_where('tr_nc', $where)->num_rows();
            if ($cekTotal==0){
              $value[] = (float) $default; 
            }else{
              $value[] = (float) $cekTotal; 
            }

            $where = array(
              'type_nc'=>$result->type_nc, 
              'project_id' => $project_id,
              'MONTH(tanggal)' => date('m'),
              'YEAR(tanggal)' => date('Y')
            );

            $cekTotal = $this->db->get_where('tr_nc', $where)->num_rows();
            if ($cekTotal==0){
              $value_bulan_berjalan[] = (float) $default; 
            }else{
              $value_bulan_berjalan[] = (float) $cekTotal; 
            }

            $messages[] = array(
                  'name' => $result->type_nc,
                  'y' => (float) $cekTotal
            );
        }
         
    ?>

    

    <script>
       Highcharts.chart('container', {
          chart: {
            type: 'bar'
          },
          title: {
            text: ''
          },
          subtitle: {
            text: ''
          },
          xAxis: {
            categories: <?= json_encode($type); ?>,
          },
          plotOptions: {
            bar: {
              dataLabels: {
                enabled: true
              }
            }
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
          },
          credits: {
            enabled: false
          },
          series: [{
            name: '<?= date("Y");?>',
            data: <?= json_encode($value); ?>
          }]
        });

       Highcharts.chart('containers', {
          chart: {
            type: 'bar'
          },
          title: {
            text: ''
          },
          subtitle: {
            text: ''
          },
          xAxis: {
            categories: <?= json_encode($type); ?>,
            title: {
              text: null
            }
          },

          /*
          yAxis: {
              tickAmount:5,
              min: 0,
              title: {
                  text: 'Population (millions)',
                  align: 'high'
              },
              labels: {
                  overflow: 'justify',
                  formatter: function () {
                      var label = this.axis.defaultLabelFormatter.call(this);
                      if (/^[0-9]{4}$/.test(label)) {
                          return Highcharts.numberFormat(this.value, 0);
                      }
                      return label;
                  }
              }
          },
           xAxis: {
        labels: {
            formatter: function () {
                var label = this.axis.defaultLabelFormatter.call(this);

                // Use thousands separator for four-digit numbers too
                if (/^[0-9]{4}$/.test(label)) {
                    return Highcharts.numberFormat(this.value, 0);
                }
                return label;
            }
        }
    },*/

          plotOptions: {
            bar: {
              dataLabels: {
                enabled: true
              }
            }
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
          },
          credits: {
            enabled: false
          },
          series: [{
            name: '<?= date("Y");?>',
            data: <?= json_encode($value_bulan_berjalan); ?>
          }]
        });

        <?php
          $messages3 = array();
          for ($i = 1; $i <= 12; $i++){
              $messages3[] = array(
                  'name' => 'Bahan_'.$i,
                  'data' => $i,
              );
          }

          $rest = $this->db->query("SELECT type_nc, count(type_nc) as total FROM tr_nc WHERE type_nc is  NOT NULL group by type_nc");

          foreach ($rest->result() as $r) {
              $name[] = $r->type_nc;
              $data[] = (float) $r->total;
              $color[] = true;
/*
              $messages[] = array(
                  'name' => $r->type_nc,
                  'y' => (float) $r->total
              );*/
          }

          /*
          for ($i = 1; $i <= 12; $i++){
              $name[] = $i;
              $data[] = $i;
          }*/

          $messages1 = array('name' => $name, 'data' => $data, 'sliced' => $color);


        ?>

        Highcharts.chart('grafik_pie', {
          chart: {
            type: 'pie'
          },
          title: {
            text: ''
          },
          subtitle: {
            text: ''
          },

          xAxis: {
            categories: <?php echo json_encode($type); ?>,
            labels: {
             style: {
              fontSize: '10px',
              fontFamily: 'Verdana, sans-serif'
             }
            }
           },

          accessibility: {
            announceNewData: {
              enabled: true
            },
            point: {
              valueSuffix: '%'
            }
          },

          plotOptions: {
            series: {
              dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y}'
              }
            }
          },

          tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
          },

          series: [
            { data: <?= json_encode($messages) ?>}
          ]
          
        });
    </script>