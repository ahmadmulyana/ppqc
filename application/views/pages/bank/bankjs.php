<script>
    function loadJson(tahun){
    var csrf_token = $("#csrf_token").val();
     $.ajax({
        type: "post",
        dataType : "json",
        data : {csrf_token : csrf_token, tahun : tahun},
        url : "<?php echo site_url('bank_data/getDataBank')?>",
        success: function(respon){
            loadChart1(respon);
            loadChart2(respon);
        }
     })
  }
</script>


