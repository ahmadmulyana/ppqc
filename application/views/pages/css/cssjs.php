<script>
  
  loadJson("");
  LOAD50();
  LOAD100();

  function loadJson(tahun){
    var csrf_token = $("#csrf_token").val();
     $.ajax({
        type: "post",
        dataType : "json",
        data : {csrf_token : csrf_token, tahun : tahun},
        url : "<?php echo site_url('css/getchart')?>",
        success: function(respon){
            loadChart(respon);
        }
     })
  }
  
  function loadChart(data){
      Highcharts.chart('containers', {
        chart: {
          type: 'column'
        },
        title: {
          text: 'Customer Satisfaction Survey'
        },
        xAxis: {
          categories: data.bulan
        },
        credits: {
          enabled: false
        },
        series: [{
          name: 'CSS 50%',
          data: data.value50
        }, {
          name: 'CSS 100%',
          data: data.value100
        }]
      });
  } 

  function LOAD50(){
    var csrf_token = $("#csrf_token").val();
     $.ajax({
        type: "post",
        dataType : "json",
        data : {csrf_token : csrf_token},
        url : "<?php echo site_url('css/getChartCSS50')?>",
        success: function(respon){
            loadChartCSS50(respon);
            
        }
     })
  }

  function LOAD100(){
    var csrf_token = $("#csrf_token").val();
     $.ajax({
        type: "post",
        dataType : "json",
        data : {csrf_token : csrf_token},
        url : "<?php echo site_url('css/getChartCSS100')?>",
        success: function(respon){
            loadChartCSS100(respon);
        }
     })
  }

  function loadChartCSS50(data){
      Highcharts.chart('grafik_css_50', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Customer Satisfaction Survey'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories:  data.bulan
        },
        yAxis: {
            title: {
                text: ''
            },
            label : {
              formatter : function (){
                return this.value;
              }
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'CSS 50%',
            data:  data.value 
        }]
    });
  }

  function loadChartCSS100(data){
      Highcharts.chart('grafik_css_100', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Customer Satisfaction Survey'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories:  data.bulan
        },
        yAxis: {
            title: {
                text: ''
            },
            label : {
              formatter : function (){
                return this.value;
              }
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'CSS 100%',
            data:  data.value 
        }]
    });
  }
  
    $('.edit').click(function(){
      var progress = $("#progress").val();
      if (progress > 0){
        $('.txtedit').hide();
        $(this).next('.txtedit').show().focus();
        $(this).hide();
      }
    });

    // Save data
    $(".txtedit").on('focusout',function(){
        
        // Get edit id, field name and value
        var id = this.id;
        var split_id = id.split("_");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();
        
        var project_id = $("#project_id").val();
        
        // Hide Input element
        $(this).hide();

        // Hide and Change Text of the container with input elmeent
        $(this).prev('.edit').show();
        $(this).prev('.edit').text(value);

        // Sending AJAX request
        $.ajax({
            url: base_url + 'css/update',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                if(response == 1){ 
                    console.log('Save successfully'); 
                    loadJson("");
                }else{ 
                    console.log("Not saved."); 
                }  
            }
        });
    
    });

    $('.edit_100').click(function(){
      var progress = $("#progress").val();
      if (progress > 0){
        $('.txtedit_100').hide();
        $(this).next('.txtedit_100').show().focus();
        $(this).hide();
      }
    });

    // Save data
    $(".txtedit_100").on('focusout',function(){
        
        // Get edit id, field name and value
        var id = this.id;
        var split_id = id.split("_");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();
        
        var project_id = $("#project_id").val();
        
        // Hide Input element
        $(this).hide();

        // Hide and Change Text of the container with input elmeent
        $(this).prev('.edit_100').show();
        $(this).prev('.edit_100').text(value);

        // Sending AJAX request
        $.ajax({
            url: base_url + 'css/update',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                if(response == 1){ 
                    console.log('Save successfully'); 
                    loadJson("");
                }else{ 
                    console.log("Not saved."); 
                }  
            }
        });
    
    });

    

    function uploadCSS() {
      var frmdata = new FormData();
        var files = $('#file')[0].files[0];
        frmdata.append('file',files);
        var project_id = $('#project_id').val();
        var nama_file = $('#nama_file').val();
        var type_css = $('#type_css').val();
        frmdata.append('project_id',project_id);
        frmdata.append('nama_file',nama_file);
        frmdata.append('type_css',type_css);

      $.ajax({    
        type: "POST",
        url: base_url + "css/uploadFile",
        data: frmdata,
        contentType: false,
            processData: false,
      }).done(function(response) {
        if(response != 0){
          window.location.assign(base_url+"css/detail/" + project_id); 
        } else {
          console.log('gagal');
        }
      });
      return false;
    }
</script>