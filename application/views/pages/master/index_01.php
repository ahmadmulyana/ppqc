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

                <div class="col-md-6 mb-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Type NC</span></div>
                                <div class="col-md-6 text-right">
                                    <a onclick="return m_type_nc_e(0);" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Type NC</a>
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
                                        foreach ($type as $typenc) { 
                                    ?>
                                        <tr>
                                            <td class="text-primary fw-bolder"><?= $i++;?></td>
                                            <td><?= $typenc->type_nc;?></td>
                                            <td class="text-center">
                                                <a style="cursor: pointer;" onclick="return m_type_nc_e(<?= $typenc->id ?>);"><span class="material-icons-round text-success">edit</span></a> 
                                                <a href="#" onclick="return m_type_nc_h(<?= $typenc->id ?>);" ><span class="material-icons-round text-danger">delete</span></a> 
                                                <!--
                                                <a href="#"><span class="material-icons-round text-info">visibility</span></a> 
                                            -->
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

                            <form name="f_type_nc" id="f_type_nc" onsubmit="return m_type_nc_s();">
                                <div class="modal-body text-left">
                                    <div class="row mb-3">
                                        <input type="hidden" name="id" id="id" value="0">
                                        <div class="form-group col-md-12">
                                            <label>Nama</label>
                                            <input id="type_nc" name="type_nc" type="text" class="form-control" value="">
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

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Level NC</span></div>
                                <div class="col-md-6 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#levelnc" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Level NC</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="levelnc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form>
                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-3">
                                                            <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="examplelevel" class="table table-striped" style="width:100%">
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
                                        foreach ($level as $levelnc) 
                                    { ?>
                                        <tr>
                                            <td class="text-primary fw-bolder"><?= $i++;?></td>
                                            <td><?= $levelnc->level_nc;?></td>
                                            <td class="text-center">
                                                <a data-bs-toggle="modal" data-bs-target="#editlevelnc" style="cursor: pointer;"><span class="material-icons-round text-success">edit</span></a> 
                                                <a href="#"><span class="material-icons-round text-danger">delete</span></a> 
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- Modal -->
                                <div class="modal fade" id="editlevelnc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="centerModalLabel">Update Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form>
                                                <div class="row mb-3">
                                                    <div class="form-group col-md-12">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="form-group col-md-3">
                                                        <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Area Pekerjaan NC</span></div>
                                <div class="col-md-6 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#areapekerjaannc" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Area Pekerjaan NC</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="areapekerjaannc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form>
                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-3">
                                                            <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="examplearea" class="table table-striped" style="width:100%">
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
                                        foreach ( $akar as $akarnc)
                                    { ?>
                                        <tr>
                                            <td class="text-primary fw-bolder"><?= $i++;?></td>
                                            <td><?= $akarnc->akar_nc;?></td>
                                            <td class="text-center">
                                                <a data-bs-toggle="modal" data-bs-target="#editareapekerjaannc" style="cursor: pointer;"><span class="material-icons-round text-success">edit</span></a> 
                                                <a href="#"><span class="material-icons-round text-danger">delete</span></a> 
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- Modal -->
                                <div class="modal fade" id="editareapekerjaannc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="centerModalLabel">Update Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form>
                                                <div class="row mb-3">
                                                    <div class="form-group col-md-12">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="form-group col-md-3">
                                                        <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Jenis Pekerjaan NC</span></div>
                                <div class="col-md-6 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#jenispekerjaannc" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Jenis Pekerjaan NC</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="jenispekerjaannc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form>
                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-3">
                                                            <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="examplejenis" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-primary fw-bolder">1</td>
                                        <td>Struktur Beton Balok</td>
                                        <td class="text-center">
                                            <a data-bs-toggle="modal" data-bs-target="#editjenispekerjaannc" style="cursor: pointer;"><span class="material-icons-round text-success">edit</span></a> 
                                            <a href="#"><span class="material-icons-round text-danger">delete</span></a> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Modal -->
                                <div class="modal fade" id="editjenispekerjaannc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="centerModalLabel">Update Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form>
                                                <div class="row mb-3">
                                                    <div class="form-group col-md-12">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="form-group col-md-3">
                                                        <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Akar Masalah NC ( BOCAL )</span></div>
                                <div class="col-md-6 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#akarpekerjaannc" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Akar Masalah NC</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="akarpekerjaannc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form>
                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>Type</label>
                                                            <select class="form-select">
                                                                <option selected disabled>Pilih Type NC</option>
                                                                <option value="b">Bahan</option>
                                                                <option value="o">Orang</option>
                                                                <option value="c">Cara</option>
                                                                <option value="a">Alat</option>
                                                                <option value="l">Lingkungan</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-3">
                                                            <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="exampleakar" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Type</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-primary fw-bolder">1</td>
                                        <td>Material Alam</td>
                                        <td>Bahan</td>
                                        <td class="text-center">
                                            <a data-bs-toggle="modal" data-bs-target="#editakarpekerjaannc" style="cursor: pointer;"><span class="material-icons-round text-success">edit</span></a> 
                                            <a href="#"><span class="material-icons-round text-danger">delete</span></a> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Modal -->
                                <div class="modal fade" id="editakarpekerjaannc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="centerModalLabel">Update Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form>
                                                <div class="row mb-3">
                                                    <div class="form-group col-md-12">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="form-group col-md-12">
                                                        <label>Type</label>
                                                        <select class="form-select">
                                                            <option selected disabled>Pilih Type NC</option>
                                                            <option value="b">Bahan</option>
                                                            <option value="o">Orang</option>
                                                            <option value="c">Cara</option>
                                                            <option value="a">Alat</option>
                                                            <option value="l">Lingkungan</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="form-group col-md-3">
                                                        <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Sumber NC</span></div>
                                <div class="col-md-6 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#sumbernc" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Sumber NC</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="sumbernc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form>
                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-3">
                                                            <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="examplesumber" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-primary fw-bolder">1</td>
                                        <td>NC Pek. Internal</td>
                                        <td class="text-center">
                                            <a data-bs-toggle="modal" data-bs-target="#editsumbernc" style="cursor: pointer;"><span class="material-icons-round text-success">edit</span></a> 
                                            <a href="#"><span class="material-icons-round text-danger">delete</span></a> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Modal -->
                                <div class="modal fade" id="editsumbernc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="centerModalLabel">Update Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form>
                                                <div class="row mb-3">
                                                    <div class="form-group col-md-12">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="form-group col-md-3">
                                                        <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Disposisi NC</span></div>
                                <div class="col-md-6 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#disposisinc" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Disposisi NC</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="disposisinc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form>
                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-3">
                                                            <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="exampledisposisi" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-primary fw-bolder">1</td>
                                        <td>Repair</td>
                                        <td class="text-center">
                                            <a data-bs-toggle="modal" data-bs-target="#editdisposisinc" style="cursor: pointer;"><span class="material-icons-round text-success">edit</span></a> 
                                            <a href="#"><span class="material-icons-round text-danger">delete</span></a> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Modal -->
                                <div class="modal fade" id="editdisposisinc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="centerModalLabel">Update Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form>
                                                <div class="row mb-3">
                                                    <div class="form-group col-md-12">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="form-group col-md-3">
                                                        <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Status NC</span></div>
                                <div class="col-md-6 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#statusnc" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Status NC</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="statusnc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form>
                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-3">
                                                            <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="examplestatus" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-primary fw-bolder">1</td>
                                        <td>Open</td>
                                        <td class="text-center">
                                            <a data-bs-toggle="modal" data-bs-target="#editstatusnc" style="cursor: pointer;"><span class="material-icons-round text-success">edit</span></a> 
                                            <a href="#"><span class="material-icons-round text-danger">delete</span></a> 
                                            <a href="#"><span class="material-icons-round text-info">visibility</span></a> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Modal -->
                                <div class="modal fade" id="editstatusnc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="centerModalLabel">Update Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form>
                                                <div class="row mb-3">
                                                    <div class="form-group col-md-12">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="form-group col-md-3">
                                                        <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row w-100">
                                <div class="col-md-6"><span class="subtitle fw-bolder">Biaya Perbaikan NC</span></div>
                                <div class="col-md-6 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#biayaperbaikannc" style="cursor: pointer;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Biaya Perbaikan NC</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="biayaperbaikannc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="centerModalLabel">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form>
                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" value="">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="form-group col-md-3">
                                                            <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body subtitle overflow-auto p-4">
                            <table id="examplebiaya" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-primary fw-bolder">1</td>
                                        <td>Repair</td>
                                        <td class="text-center">
                                            <a data-bs-toggle="modal" data-bs-target="#editbiayaperbaikannc" style="cursor: pointer;"><span class="material-icons-round text-success">edit</span></a> 
                                            <a href="#"><span class="material-icons-round text-danger">delete</span></a> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Modal -->
                                <div class="modal fade" id="editbiayaperbaikannc" tabindex="-1" aria-labelledby="centerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="centerModalLabel">Update Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form>
                                                <div class="row mb-3">
                                                    <div class="form-group col-md-12">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" value="">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="form-group col-md-3">
                                                        <a href="#" class="btn btn-primary" role="button" type="submit">Submit</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-transparent">Cancel</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </div>
        
        </div>
        <!-- End Content -->
