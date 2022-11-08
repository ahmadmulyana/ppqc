    <!-- Content -->
    <div class="wrapper qsia-page">
        <div class="page-title">
            <h5 class="fw-bolder">Master NC</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb subtitle">
                  <li class="breadcrumb-item"><a href="#">PP QHSE</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Master NC</li>
                </ol>
                <?=  tgl_indo(date('Y-m-d')); ?>
              </nav>
        </div>
        
        <div class="content-wrapper">
            <div class="row gap-m-2">

                <div class="col-md-12 mb-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Sumber NC</span></div>
                                <div class="col-md-6 text-right">
                                    <a onclick="return m_type_nc_e(0);" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Sumber NC</a>
                                    <!-- Modal -->
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="exampletype" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach ($data as $typenc) { 
                                    ?>
                                        <tr>
                                            <td class="text-primary fw-bolder"><?= $i++;?></td>
                                            <td><?= $typenc->sumber_nc;?></td>
                                            <td class="text-center">
                                                <a style="cursor: pointer;" onclick="return m_type_nc_e(<?= $typenc->id ?>);"><span class="material-icons-round text-success">edit</span></a> 
                                                <a href="#" onclick="return m_sumber_nc_h(<?= $typenc->id ?>);" ><span class="material-icons-round text-danger">delete</span></a> 
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="m_type_nc" tabindex="-1" role="dialog" aria-labelledby="centerModalLabel">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="centerModalLabel">Tambah Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form name="f_type_nc" id="f_type_nc" onsubmit="return m_sumber_nc_s();">
                                <input type="hidden" id="<?=$this->security->get_csrf_token_name();?>" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

                                <div class="modal-body text-left">
                                    <div class="row mb-3">
                                        <input type="hidden" name="id" id="id" value="0">
                                        <div class="form-group col-md-12">
                                            <label>Nama</label>
                                            <input id="sumber_nc" name="sumber_nc" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                    <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->