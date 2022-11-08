<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="<?=$this->security->get_csrf_token_name();?>" content="<?=$this->security->get_csrf_hash();?>">
    <title>PPQC</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/');?>images/template/favicon.ico"/>
    <!-- Font Inter & Material Icon -->
    <link rel="stylesheet" href="<?= base_url('assets/');?>fonts/font-google/inter&material-icon.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/');?>css/bootstrap.min.css">
    <!-- Haribima CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/');?>css/haribima-style.css">
</head>
<body id="auth-page">

    <div class="row no-gutter" style="height: 100vh;">
        <div class="col-md-6 d-flex align-items-center justify-content-center onboard-bg">
            <div class="onboard text-center">
                <img src="<?= base_url('uploads/general/'.$banner);?>" alt="Auth Onboard">
                <h3 class="fw-bolder text-white mt-5">Keep Connected Each Other</h3>
                <p class="subtitle text-white-50 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            <?=form_open('login/act_login', array('method'=>'post'));?>

            <div class="auth-form">
                <img src="<?= base_url('uploads/general/'.$logo);?>" alt="Logo Responsive" width="40%">
                <h2 class="fw-bolder mt-5">Hi, Welcome!</h2>

                <?php if($this->session->flashdata('message_login_error')): ?>
                    <div style="color: red;">
                            <?= $this->session->flashdata('message_login_error') ?>
                    </div>
                <?php endif ?>

                <h6 class="subtitle text-black-50 mt-1">Input username and password to enter the system.</h6>
                <div class="form-group mt-3">                

                    <label class="subtitle fw-bolder">Username</label>
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control form-control-lg">
                        <span class="input-group-text" id="basic-addon2"><span class="material-icons-round material-18 text-primary">person</span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="subtitle fw-bolder">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" name="sandi" class="form-control form-control-lg">
                        <span class="input-group-text" id="basic-addon2"><span class="material-icons-round material-18 text-primary">lock</span></span>
                    </div>
                </div>

                <input type="submit" class="btn btn-primary btn-lg d-block" value="Login">
        </div>
    </div>

    <!-- Booststrap JS -->
    <script src="<?= base_url('assets/');?>js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="<?= base_url('assets/');?>js/modules/jquery/jquery-3.6.0.min.js"></script>
    <!-- Haribima JS -->
    <script src="<?= base_url('assets/');?>js/haribima-script.js"></script>
</body>
</html>