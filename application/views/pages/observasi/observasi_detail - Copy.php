<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">Observasi</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Observasi</li>
                </ol>
                <?= tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
            <?php if($this->session->flashdata('msg_alert')) { ?>
              <div class="alert alert-danger">
                <label style="font-size: 13px;"><?=$this->session->flashdata('msg_alert');?></label>
              </div>
              <?php } ?>
            <div class="row gap-m-2">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body overflow-auto p-4">
                            <?=form_open('observasi/save', array('method'=>'post', 'class' => 'form-group')) ;?>
                                <input type="hidden" name="project_id" value="<?= $project_id?>" />
                                <div class="row mb-3">
                                    <div class="form-group col-md-6">
                                        <label>Item Pekerjaan</label>
                                        <select class="form-control" id="pekerjaan" name="pekerjaan">
                                            <option value="" disabled selected>-- Pilih -- </option>
                                            <?php foreach ($pekerjaan as $r) { ?>
                                            <option value="<?= $r->id; ?>"><?= $r->pekerjaan ?></option>    
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-6">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-12">
                                        <label>Dampak Masalah</label>
                                        <textarea class="form-control" rows="1" name="dampak_masalah"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-12">
                                        <label>Uraian Potensi Masalalah</label>
                                        <textarea class="form-control" rows="3" name="uraian_potensi_masalah"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="form-group col-md-3">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Submit"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body overflow-auto p-4">
                            <table class="table">
                                <th>Pekerjaan</th>
                                <th>Tanggal</th>
                                <th>Dampak Masalah</th>
                                <th>Uraian Potensi Masalah</th>
                                <th>Level</th>
                            <?php 
                            if ($observasi) {

                                foreach ($observasi as $r) { ?>
                            
                                    <tr>
                                        <td><?= $r->pekerjaan; ?></td>
                                        <td><?= $r->tanggal; ?></td>
                                        <td><?= $r->dampak_masalah; ?></td>
                                        <td><?= $r->uraian_potensi_masalah; ?></td>
                                    </tr>
                                        
                                    
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Item Pekerjaan</label>
                                        <textarea class="form-control" rows="2" readonly><?= $r->pekerjaan; ?></textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <textarea class="form-control" rows="2" readonly><?= $r->tanggal; ?></textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Dampak Masalah</label>
                                        <textarea class="form-control" rows="2" readonly><?= $r->dampak_masalah; ?></textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Uraian Potensi Masalah</label>
                                        <textarea class="form-control" rows="2" readonly><?= $r->uraian_potensi_masalah; ?></textarea>
                                    </div>
                                </div>
                                <!-- Penilaian = Khusus di admin -->

                                <?php if ($this->session->userdata('admin_level') =='3') { ?> 
                                <div class="col">
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select class="form-control" id="level" name="level">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                                <!-- end: Penilaian -->
                            </div>

                            <?php } } else { ?>
                                
                                <div class="col">
                                    <div class="form-group">
                                        <h3><center> Belum ada data yang diinput </center></h3>
                                    </div>
                                </div>

                            <?php } ?>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- End Content -->

