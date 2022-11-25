<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="<?=$this->security->get_csrf_token_name();?>" content="<?=$this->security->get_csrf_hash();?>">
    <title>PP QC</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/');?>images/icon.png"/>
    <!-- Font Inter & Material Icon -->
    <link rel="stylesheet" href="<?= base_url('assets/');?>fonts/font-google/inter&material-icon.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/');?>css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/');?>fonts/font-awesome/css/all.css">
    <!-- ToastUI Chart CSS-->
    <link rel="stylesheet" href="<?= base_url('assets/');?>css/modules/toastui-chart/toastui-chart.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/');?>css/modules/datatables/dataTables.bootstrap5.min.css">
    <!-- Smart Wizard CSS-->
    <link rel="stylesheet" href="<?= base_url('assets/');?>css/modules/smart-wizard/smart_wizard_all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <?php if ($page <> "bank_detail") { ?>
        <!-- Dropzone JS -->
        <link rel="stylesheet" href="<?= base_url('assets/');?>js/modules/dropzone/dropzone.css">
    <?php } ?>

    <!-- Haribima CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/');?>css/haribima-style.css">
    <link rel="stylesheet" href="<?= base_url('assets/');?>vendors/toast/jquery.toast.min.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header mx-auto">
          <img src="<?= base_url('assets/');?>images/logo.png" alt="Logo Haribima">
        </div>
        <div class="offcanvas-body p-0 pb-4">
            <ul class="navbar-nav">
                <div class="mb-2">
                    <div class="text-secondary text-uppercase fw-bolder nav-title body">Main</div>
                </div>
                <li>
                    <a href="<?= site_url('home');?>" class="nav-link  sidebar-link <?= $page=="dashboard" ? 'active' : ''; ?>">
                        <span class="material-icons-round material-22">home</span>
                        <span class="subtitle ms-3">Dashboard</span>
                    </a>
                </li>
                <li>

                    <?php 
                    if ($page=="assesment_pekerjaan" || $page == "assesment_material" || $page == "assesment_material_detail" || $page == "assesment_detail" || $page == "summaryachiement" || $page == "qsia" || $page=="qsia/add" || $page=="assesment_pekerjaan_edit" || $page=="qsia_detail"){
                        $collapse = "";
                        $active ="active";
                        
                    }else{
                        $collapse = "collapse";
                        $active ="";
                    }
                    ?>

                    <a class="nav-link sidebar-link <?= $active; ?>" data-bs-toggle="collapse" href="#layout" role="button" aria-expanded="false" aria-controls="layout">
                        <span class="material-icons-round material-22">dashboard</span>
                        <span class="subtitle ms-3">Quality Achievement</span>
                        <span class="material-icons-round material-22 expand-icon ms-auto">expand_more</span>
                    </a>

                    
                    <div class="<?= $collapse; ?> sidebar-collapse" id="layout">
                        <ul class="navbar-nav sidebar-dropdown">
                            <?php if ($this->session->userdata('admin_level') == "3") { ?>
                                <li>
                                <a href="<?= site_url('summaryachiement');?>" class="nav-link sidebar-link <?= $page=="summaryachiement" ? 'active' : ''; ?>">
                                    <span class="subtitle">Summary QA</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('assesment');?>" class="nav-link sidebar-link <?= $page=="assesment_pekerjaan" || $page=="assesment_detail" ? 'active' : ''; ?>">
                                    <span class="subtitle">Assesment Item Pekerjaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('assesment/assesment_material');?>" class="nav-link sidebar-link <?= $page=="assesment_material" || $page == "assesment_material_detail" || $page == "assesment_material"  ? 'active' : ''; ?>"><span class="subtitle">Assesment Supply Material</span></a>
                            </li>
                            <li>
                                <a href="<?= site_url('qsia_admin');?>" class="nav-link sidebar-link <?= $page=="qsia" || $page=="qsia/add" || $page=="qsia_detail" ? 'active' : ''; ?>">
                                    <span class="subtitle">QSIA</span>
                                </a>
                            </li>
                            <?php }else{ ?>

                            <li>
                                <a href="<?= site_url('summaryachiement');?>" class="nav-link sidebar-link <?= $page=="summaryachiement" ? 'active' : ''; ?>">
                                    <span class="subtitle">Summary QA</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('assesment');?>" class="nav-link sidebar-link <?= $page=="assesment_pekerjaan" || $page=="assesment_detail" ? 'active' : ''; ?>">
                                    <span class="subtitle">Assesment Item Pekerjaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('assesment/assesment_material');?>" class="nav-link sidebar-link <?= $page=="assesment_material" || $page == "assesment_material_detail" || $page == "assesment_material"  ? 'active' : ''; ?>"><span class="subtitle">Assesment Supply Material</span></a>
                            </li>
                            <li>
                                <a href="<?= site_url('qsia');?>" class="nav-link sidebar-link <?= $page=="qsia" || $page=="qsia/add" || $page=="qsia_detail" ? 'active' : ''; ?>">
                                    <span class="subtitle">QSIA</span>
                                </a>
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="<?= site_url('css');?>" class="nav-link sidebar-link <?= $page=="css" || $page=="css_detail" ? 'active' : ''; ?>">
                        <span class="material-icons-round material-22">auto_awesome_motion</span>
                        <span class="subtitle ms-3">CSS</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('inspeksi');?>" class="nav-link sidebar-link <?= $page=="inspeksi" ? 'active' : ''; ?>">
                        <span class="material-icons-round material-22">view_column</span>
                        <span class="subtitle ms-3">Inspeksi</span>
                    </a>
                </li>
                <li>

                    <a class="nav-link sidebar-link <?= $page=="nc_user" || $page=="nc_admin" || $page=="list_laporan" || $page=="cari_nc" ? 'active' : ''; ?>" data-bs-toggle="collapse" href="#page" role="button" aria-expanded="true" aria-controls="page">
                        <span class="material-icons-round material-22">power</span>
                        <span class="subtitle ms-3">NC</span>
                        <span class="material-icons-round material-22 expand-icon ms-auto">expand_more</span>
                    </a>

                    <?php 
                    if ($page=="nc_user" || $page=="nc_admin" || $page=="list_laporan" || $page=="cari_nc" || $page=="add_nc" || $page=="edit_nc" || $page=="cari_nc_detail" ){ ?>
                        <div class="sidebar-collapse" id="page">
                        <ul class="navbar-nav sidebar-dropdown">
                            <li>
                                <?php 
                                if ($this->session->userdata('admin_level') == "3") { ?>
                                    <a href="<?= site_url('nc_admin');?>" class="nav-link sidebar-link <?= $page=="nc_admin" || $page=="add_nc" || $page=="edit_nc" ? 'active' : ''; ?>">
                                        <span class="subtitle">List NC</span>
                                    </a>
                                <?php } else{ ?>
                                    <a href="<?= site_url('nc_user');?>" class="nav-link sidebar-link <?= $page=="nc_user" || $page=="add_nc" || $page=="edit_nc" ? 'active' : ''; ?>">
                                        <span class="subtitle">List NC</span>
                                    </a>
                                <?php }?>
                            </li>

                            <li>
                                <a href="<?= site_url('list_laporan');?>" class="nav-link sidebar-link <?= $page=="list_laporan" ? 'active' : ''; ?>">
                                    <span class="subtitle">Laporan NC</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('cari_nc');?>" class="nav-link sidebar-link <?= $page=="cari_nc" || $page=="cari_nc_detail" ? 'active' : ''; ?>">
                                    <span class="subtitle">Evaluasi NC</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php } else { ?>
                        <div class="collapse sidebar-collapse" id="page">
                        <ul class="navbar-nav sidebar-dropdown">
                            <li>
                                <?php 
                                if ($this->session->userdata('admin_level') == "3") { ?>
                                    <a href="<?= site_url('nc_admin');?>" class="nav-link sidebar-link <?= $page=="nc_admin" ? 'active' : ''; ?>">
                                        <span class="subtitle">List NC</span>
                                    </a>
                                <?php } else{ ?>
                                    <a href="<?= site_url('nc_user');?>" class="nav-link sidebar-link <?= $page=="nc_user" ? 'active' : ''; ?>">
                                        <span class="subtitle">List NC</span>
                                    </a>
                                <?php }?>
                            </li>

                            <li>
                                <a href="<?= site_url('list_laporan');?>" class="nav-link sidebar-link <?= $page=="list_laporan" ? 'active' : ''; ?>">
                                    <span class="subtitle">Laporan NC</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('cari_nc');?>" class="nav-link sidebar-link <?= $page=="cari_nc" ? 'active' : ''; ?>">
                                    <span class="subtitle">Evaluasi NC</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php } ?>
                    
                </li>
                <li>
                    <a href="<?= site_url('observasi');?>" class="nav-link sidebar-link <?= $page=="observasi" ? 'active' : ''; ?>">
                        <span class="material-icons-round material-22">star</span>
                        <span class="subtitle ms-3">Observasi</span>
                    </a>
                </li>
                <li>
                    <?php 
                    if ($this->session->userdata('admin_level') == "3") { ?>
                        <a href="<?= site_url('bank_data/admin');?>" class="nav-link sidebar-link">
                            <span class="material-icons-round material-22">storage</span>
                            <span class="subtitle ms-3">Good Product</span>
                        </a>
                    <?php } else{ ?>
                        <a href="<?= site_url('bank_data/user');?>" class="nav-link sidebar-link <?= $page=="bank_data/user" ? 'active' : ''; ?>">
                            <span class="material-icons-round material-22">storage</span>
                            <span class="subtitle ms-3">Good Product</span>
                        </a>
                    <?php }?>
                    
                </li>
                
                <div class="mb-2 mt-4">
                    <div class="text-secondary text-uppercase fw-bolder nav-title body">General</div>
                </div>
                
                <li>

                    <?php 
                    if ($page=="type_nc" || $page == "sumber_nc" || $page == "level_nc" || $page == "type_pekerjaan" || $page == "item_survey" || $page == "kriteria_penilaian" || $page == "vendor" || $page == "supplier" || $page == "general" ){
                        $collapse = "";
                        $active ="active";
                        
                    }else{
                        $collapse = "collapse";
                        $active ="";
                    }
                    ?>

                    <?php if ($this->session->userdata('admin_level') =='3') { ?> 
                    <a class="nav-link sidebar-link <?= $active; ?>" data-bs-toggle="collapse" href="#setting" role="button" aria-expanded="false" aria-controls="setting">
                        <span class="material-icons-round material-22">settings</span>
                        <span class="subtitle ms-3">Setting</span>
                        <span class="material-icons-round material-22 expand-icon ms-auto">expand_more</span>
                    </a>
                    <div class="<?= $collapse; ?> sidebar-collapse" id="setting">
                        <ul class="navbar-nav sidebar-dropdown">
                            <li>
                                <a href="<?= site_url('master/type_nc');?>" class="nav-link sidebar-link <?= $page=="type_nc" ? 'active' : ''; ?>">
                                    <span class="subtitle">Type NC</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('master/sumber_nc');?>" class="nav-link sidebar-link <?= $page=="sumber_nc" ? 'active' : ''; ?>">
                                    <span class="subtitle">Sumber NC</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('master/level_nc');?>" class="nav-link sidebar-link <?= $page=="level_nc" ? 'active' : ''; ?>">
                                    <span class="subtitle">Level NC</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('master/item_survey');?>" class="nav-link sidebar-link <?= $page=="item_survey" ? 'active' : ''; ?>">
                                    <span class="subtitle">Item Survey</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('master/type_pekerjaan');?>" class="nav-link sidebar-link <?= $page=="type_pekerjaan" ? 'active' : ''; ?>">
                                    <span class="subtitle">Type Pekerjaan</span>
                                </a>
                            </li> 

                            <li>
                                <a href="<?= site_url('master/kriteria_penilaian');?>" class="nav-link sidebar-link <?= $page=="kriteria_penilaian" ? 'active' : ''; ?>">
                                    <span class="subtitle">Kriteria Penilaian</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('master/vendor');?>" class="nav-link sidebar-link <?= $page=="vendor" ? 'active' : ''; ?>">
                                    <span class="subtitle">Vendor</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('master/supplier');?>" class="nav-link sidebar-link <?= $page=="supplier" ? 'active' : ''; ?>">
                                    <span class="subtitle">Supplier</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('general');?>" class="nav-link sidebar-link <?= $page=="general" ? 'active' : ''; ?>">
                                    <span class="subtitle">General Setting</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                
                <li>
                    <a href="<?= site_url('personal');?>" class="nav-link sidebar-link <?= $page=="personal" ? 'active' : ''; ?>">
                        <span class="material-icons-round material-22">group_add</span>
                        <span class="subtitle ms-3">User</span>
                    </a>
                </li>
                <?php } ?>

                <li>
                    <a href="<?= site_url('monitoring') ?>" class="nav-link sidebar-link" target="blank">
                        <span class="material-icons-round material-22">dashboard</span>
                        <span class="subtitle ms-3">Mode Monitoring</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('assets/images/');?>PP-QHSE.pdf" class="nav-link sidebar-link" download>
                        <span class="material-icons-round material-22">description</span>
                        <span class="subtitle ms-3">Documentation</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Sidebar -->
    
    <section class="main-wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
            <div class="container-fluid">
                <!-- Sidebar Button -->
                <span class="material-icons-round menu-mobile" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">menu</span>
                <span class="material-icons-round menu-desktop">menu</span>
                <!-- End Sidebar Button -->
                <ul class="navbar-nav ms-auto d-flex align-items-center flex-row">
                    <span class="material-icons-round me-3">mail</span>
                    <span class="material-icons-round position-relative">notifications<div class="notif-count"></div></span>
                    <div class="divider-y mx-3"></div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle p-0 d-flex align-items-center text-white" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= base_url('assets/');?>images/template/avatar.png" alt="Avatar">
                    <span class="subtitle profile-name ms-2"><?= $this->session->userdata('nama_lengkap'); ?></span>
                    <span class="material-icons-round ms-1">expand_more</span>
                    </a>
                    <ul class="dropdown-menu dropdown-navbar position-absolute subtitle text-dark px-2" aria-labelledby="navbarDropdownMenuLink">
                    <li class="my-1"><a class="dropdown-item" href="<?= site_url('profile');?>"><span class="material-icons-round dropdown-icon me-2">person</span>Profile</a></li>
                    <!-- <li class="my-1"><a class="dropdown-item" href="#"><span class="material-icons-round dropdown-icon me-2">settings</span>Setting</a></li> -->
                    <li class="my-1"><a class="dropdown-item text-danger" href="<?= site_url('login/logout');?>"><span class="material-icons-round dropdown-icon me-2">power_settings_new</span>Logout</a></li>
                    </ul>
                </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->