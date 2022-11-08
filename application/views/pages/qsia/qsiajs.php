<script>
  
  loadJson("");

  loadJsonGrafik("");

  function loadJson(tahun){
    var csrf_token = $("#csrf_token").val();
     $.ajax({
        type: "post",
        dataType : "json",
        data : {csrf_token : csrf_token, tahun : tahun},
        url : "<?php echo site_url('nc/getchart')?>",
        success: function(respon){
            loadChart1(respon);
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
            name: 'Closed NC',
            data:  data.value 
        }]
    });
  }
  
  function grafik_implementasi(data){
    Highcharts.chart('grafik_implementasi', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Implementasi Sistem'
        },
        xAxis: {
            categories: [
            'Perencanaan',
            'Koordinasi & Komunikasi'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Implementasi Sistem'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Penilaian',
            data: [data.total_nilai_1, data.total_nilai_2]
        }]
    });

    Highcharts.chart('grafik_site', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Site Condition'
        },
        xAxis: {
            categories: [
            'Pengendalian aspek sumber daya',
            'Pengendalian aspek penunjang',
            'Pengendalian proses'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Site Condition'
            },
            label : {
              formatter : function (){
                return this.value;
              }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Penilaian',
            data: [data.total_nilai_3, data.total_nilai_4, data.total_nilai_5]

        }]
    });
  }
  
  $('#tahun').on('change', function() {
    loadJson(this.value);
  });

  $('#datepicker').on('change', function() {
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
            getDataQA(tabul);
            loadJsonGrafik(tabul);
        }
     })
  });

  function loadJsonGrafik(tabul){
    var csrf_token = $("#csrf_token").val();
     $.ajax({
        type: "post",
        dataType : "json",
        data : {csrf_token : csrf_token, tabul : tabul},
        url : "<?php echo site_url('qsia/getDataGrafikByTabul')?>",
        success: function(respon){
            grafik_implementasi(respon);
        }
     })
  }

  function getDataQA(tabul){
    var url = base_url + 'qsia/getDataByTabul'; 
    var csrf_token = $("#csrf_token").val();
    var status = $("#status_nc").val();
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data : {'status' : status, csrf_token : csrf_token, tabul : tabul},
      success: function(response){
        console.log(response);

        var i;
        var no = 0;
        var html = "";
        var grandTotal=0;
        var footer ="";

        for(i=0;i < response.length ; i++){
          no++;
          grandTotal += parseInt(response[i].nilai);

          var prosentase = Math.round((response[i].nil / response[i].nil_mak)*100,2);
          html = html + '<tr>'
                + '<td class="text-primary fw-bolder">' + no  + '</td>'
                + '<td>' + response[i].item_penilaian  + '</td>'
                + '<td>' + prosentase  + '%</td>';

        }

        $("#isi").html(html);

        footer = footer + '<tr>'
                + '<th colspan="2" class="text-primary fw-bolder">TOTAL</th>'
                + '<th class="text-primary fw-bolder">' +  Math.round((grandTotal/5),2)  + '%</th>';

                $("#isi_footer").html(footer);

      }
    });
  }

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
        for(i=0;i < response.length ; i++){
          no++;
          html = html + '<tr>'
                + '<td>' + no  + '</td>'
                + '<td>' + response[i].nomor_nc  + '</td>'
                + '<td>' + response[i].tanggal  + '</td>'
                + '<td>' + response[i].uraian_temuan  + '</td>'
                + '<td>' + response[i].type_nc  + '</td>'
                + '<td>' + response[i].pekerjaan  + '</td>'
                + '<td>' + response[i].status_nc  + '</td>'
                + '<td><a href="'+url_edit+response[i].id+'"><span class="material-icons-round text-success">edit</span></a> <a href="#"><span class="material-icons-round text-info">visibility</span></a> </td>'
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
          no++;
          html = html + '<tr>'
                + '<td>' + no  + '</td>'
                + '<td>' + response[i].nomor_nc  + '</td>'
                + '<td>' + response[i].tanggal  + '</td>'
                + '<td>' + response[i].uraian_temuan  + '</td>'
                + '<td>' + response[i].type_nc  + '</td>'
                + '<td>' + response[i].pekerjaan  + '</td>'
                + '<td>' + response[i].status_nc  + '</td>'
                + '<td><a href="'+url_edit+response[i].id+'"><span class="material-icons-round text-success">edit</span></a> <a href="#"><span class="material-icons-round text-info">visibility</span></a> </td>'
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
    var tanggal = $("#tanggal").val();

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
        tanggal : tanggal
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
                + '<td class="text-center"><a href="'+url_edit+response[i].id+'"><span class="material-icons-round text-info">search</span></a> </td>'
                + '</tr>';
        }
        $("#isi").html(html);
      }
    });
  }); 

</script>