<script>
  
  switch(page) {
    case "nc_user":
      loadJson("");
      break;
    case "list_laporan":
      loadJsonLaporan("");
      break;
    default:
      console.log(page);
  } 

  function loadJson(tahun){
    var csrf_token = $("#csrf_token").val();
     $.ajax({
        type: "post",
        dataType : "json",
        data : {csrf_token : csrf_token, tahun : tahun},
        url : "<?php echo site_url('nc/getchart')?>",
        success: function(respon){
            loadChart1(respon);
            loadChart2(respon);
        }
     })
  }

  function loadChart1(data){
      Highcharts.chart('containers', {
        chart: {
            type: 'line'
        },
        title: {
            text: ''
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
            name: 'Prosentase Closed NC',
            data:  data.presentase
        }]
    });
  }
  
  function loadChart2(data){
      Highcharts.chart('containerss', {
          chart: {
            type: 'column'
          },
          title: {
            text: ''
          },
          xAxis: {
            categories: data.bulan
          },
          yAxis: {
            min: 0,
            title: {
              text: ''
            },
            stackLabels: {
              enabled: true,
              style: {
                fontWeight: 'bold',
                color: ( // theme
                  Highcharts.defaultOptions.title.style &&
                  Highcharts.defaultOptions.title.style.color
                ) || 'gray'
              }
            }
          },
          legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
          },
          tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
          },
          plotOptions: {
            column: {
              stacking: 'normal',
              dataLabels: {
                enabled: true
              }
            }
          },
          series: [{
            name: 'Open',
             data: data.value_open
          }, {
            name: 'Closed',
            data: data.value
          }]
        });
  }
  
  $('#tahun').on('change', function() {
    loadJson(this.value);
    loadJsonNC(this.value);
  });

  function loadJsonNC(tahun){
    var url = base_url + 'nc/getData'; 
    var csrf_token = $("#csrf_token").val();
    var status = $("#status_nc").val();
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data : {'status' : status, csrf_token : csrf_token, tahun : tahun},
      success: function(response){
        console.log(response);
        var i;
        var no = 0;
        var html = "";
        var warna="";
        var aksi ="";
        
        var url_edit;

        for(i=0;i < response.length ; i++){
          url_edit = base_url + 'nc/edit_nc/' + response[i].id;
          var status_nc = response[i].status_nc;
          if (status_nc=="Open"){
            var url_edit = base_url + 'nc/edit_nc/' + response[i].id;
            warna ='<span class="badge badge-danger">'+ response[i].status_nc  +'</span>';
            aksi ='<a href="' + url_edit + '"><span class="material-icons-round text-success">edit</span></a>'; 
          }else{
            var url_lihat = base_url + "nc/lihat_nc" + response[i].id;
            warna ='<span class="badge badge-success">'+ response[i].status_nc  +'</span>';
            aksi ='<a href="' + url_lihat + '"><span class="material-icons-round text-info">visibility</span></a>';
          }
          no++;
          html = html + '<tr>'
                + '<td>' + no  + '</td>'
                + '<td>' + response[i].nomor_nc  + '</td>'
                + '<td>' + response[i].tanggal  + '</td>'
                + '<td>' + response[i].som_nc  + '</td>'
                + '<td>' + response[i].gps_nc  + '</td>'
                + '<td>' + response[i].sp_nc  + '</td>'
                + '<td>' + response[i].uraian_temuan  + '</td>'
                + '<td>' + response[i].type_nc  + '</td>'
                + '<td>' + response[i].pekerjaan  + '</td>'
                + '<td>' + warna  + '</td>'
                + '<td>' + aksi + '</td>'
                + '</tr>';
        }
        $("#isi").html(html);
      }
    });
  }

  $('#status_nc').on('change', function() {
    var url = base_url + 'nc/getData'; 
    var csrf_token = $("#csrf_token").val();
    var tahun = $("#tahun").val();
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data : {'status' : this.value, csrf_token : csrf_token, tahun : tahun},
      success: function(response){
        console.log(response);
        var i;
        var no = 0;
        var html = "";
        for(i=0;i < response.length ; i++){
          var status_nc = response[i].status_nc;
          var url_edit = base_url + 'nc/edit_nc/' + response[i].id;
          if (status_nc=="Open"){
            warna ='<span class="badge badge-danger">'+ response[i].status_nc  +'</span>';
            aksi ='<a href="' + url_edit + '"><span class="material-icons-round text-success">edit</span></a>'; 
          }else{
            var url_lihat = base_url + "nc/lihat_nc" + response[i].id;
            warna ='<span class="badge badge-success">'+ response[i].status_nc  +'</span>';
            aksi ='<a href="' + url_lihat + '"><span class="material-icons-round text-info">visibility</span></a>'; 
          }

          no++;
          html = html + '<tr>'
                + '<td>' + no  + '</td>'
                + '<td>' + response[i].nomor_nc  + '</td>'
                + '<td>' + response[i].tanggal  + '</td>'
                + '<td>' + response[i].som_nc  + '</td>'
                + '<td>' + response[i].gps_nc  + '</td>'
                + '<td>' + response[i].sp_nc  + '</td>'
                + '<td>' + response[i].uraian_temuan  + '</td>'
                + '<td>' + response[i].type_nc  + '</td>'
                + '<td>' + response[i].pekerjaan  + '</td>'
                + '<td>' + warna  + '</td>'
                + '<td>' + aksi +'</td>'
                + '</tr>';
        }
        $("#isi").html(html);
      }

    });
  }); 

  $(".project_nc").change(function(){
     $.ajax({
      type: "POST",
      url: base_url + "nc/setProjectId",
      dataType: 'json',
      data: {
        project_id : this.value,
        status : $("#status_nc").val()
      },
      success: function(response) {
        loadJson($("#tahun").val());
        console.log(response);
        var i;
        var no = 0;
        var html = "";

        for(i=0;i < response.length ; i++){

          var status_nc = response[i].status_nc;
          var url_edit = base_url + 'nc/edit_nc/' + response[i].id;
          if (status_nc=="Open"){
            warna ='<span class="badge badge-danger">'+ response[i].status_nc  +'</span>';
            aksi ='<a href="' + url_edit + '"><span class="material-icons-round text-success">edit</span></a>'; 
          }else{
            var url_lihat = base_url + "nc/lihat_nc" + response[i].id;
            warna ='<span class="badge badge-success">'+ response[i].status_nc  +'</span>';
            aksi ='<a href="' + url_lihat + '"><span class="material-icons-round text-info">visibility</span></a>'; 
          }

          no++;
          html = html + '<tr>'
                + '<td>' + no  + '</td>'
                + '<td>' + response[i].nomor_nc  + '</td>'
                + '<td>' + response[i].tanggal  + '</td>'
                + '<td>' + response[i].som_nc  + '</td>'
                + '<td>' + response[i].gps_nc  + '</td>'
                + '<td>' + response[i].sp_nc  + '</td>'
                + '<td>' + response[i].uraian_temuan  + '</td>'
                + '<td>' + response[i].type_nc  + '</td>'
                + '<td>' + response[i].pekerjaan  + '</td>'
                + '<td>' + warna  + '</td>'
                + '<td>' + aksi +'</td>'
                + '</tr>';
        }
        $("#isi").html(html);
      }
    });
  });

  $("#btnCari").click(function(){
    var url = base_url + 'nc/cariData'; 
    var csrf_token = $("#csrf_token").val();
    var type_nc = $("#type_nc").val();
    var sumber_nc = $("#sumber_nc").val();
    var level_nc = $("#level_nc").val();
    var disposisi = $("#disposisi").val();
    var tanggal_awal = $("#tanggal_awal").val();
    var tanggal_akhir = $("#tanggal_akhir").val();

    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data : { 
        type_nc: type_nc, 
        csrf_token : csrf_token, 
        sumber_nc : sumber_nc, 
        level_nc : level_nc, 
        disposisi : disposisi,
        tanggal_awal : tanggal_awal,
        tanggal_akhir : tanggal_akhir,
      },
      success: function(response){
        console.log(response);
        var i;
        var no = 0;
        var html = "";
        for(i=0;i < response.length ; i++){
          no++;
          html = html + '<tr>'
                + '<td class="text-primary fw-bolder">' + no  + '</td>'
                + '<td>' + response[i].nama_project  + '</td>'
                + '<td>' + response[i].type_nc  + '</td>'
                + '<td>' + response[i].tanggal  + '</td>'
                + '<td>' + response[i].level_nc  + '</td>'
                + '<td>' + response[i].sumber_nc  + '</td>'
                + '<td>' + response[i].disposisi_pm  + '</td>'
                + '</tr>';
        }
        $("#isi").html(html);
      }
    });
  }); 

  /* Laporan NC */
  $("#project_nc").change(function(){
     $.ajax({
      type: "POST",
      url: base_url + "nc/setProjectId",
      dataType: 'json',
      data: {
        project_id : this.value,
      },
      success: function(response) {
        loadJsonLaporan($("#tahun").val());
      }
    });
  });

  function loadJsonLaporan(tahun){
    var csrf_token = $("#csrf_token").val();
     $.ajax({
        type: "post",
        dataType : "json",
        data : {csrf_token : csrf_token, tahun : tahun},
        url : "<?php echo site_url('nc/getDataLaporan')?>",
        success: function(respon){
            grafik_bulan_ini(respon);
            grafik_sampai_bulan_ini(respon);
            grafik_pie(respon);
        }
     });
  }

  function grafik_sampai_bulan_ini (data){
    Highcharts.chart('grafik_sampai_bulan', {
          chart: {
            type: 'bar'
          },
          title: {
            text: ''
          },
          subtitle: {
            text: ''
          },
          xAxis: {
            categories: data.type,
          },
          plotOptions: {
            bar: {
              dataLabels: {
                enabled: true
              }
            }
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
          },
          credits: {
            enabled: false
          },
          series: [{
            name: '<?= date("Y");?>',
            data: data.value
          }]
        });
  }

  function grafik_bulan_ini (data) {
      Highcharts.chart('grafik_bulan_ini', {
      chart: {
        type: 'bar'
      },
      title: {
        text: ''
      },
      subtitle: {
        text: ''
      },
      xAxis: {
        categories: data.type,
        title: {
          text: null
        }
      },

      plotOptions: {
        bar: {
          dataLabels: {
            enabled: true
          }
        }
      },
      legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
          Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
      },
      credits: {
        enabled: false
      },
      series: [{
        name: '<?= date("Y");?>',
        data: data.value_bulan_berjalan
      }]
    });
  }

  function grafik_pie (data){
    Highcharts.chart('grafik_pie', {
          chart: {
            type: 'pie'
          },
          title: {
            text: ''
          },
          subtitle: {
            text: ''
          },

          xAxis: {
            categories: data.type,
            labels: {
             style: {
              fontSize: '10px',
              fontFamily: 'Verdana, sans-serif'
             }
            }
           },

          accessibility: {
            announceNewData: {
              enabled: true
            },
            point: {
              valueSuffix: '%'
            }
          },

          plotOptions: {
            series: {
              dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y}'
              }
            }
          },

          tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
          },

          series: [
            { data: data.messages }
          ]
          
        });
  }
</script>