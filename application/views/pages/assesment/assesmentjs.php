<script>
  $('.edit').click(function(){
        $('.txtedit').hide();
        $(this).next('.txtedit').show().focus();
        $(this).hide();
    });

    // Save data
    $(".txtedit").on('focusout',function(){
        
        var id = this.id;
        var split_id = id.split("_");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();
        
        var project_id = $("#project_id").val();
        var mode = $("#mode").val();
        // Hide Input element
        $(this).hide();

        // Hide and Change Text of the container with input elmeent
        $(this).prev('.edit').show();
        $(this).prev('.edit').text(value);

        $.ajax({
            url: base_url + 'assesment/update',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id, mode : mode },
            success:function(response){
                if(response == 1){ 
                    console.log('Save successfully'); 
                }else{ 
                    console.log("Not saved."); 
                }  
            }
        });
    
    });

    $('#tabul').on('change', function() {
        let text = this.value;
        const myArray = text.split("-");
        var tabul = myArray[1]+myArray[0];

        var csrf_token = $("#csrf_token").val();
        $.ajax({
            type: "post",
            dataType : "json",
            data : {csrf_token : csrf_token, tabul : tabul, tabul_asli : this.value},
            url : "<?php echo site_url('qsia/simpanSessi')?>",
            success: function(respon){
                console.log(respon);
                loadJson(tabul);
            }
        })
    });

    $('#tabul_2').on('change', function() {
        let text = this.value;
        const myArray = text.split("-");
        var tabul = myArray[1]+myArray[0];

        var csrf_token = $("#csrf_token").val();
        $.ajax({
            type: "post",
            dataType : "json",
            data : {csrf_token : csrf_token, tabul : tabul, tabul_asli : this.value},
            url : "<?php echo site_url('qsia/simpanSessi')?>",
            success: function(respon){
                console.log(respon);
                loadJson(tabul);
            }
        })
    });


    loadJson();

    function loadJson(tabul){
        var csrf_token = $("#csrf_token").val();
         $.ajax({
            type: "post",
            dataType : "json",
            data : {csrf_token : csrf_token, tabul : tabul},
            url : "<?= site_url('assesment/getchart'); ?>",
            success: function(respon){
                loadChart1(respon);
                loadChart2(respon);
            }
        })
    }

    function loadChart1(data){
        Highcharts.chart('grafik_1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Nilai Quality Achievement'
            },
            xAxis: {
                categories: data.pakerjaan
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Nilai Quality Achievement',
                data: data.total,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    align: 'right',
                    format: '{point.y}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }],
        });
    }

    function loadChart2(data){
        Highcharts.chart('grafik_2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Nilai Quality Achievement'
            },
            xAxis: {
                categories: data.pakerjaan
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Nilai Quality Achievement',
                data: data.total_material,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    align: 'right',
                    format: '{point.y}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }],
        });
    }
    

    

</script>