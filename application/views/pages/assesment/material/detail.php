
<style type="text/css">
    .nopadding {
        padding: 0 !important;
    }
    .content {
        padding: 20px;
    }
    .hiddenRow {
        padding: 0 !important;
    }
</style>

    <!-- Content -->
    <div class="wrapper dashboard-page">
        <div class="page-title">
            <h5 class="fw-bolder">Assessment Material Detail</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Assessment Material Detail</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="subtitle fw-bolder">Kode Proyek : <?= $kode_project; ?></span>
                            <span class="title fw-bolder"><strong><?= $this->session->userdata('nama_project'); ?></strong></span>
                            <span class="subtitle fw-bolder"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#frm_assesment">Tambah</button></span>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="fw-bolder">Nama Pekerjaan</th>
                                                <th class="fw-bolder">Total Sampling</th>
                                                <th class="fw-bolder">Nilai</th>
                                                <th class="fw-bolder"><center>Aksi</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $jml_data=0;
                                            $grand_total=0;
                                            $prosentase_total =0;

                                            foreach ($assesment as $a) { 
                                                $nilai = (($a->sum_nilai_pekerjaan - $a->sum_nc_pekerjaan) / $a->sum_nilai_pekerjaan) *100;

                                                $grand_total += $a->sum_koreksi;
                                                $jml_data++;
                                                $prosentase_total += ($a->sum_koreksi/$a->jumlah); 
                                                ?>
                                            <tr>
                                                <td class="text-primary fw-bolder"><?= $a->nama_pekerjaan?></td>
                                                <td ><?= $a->sum_nilai_pekerjaan?></td>
                                                <!--
                                                <td ><?= $a->sum_koreksi?></td>
                                                -->
                                                <td ><?= ($a->sum_koreksi/$a->jumlah)?>%</td>
                                                <td class="text-center"><a href="<?= site_url('material_edit/'.$a->pekerjaan_id);?>"><span class="material-icons-round text-success">edit</span></a><a href="<?= site_url('assesment/hapus_material/'.$a->id);?>"><span class="material-icons-round text-danger ms-3">delete</span></a>
                                                     <a data-bs-toggle="collapse" href="#tampil<?= $a->id?>">
                                                    <span class="material-icons-round text-default ms-3">visibility</span></a>
                                                </td>
                                            </tr>

                                            
                                            <?php
                                                $hasil = $this->db->get_where('tr_assesment_material', array('pekerjaan_id'=>$a->pekerjaan_id))->result();
                                                foreach ($hasil as $data) { ?>
                                                    <tr>
                                                        <td class="hiddenRow" colspan="5">
                                                            <div id="tampil<?= $a->id?>" class="collapse">
                                                                <table class="table-striped" style="width:100%;" >
                                                                    
                                                                    <tbody>
                                                                        <tr>
                                                                        <td style="padding-left: 20px;" width="50%"><?= $data->nama_supplier; ?></td>
                                                                        <td width="10%"><?= $data->satuan_pekerjaan?></td>
                                                                        <td width="10%"><?= $data->nilai_pekerjaan; ?></td>
                                                                        <td width="10%"><?= $data->nc_pekerjaan; ?></td>
                                                                        <td width="20%">&nbsp;</td>
                                                                    </tr>
                                                                    </tbody>
                                                                    
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            ?>
                                            <?php } ?>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td class="text-primary fw-bolder" colspan="2">TOTAL KESELURUHAN</td>
                                                <td class="text-primary fw-bolder"><?= ($prosentase_total/$jml_data); ?>%</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Content -->

        <!-- Modal -->
        <div class="modal fade" id="frm_assesment" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel">
            <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">

                <span class="subtitle fw-bolder">Kode Proyek : <?= $kode_project; ?></span>
                <span class="subtitle fw-bolder px-2"><strong><?= $this->session->userdata('nama_project'); ?></strong></span>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form name="f_assesment_s" id="f_assesment_s" onsubmit="return assesment_material_s();">
                        <div class="row">

                            <input type="hidden" id="<?=$this->security->get_csrf_token_name();?>" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">

                            <div class="form-group col-md-12">
                                <label>Pekerjaan</label>
                                <select name="nama_pekerjaan" class="form-control">
                                    <option selected>--Pilih--</option>
                                     <?php foreach ($pekerjaan as $r) { ?>
                                        <option value="<?= $r->id?>"><?= $r->pekerjaan ?></option>    
                                    <?php } ?>
                                </select>

                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Supplier</label>
                                <select name="nama_vendor" class="form-control" >
                                    <option selected>--Pilih--</option>
                                     <?php foreach ($supplier as $r) { ?>
                                        <option value="<?= $r->id?>"><?= $r->nama_supplier ?></option>    
                                    <?php } ?>
                                </select>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Satuan</label>
                                <input name="satuan_pekerjaan" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Nilai</label>
                                <input name="nilai_pekerjaan" type="text" class="form-control">
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>NC</label>
                                <input name="nc_pekerjaan" type="text" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
                </form>
            </div>
            </div>
        </div>
