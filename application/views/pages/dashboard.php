    <!-- Content -->
    <div class="wrapper dashboard-page">
        <div class="page-title">
            <h5 class="fw-bolder">Dashboard</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard </li>
                </ol>
                <?= $tanggal = tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
            <div class="row gap-m-2">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="mapid" style="height: 400px"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="p-4 quality-css">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Quality Achievment</h3>
                                </div>
                                <div class="col-md-6 p-2">
                                    <div class="bgblue m-auto text-center p-4">
                                        Assessment
                                        <h5>91.50</h5>
                                    </div>
                                </div>
                                <div class="col-md-6 p-2">
                                    <div class="bgblue m-auto text-center p-4">
                                        QSIA
                                        <h5>90.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h3>Customer Satisfaction Survey</h3>
                                </div>
                                <div class="col-md-6 p-2">
                                    <div class="bgyellow m-auto text-center p-4">
                                        50%
                                        <h5>82.57</h5>
                                    </div>
                                </div>
                                <div class="col-md-6 p-2">
                                    <div class="bgblue m-auto text-center p-4">
                                        100%
                                        <h5>98.45</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="p-4 potensi">
                            <h3>Potensi</h3>
                            <table class="table table-responsive w-100">
                                <thead>
                                    <tr>
                                        <th colspan="3">Nama Pekerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Jalan Kawasan Industri Batang 14</td>
                                        <td><span class="alert alert-danger" role="alert">80%</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jalan Kawasan Industri Batang 14</td>
                                        <td><span class="alert alert-danger" role="alert">80%</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Jalan Kawasan Industri Batang 14</td>
                                        <td><span class="alert alert-warning" role="alert">80%</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Jalan Kawasan Industri Batang 14</td>
                                        <td><span class="alert alert-success" role="alert">80%</span></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Jalan Kawasan Industri Batang 14</td>
                                        <td><span class="alert alert-success" role="alert">80%</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="p-4 quality-css">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Non Conformance</h3>
                                </div>
                                <div class="col-md-12 p-2">
                                    <div class="bgblue m-auto text-center p-3">
                                        <div class="row">
                                            <div class="col-md-4 m-auto">Close</div>
                                            <div class="col-md-4 m-auto"><h2><?= $totalNCClose; ?></h2></div>
                                            <div class="col-md-4 m-auto"><span class="alert alert-success" role="alert"><?= round(($totalNCClose * 100)/$totalNC) ; ?>%</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 p-2">
                                    <div class="bgblue m-auto text-center p-3">
                                        <div class="row">
                                            <div class="col-md-4 m-auto">Open</div>
                                            <div class="col-md-4 m-auto"><h2><?= $totalNCOpen; ?></h2></div>
                                            <div class="col-md-4 m-auto"><span class="alert alert-danger" role="alert"><?= round(($totalNCOpen * 100)/$totalNC) ; ?> %</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 p-2">
                                    <div class="bgblue m-auto text-center p-3">
                                        <div class="row">
                                            <div class="col-md-4 m-auto">Total</div>
                                            <div class="col-md-4 m-auto"><h2><?= $totalNC; ?></h2></div>
                                            <div class="col-md-4 m-auto"><span class="alert alert-warning" role="alert"><?= round(($totalNC * 100)/$totalNC) ; ?>%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="inspeksi">
                                    <h3>This Week</h3>
                                    <table class="table table-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Nama Pekerjaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            if ($proyekWeek){
                                                foreach ($proyekWeek as $r) { ?>
                                                <tr>
                                                    <td class="text-primary">1</td>
                                                    <td><?= $r->nama_proyek?> <br> <span><?= tgl_indo($r->periode_start_date); ?></span> - <?= $r->owner; ?> </td>
                                                </tr>
                                                <?php $no++; }
                                            }else{
                                                echo "<tr><td colspan='2'>Tidak ada data</td></tr>";
                                            }
                                            
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="inspeksi">
                                    <h3>Next Week</h3>
                                    <table class="table table-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Nama Pekerjaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no=1;
                                            if ($proyekWeek){
                                                foreach ($proyekWeek as $r) { ?>
                                                <tr>
                                                    <td class="text-primary">1</td>
                                                    <td><?= $r->nama_proyek?> <br> <span><?= tgl_indo($r->periode_start_date); ?></span> - <?= $r->owner; ?> </td>
                                                </tr>
                                                <?php $no++; }
                                            }else{
                                                echo "<tr><td>Tidak ada data</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inspeksi">
                                    <h3>CSS On Going</h3>
                                    <table class="table table-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Nama Pekerjaan</th>
                                                <th>Keadaan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-primary">1</td>
                                                <td>Jalan Kendari - Toronipa Tahap 2 <br> <span>12 November 2021</span> - MWT Biro QHSE</td>
                                                <td class="text-primary">(45.56%)</td>
                                                <td class="text-primary">+12 hr</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">2</td>
                                                <td>Jalan Kendari - Toronipa Tahap 2 <br> <span>12 November 2021</span> - MWT Biro QHSE</td>
                                                <td class="text-primary"><span class="alert alert-danger">(100%)</span></td>
                                                <td class="text-primary">+5 hr</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">3</td>
                                                <td>Jalan Kendari - Toronipa Tahap 2 <br> <span>12 November 2021</span> - MWT Biro QHSE</td>
                                                <td class="text-primary">(45.56%)</td>
                                                <td class="text-primary">+12 hr</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">4</td>
                                                <td>Jalan Kendari - Toronipa Tahap 2 <br> <span>12 November 2021</span> - MWT Biro QHSE</td>
                                                <td class="text-primary"><span class="alert alert-danger">(56.32%)</span></td>
                                                <td class="text-primary">Belum diajukan</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">5</td>
                                                <td>Jalan Kendari - Toronipa Tahap 2 <br> <span>12 November 2021</span> - MWT Biro QHSE</td>
                                                <td class="text-primary">(56.32%)</td>
                                                <td class="text-primary">Belum diajukan</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-4 inspeksi">
                                    <h3>Mobile Inspeksi</h3>
                                    <table class="table table-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Nama Pekerjaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                                $no=1;
                                                foreach ($inspeksi as $row) { ?>
                                                    <tr>
                                                        <td class="text-primary"><?= $no; ?></td>
                                                        <td class="text-primary"><?= $row->keterangan; ?></td>
                                                        <td class="text-primary"><?= $no; ?></td>
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
            </div>
        
        </div>
        <!-- End Content -->
