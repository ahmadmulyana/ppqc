<script src="<?= base_url() ?>assets/js/modules/highcharts/highcharts.js"></script>
<script src="<?= base_url() ?>assets/js/modules/highcharts/series-label.js"></script>
<script src="<?= base_url() ?>assets/js/modules/highcharts/exporting.js"></script>
<script src="<?= base_url() ?>assets/js/modules/highcharts/export-data.js"></script>
<script src="<?= base_url() ?>assets/js/modules/highcharts/accessibility.js"></script>

<style type="text/css">
.edit{
    width: 100%;
    height: 25px;
}
.editMode{
    /*border: 1px solid black;*/
}
.txtedit{
    display: none;
    width: 99%;
    height: 30px;
}

.edit_100{
    width: 100%;
    height: 25px;
}

.txtedit_100{
    display: none;
    width: 99%;
    height: 30px;
}

</style>

    <!-- Content -->
    <div class="wrapper css-page">
        <input type="hidden" id="project_id" value="<?= $this->session->userdata('project_id'); ?>">
        <div class="page-title">
            <h5 class="fw-bolder">Customer Satisfaction Survey</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item">CSS</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <?php

            $tgl_sekarang = date('Y-m-d');
            $d=strtotime($hari);
            $hari = date('Y-m-d', $d);

            $tgl1 = new DateTime($hari);
            $tgl2 = new DateTime($tgl_sekarang);
            $d = $tgl2->diff($tgl1)->days;

            $keterangan = "+ ".$d." Hari (Belum Isi)";


        ?>
        <div class="content-wrapper">
            <input type="hidden" name="progress" id="progress" value="<?= $progress; ?>">
            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card card-blue">
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col text-left forh1"><?= $progress =='' ? '0 %' : $progress; ?></div>
                                <div class="col text-center forh4"> <?= $progress <=50 ? 'Silahkan Isi CSS 50%' : 'Silahkan Isi CSS 100%' ?> </div>
                                <div class="col text-right forh4"><?= $d==0 ? '' : $keterangan; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="<?=$this->security->get_csrf_token_name();?>" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header w-100">
                            <div class="row w-100">
                                <div class="col-md-6">
                                    <span class="subtitle fw-bolder">List Item Survey</span>
                                </div>
                                <div class="col-md-6 text-right">

                                    <?php

                                    if ($this->session->userdata('admin_level') == "3") { 
                                    if ($progress >=49) { ?>
                                        <a data-bs-toggle="modal" data-bs-target="#areapekerjaannc" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Upload</a>
                                    <?php } else { ?>
                                        <a data-bs-toggle="modal" data-bs-target="#areapekerjaannc" style="cursor: pointer;" class="btn btn-primary disabled"><i class="fas fa-plus"></i> Upload</a>
                                    <?php } } ?>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="areapekerjaannc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Upload Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form action="" enctype="multipart/form-data" id="modal_form_id" method="POST" >

                                                    <input type="text" name="type_css" id="type_css" value="<?= $progress >=50 ? '2' : '1'; ?>">

                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>File</label>
                                                            <input id="file" type="file" class="form-control" name="file">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-1">
                                                            <a href="#" onclick="return uploadCSS(0);" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <table class="table table-striped" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Pengajuan CSS</th>
                                                <th>Tanggal Upload</th>
                                                <th>Nilai CSS</th>
                                                <th>Tanggal Upload</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $i = 1;
                                                foreach ($files as $r) { ?>
                                                <tr>
                                                    <td><?= $i++ ;?></td> 
                                                    <td><?= $r->type_css=='1' ? 'CSS 50%' : 'CSS 100%' ?></td>
                                                    <td>
                                                        <?php if ($r->files=="") { ?>
                                                            <a data-bs-toggle="modal" data-bs-target="#areapekerjaannc" style="cursor: pointer;" class="btn btn-primary btn-sm"><i class="fas fa-upload"></i> Upload</a>
                                                        <?php } else {?>
                                                        <a class="btn btn-success btn-sm" href="<?= base_url('uploads/css/').$r->files; ?>" target="_blank"> <i class="fas fa-download"></i> Download
                                                        </a>
                                                    <?php }?>
                                                    </td>
                                                    <td><?= $r->tanggal ?></td>
                                                    <td>
                                                        <?php if ($r->files_nilai=="") { ?>
                                                            <a data-bs-toggle="modal" data-bs-target="#areapekerjaannc" style="cursor: pointer;" class="btn btn-primary btn-sm"><i class="fas fa-upload"></i> Upload</a>
                                                        <?php } else {?>
                                                        <a class="btn btn-success btn-sm" href="<?= base_url('uploads/css/').$r->files_nilai; ?>" target="_blank" >
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                        <?php }?>
                                                    </td>
                                                    <td><?= $r->tanggal_nilai ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Survey</th>
                                                <th width='20%'>CSS 50%</th>
                                                <th width='20%'>CSS 100%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $count =1;
                                                foreach ($survey as $a) { ?>
                                                    <tr>
                                                        <td><?= $count; ?></td>
                                                        <td> 
                                                            <?= $a->survey; ?>
                                                        </td>

                                                        <td> 
                                                            <div class="edit_50 text-center" style="background-color:  #0cadd1 "> <?= $a->nilai50; ?> </div> 
                                                            <input type="text" class="txtedit" value="<?= $a->nilai50; ?>" id="nilai50_<?= $a->id; ?>" >
                                                        </td>

                                                        <td> 
                                                            <div class="edit_100 text-center" style="background-color:  #0cd1c5 "> <?= $a->nilai100; ?> </div> 
                                                            <input type="text" class="txtedit_100" value="<?= $a->nilai100; ?>" id="nilai100_<?= $a->id; ?>" >
                                                        </td>

                                                    </tr>
                                                <?php $count++; } ?>
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
                                <div id="containers"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Content -->