        <div class="footer-wrapper">
            <div class="footer d-flex align-items-center justify-content-between">
                <span class="subtitle">Copyright © 2021. Haribima IT Consultant. All Right Reserved</span>
                <div class="footer-socmed">
                    <img src="<?= base_url('assets/');?>images/template/ic_facebook.svg" alt="Haribima Facebook" class="me-3">
                    <img src="<?= base_url('assets/');?>images/template/ic_instagram.svg" alt="Haribima Instagram" class="me-3">
                    <img src="<?= base_url('assets/');?>images/template/ic_linkedin.svg" alt="Haribima Linkedin">
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Booststrap JS -->
    <script src="<?= base_url('assets/');?>js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="<?= base_url('assets/');?>js/modules/jquery/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="<?= base_url('assets/');?>js/modules/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/');?>js/modules/datatables/dataTables.bootstrap5.min.js"></script>
    <script src="<?= base_url('assets/');?>js/pages/datatables.js"></script>
    
    <?php 
    if ($page=="dashboard"){ ?>
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
        <script src="<?= base_url('assets/');?>js/pages/leaflet.js"></script>
    <?php } ?>
    
    <!-- Smart Wizard JS -->
    <script src="<?= base_url('assets/');?>js/modules/smart-wizard/jquery.smartWizard.min.js"></script>

    <script type="text/javascript">
        var page = "<?= $page; ?>";
        base_url='<?=base_url();?>';
        /*
        $.ajaxSetup({
          headers: { 'csrf_token': $('meta[name="<?=$this->security->get_csrf_token_name();?>"]').attr('content') },
          xhrFields: {
            withCredentials: true
          },
          dataType: 'json',
          cache: false
        });*/
    </script>


    <script src="<?= base_url('assets/');?>js/pages/smart-wizard.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <?php if ($page=="edit_nc" || $page=="lihat_nc" || $page=="add_nc" ) { ?>
        <script src="<?= base_url('assets/');?>js/modules/dropzone/dropzone.js"></script>
        <script src="<?= base_url('assets/');?>js/ekaperintis.js"></script>
    <?php } ?>

    <script src="<?= base_url('assets/');?>vendors/toast/jquery.toast.min.js"></script>

    <!-- Haribima JS -->

    <?php 
    if ($page <> "user/add") { ?>
        <script src="<?= base_url('assets/');?>js/haribima-script.js"></script>
    <?php } ?>
    
    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
        var editor_style = "<?php echo $this->config->item('editor_style'); ?>";
        var uri_js = "<?php echo $this->config->item('base_url'); ?>";
        var page = "<?= $page; ?>";
        var step = "<?= $page =="edit_nc" ? $step : "1"; ?>";
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script>
        $('.date-own').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose: true
        });

        $(".tabul").datepicker( {
            format: "mm-yyyy",
            startView: "months", 
            minViewMode: "months",
            autoclose: true,
            orientation: "bottom right"
        });
        
        $("#datepicker").datepicker( {
            format: "mm-yyyy",
            startView: "months", 
            minViewMode: "months",
            autoclose: true,
            orientation: "bottom right"
        });

        $("#tahun_bulan").datepicker( {
            format: "mm-yyyy",
            startView: "months", 
            minViewMode: "months",
            autoclose: true
        });

    </script>
    <?php
    if (isset($addjs)){
        echo $addjs;
    }
    ?>
</body>
</html>