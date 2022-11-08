  <script src="<?= base_url() ?>assets/js/modules/highcharts/highcharts.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/sunburst.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/exporting.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/export-data.js"></script>
  <script src="<?= base_url() ?>assets/js/modules/highcharts/accessibility.js"></script>

    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <div class="form-group fortitlenc" style="width: 500px;">
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
              <?= tgl_indo(date('Y-m-d')); ?>
            </nav>
        </div>
        
        <div class="content-wrapper">
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Sampai Dengan Bulan Ini</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div id="grafik_sampai_bulan"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Bulan Ini</span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div id="grafik_bulan_ini"></div>
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


        ?>

        



