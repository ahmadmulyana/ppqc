    <script src="<?= base_url() ?>assets/js/modules/highcharts/highcharts.js"></script>

    <script src="<?= base_url() ?>assets/js/modules/highcharts/exporting.js"></script>
    <script src="<?= base_url() ?>assets/js/modules/highcharts/export-data.js"></script>
    <script src="<?= base_url() ?>assets/js/modules/highcharts/accessibility.js"></script>

    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">Customer Satisfaction Survey</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">CSS</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
          <div class="row gap-m-2 mb-4">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header">
                          <span class="subtitle fw-bolder">List Project</span>
                      </div>
                      <div class="card-body subtitle overflow-auto p-4">
                          <table id="exampletype" class="table table-striped" style="width:100%">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Kode Proyek</th>
                                      <th>Nama Proyek</th>
                                      <th class="text-center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>

                                  <?php $no=1; foreach ($project as $r) { ?>
                                      <tr>
                                          <td class="text-primary fw-bolder"><?= $no; ?></td>
                                          <td><?= $r->kode_proyek; ?></td>
                                          <td><?= $r->nama_proyek; ?></td>
                                          <td class="text-center"><a href="<?= site_url('css/detail/'.$r->id);?>"><span class="material-icons-round text-success">edit</span></a> </td>
                                      </tr>
                                  <?php $no++; }  ?>
                                  
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
       
          <?php if ($this->session->userdata('admin_level') == "3") { ?>   
          <div class="row gap-m-2 mb-4">
              <div class="col-md-6">
                 <div class="card">
                      <div class="card-body subtitle overflow-auto p-4">
                          <div id="grafik_css_50"></div>
                      </div>
                  </div>
              </div>

              <div class="col-md-6">
                 <div class="card">
                      <div class="card-body subtitle overflow-auto p-4">
                          <div id="grafik_css_100"></div>
                      </div>
                  </div>
              </div>

          </div>

        <?php } ?>
        </div>
        <!-- End Content -->