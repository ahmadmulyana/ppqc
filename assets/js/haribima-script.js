var url_edit = base_url + 'nc/edit/';

$(document).ready(function(){
	
	$(".alert").hide();
    $(".menu-desktop").click(function() {
        $(".sidebar-nav").toggleClass( "sidebar-nav-click" );
        $(".navbar").toggleClass( "navbar-click" );
        $(".main-wrapper").toggleClass( "main-wrapper-click" );
    });

    $(".btn").parent(".card-header").css( "padding", "11px 16px" );


    $("#project").select2({
        placeholder: "-- Pilih -- "
    });

    $("#project_bank").select2({
        placeholder: "-- Pilih -- "
    });

    $(".project_insveksi").select2({
    	placeholder: "-- Pilih -- "
    });

    $('#project_bank').change(function() {
        $("#project_id").val(this.value);
    });

    $("#project_nc").select2({
        placeholder: "-- Pilih Project-- "
    });


    $("#penilaian").attr("disabled","disabled");

    $("#project").change(function(){ 
    	$("#pekerjaan").removeAttr("disabled");
    });

	$("#pekerjaan").change(function(){ 
      	var url = base_url + 'bank_data/getDataPenilaian'; 
      	var csrf_token = $("#csrf_token").val();

      	$("#penilaian").html(''); 
      	$("#penilaian").append('<option value="" disabled selected>-- Pilih --</option>'); 

      	$.ajax({ url : url, 
	      type: 'POST', 
	      data : {pekerjaan_id : this.value, csrf_token : csrf_token},
	      dataType : 'json', 
	      success : function(result){ 
	      	$("#penilaian").removeAttr("disabled");
	        for(var i = 0; i < result.length; i++) 
	          $("#penilaian").append('<option value="'+ result[i].id +'">' + result[i].kriteria + '</option>'); 
	        } 
	    });  
    }); 
});

/* FUNGSI BERSAMA */
function get_url(segmen) {
	var url1 = window.location.protocol;
	var url2 = window.location.host;
	var url3 = window.location.pathname;
	var pathArray = window.location.pathname.split('/');
	return pathArray[segmen];
}

function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });
    return indexed_array;
}

function saveData(){
	var f_asal	= $("#f_nc");
	var form	= getFormData(f_asal);

	$.ajax({
	    url: base_url + "nc/save",
	    type: "post",
	    data: JSON.stringify(form),
	    dataType: "json",
	    success: function (response) {
	    	if (response.status == "ok") {
				window.location.assign(base_url+"nc"); 
			} else {
				console.log('gagal');
			}
	    },
	    error: function() {
	       console.log("error");
	    }
	});
}

function saveDataTemuan(){
	var data = $('#f_nc').serialize()
	$.ajax({
	    url: base_url + "nc/save",
	    type: "post",
	    data: data,
	    dataType: "json",
	    success: function (response) {
	    	if (response.status == "ok") {
				window.location.assign(base_url+"nc/nc_user/" + response.project_id);  
			} else {
				toastr.options.timeOut = 2500;
        		toastr.error(response.caption);
        		window.location.assign(base_url+"nc/add_nc#step-1");
			}
	    },
	    error: function() {
	       console.log("error");
	    }
	});
}

function saveDataInvestigasi(){
	var data = $('#f_nc').serialize();

	$.ajax({
	    url: base_url + "nc/update",
	    type: "post",
	    data: data,
	    dataType: "json",
	    success: function (response) {
			if (response.status == "ok") {
				window.location.assign(base_url+"nc/nc_user/" + response.project_id);  
			} else {
				toastr.options.timeOut = 2500;
        		toastr.error(response.caption);
        		window.location.assign(base_url+ response.url_back);
			}
	    },
	    error: function() {
	       console.log("error");
	    }
	});
}

function saveDataTindakLanjut(){
	var f_asal	= $("#f_nc");
	var form	= getFormData(f_asal);
	var data = $('#f_nc').serialize();

	$.ajax({
	    url: base_url + "nc/saveTindakLanjut",
	    type: "post",
	    data: data,
	    dataType: "json",
	    success: function (response) {
			if (response.status == "ok") {
				window.location.assign(base_url+"nc/nc_user/" + response.project_id);  
			} else {
				toastr.options.timeOut = 2500;
        		toastr.error(response.caption);
        		window.location.assign(base_url+ response.url_back);
			}
	    },
	    error: function() {
	       console.log("error");
	    }
	});
}

function saveDataClosing(){
	var data = $('#f_nc').serialize();

	$.ajax({
	    url: base_url + "nc/saveClosing",
	    type: "post",
	    data: data,
	    dataType: "json",
	    success: function (response) {
			if (response.status == "ok") {
				window.location.assign(base_url+"nc/nc_user/" + response.nc_id);  
			} else {
				toastr.options.timeOut = 2500;
        		toastr.error(response.caption);
        		window.location.assign(base_url+ response.url_back);
			}
	    },
	    error: function() {
	       console.log("error");
	    }
	});
}

function saveBankData(){
	var project_id = $("#project_id").val();

	$.ajax({
	    url: base_url + "bank_data/save",
	    type: "post",
	    data: {request : "bank_data", project_id : project_id},
	    dataType: "json",
	    success: function (response) {
	    	if (response.status == "ok") {
				window.location.assign(base_url+"bank"); 
			} else {
				console.log('gagal');
			}
	    },
	    error: function() {
	       console.log("error");
	    }
	});
}

function m_type_nc_e(id) {
	$("#m_type_nc").modal('show');
	$.ajax({
		type: "GET",
		url: base_url+"master/nc_edit/"+id,
		success: function(data) {
			if (data.status==false){
				$(".modal-title").text("Tambah Data");
				$("#type_nc").val("");
				$("#type_nc").focus();
			}else{
				$(".modal-title").text("Edit Data");
				$("#id").val(data.id);
				$("#type_nc").val(data.type_nc);
				$("#type_nc").focus();
			}
			
		}
	});
	return false;
}

function m_type_nc_s() {
	var f_asal	= $("#f_type_nc");
	var form = $('#f_type_nc').serialize();

	$.ajax({		
		type: "POST",
		url: base_url+"master/nc_simpan",
		data : form,
		dataType: 'json',
	}).done(function(response) {
		if (response.status == "ok") {
			window.location.assign(base_url+"master/type_nc"); 
		} else {
			console.log('gagal');
		}
	});
	return false;
}

function m_type_nc_h(id) {
	if (confirm('Anda yakin..?')) {
		$.ajax({
			type: "GET",
			url: base_url+"master/nc_hapus/"+id,
			success: function(response) {
				if (response.status == "ok") {
					window.location.assign(base_url+"master/type_nc"); 
				} else {
					console.log('gagal');
				}
			}
		});
	}
	return false;
}

/* Type Pekerjaan */
function m_pekerjaan_nc_e(id) {
	$("#m_type_nc").modal('show');
	$.ajax({
		type: "GET",
		url: base_url+"master/type_pekerjaan_edit/"+id,
		success: function(data) {
			if (data.status==false){
				$(".modal-title").text("Tambah Data");
				$("#pekerjaan").val("");
				$("#satuan").val("");
				$("#pekerjaan").focus();
			}else{
				$(".modal-title").text("Edit Data");
				$("#id").val(data.id);
				$("#pekerjaan").val(data.pekerjaan);
				$("#satuan").val(data.satuan);
				$("#pekerjaan").focus();
			}
			
		}
	});
	return false;
}

function m_pekerjaan_nc_s() {
	var form = $('#f_type_nc').serialize();
	$.ajax({		
		type: "POST",
		url: base_url+"master/type_pekerjaan_simpan",
		data: form,
		dataType: 'json',
	}).done(function(response) {
		if (response.status == "ok") {
			window.location.assign(base_url+"master/type_pekerjaan"); 
		} else {
			console.log('gagal');
		}
	});
	return false;
}

function m_pekerjaan_nc_h(id) {
	if (confirm('Anda yakin..?')) {
		$.ajax({
			type: "GET",
			url: base_url+"master/type_pekerjaan_hapus/"+id,
			success: function(response) {
				if (response.status == "ok") {
					window.location.assign(base_url+"master/type_pekerjaan"); 
				} else {
					console.log('gagal');
				}
			}
		});
	}
	return false;
}

/* Kriterian Penilaian*/

/* Type Pekerjaan */
function m_kriteria_penilaian_e(id) {
	$("#m_type_nc").modal('show');
	$.ajax({
		type: "GET",
		url: base_url+"master/kriteria_penilaian_edit/"+id,
		success: function(data) {
			if (data.status==false){
				$(".modal-title").text("Tambah Data");
				$("#pekerjaan").val("");
				$("#pekerjaan").focus();
			}else{
				$(".modal-title").text("Edit Data");
				$("#id").val(data.id);
				$("#pekerjaan").val(data.pekerjaan_id);
				$("#kriteria").val(data.kriteria);
				$("#pekerjaan").focus();
			}
			
		}
	});
	return false;
}

function m_kriteria_penilaian_s() {
	/*
	var f_asal	= $("#f_type_nc");
	var form	= getFormData(f_asal);
	*/

	var form = $('#f_type_nc').serialize();
	$.ajax({		
		type: "POST",
		url: base_url+"master/kriteria_penilaian_simpan",
		data: form,
		dataType: 'json',
	}).done(function(response) {
		if (response.status == "ok") {
			window.location.assign(base_url+"master/kriteria_penilaian"); 
		} else {
			console.log('gagal');
		}
	});
	return false;
}

function m_kriteria_penilaian_h(id) {
	if (confirm('Anda yakin..?')) {
		$.ajax({
			type: "GET",
			url: base_url+"master/kriteria_penilaian_hapus/"+id,
			success: function(response) {
				if (response.status == "ok") {
					window.location.assign(base_url+"master/kriteria_penilaian"); 
				} else {
					console.log('gagal');
				}
			}
		});
	}
	return false;
}

$("#proses_kerja1").focusout(function(){
  	var proses_kerja1 = $("#proses_kerja1").val();
  	var proses_kerja2 = $("#proses_kerja2").val();
  	var project_id = $("#project_id").val();
  	$.ajax({
		type: "POST",
		url: base_url+"css/saveData/",
		dataType: 'json',
		data: {
			proses_kerja1 : proses_kerja1, 
			proses_kerja2 : proses_kerja2, 
			project_id : project_id
		},
		success: function(response) {
			if (response.status == "ok") {
				window.location.assign(base_url+"css_detail"); 
			} else {
				console.log('gagal');
			}
		}
	});
});

$("#proses_kerja2").focusout(function(){
  	var proses_kerja1 = $("#proses_kerja1").val();
  	var proses_kerja2 = $("#proses_kerja2").val();
  	var project_id = $("#project_id").val();
  	$.ajax({
		type: "POST",
		url: base_url+"css/saveData/",
		dataType: 'json',
		data: {
			proses_kerja1 : proses_kerja1, 
			proses_kerja2 : proses_kerja2, 
			project_id : project_id
		},
		success: function(response) {
			if (response.status == "ok") {
				window.location.assign(base_url+"css_detail"); 
			} else {
				console.log('gagal');
			}
		}
	});
});


/* Assesment */
function assesment_s() {
	var f_asal	= $("#f_assesment_s");
	var form	= getFormData(f_asal);

	var csrfName = $('#csrf_token').attr('name'); 
    var csrfHash = $('#csrf_token').val(); 

	$.ajax({		
		type: "POST",
		url: base_url+"assesment/save",
		data : $('#f_assesment_s').serialize(),
		dataType: 'json',
	}).done(function(response) {
		if (response.status == "ok") {
			toastr_option();
        	toastr.success(response.caption);
			//window.location.assign(base_url+"assesment/assesment_detail/"+response.project_id); 
		} else {
			console.log('gagal');
        	toastr.options.timeOut = 2500;
        	toastr.error(response.caption, 'Peringatan');
        	/*	
			toastr.error(
	          'Done',
	          'Added Successfully',
		        {
		          timeOut: 1000,
		          fadeOut: 1000,
		          onHidden: function () {
		           window.location.reload();
		         }
		       });*/
		}
	});
	return false;
}

/* Assesment */
function assesment_material_s() {
	$.ajax({		
		type: "POST",
		url: base_url+"assesment/save_material",
		data : $('#f_assesment_s').serialize(),
		dataType: 'json',
	}).done(function(response) {
		if (response.status == "ok") {
			window.location.assign(base_url+"assesment/assesment_material_detail/"+response.project_id); 
		} else {
			console.log('gagal');
		}
	});
	return false;
}


$('.form-select2').change(function() {
	//j = $(this).find('option:selected').text();
	//j = $(this).find('option:selected').attr("name");
	j = $("#oke option:selected").attr('name');
    //alert($(this).val()); // will work here
    alert(j);
});


$(".form-select-qa").change(function(){
   //alert($(this).attr('id'));
   
   var id = $(this).attr('id');
   var nilai = $(this).val();

   var score_maksimal =0;
   if (nilai >= 0) {
   	score_maksimal = 4;
   }else{
   	score_maksimal = 0;
   }

   $.ajax({
		type: "POST",
		url: base_url+"qsia/saveData/",
		dataType: 'json',
		data: {
			id : id, 
			nilai : nilai, 
		},
		success: function(response) {
			if (response.status == "ok") {
				$("#total_1_1").val(response.total_1);
				$("#total_2_1").val(response.total_2);
				$("#total_3_1").val(response.total_3);
				$("#total_4_1").val(response.total_4);
				$("#total_5_1").val(response.total_5);
				/*
				$("#total_1_2").val(response.total_1_1);
				$("#total_2_2").val(response.total_2_1);
				$("#total_3_2").val(response.total_3_1);
				$("#total_4_2").val(response.total_4_1);
				$("#total_5_2").val(response.total_5_1);
				$("#score_" + id).val(score_maksimal);
				*/
			} else {
				console.log('gagal');
			}
		}
	});
});

$(".form-select-qa-maksimal").change(function(){
   var nilai_item_id = $(this).attr('id');
   var nilai = $(this).val();

   $.ajax({
		type: "POST",
		url: base_url+"qsia/saveNilaiMaksimal/",
		dataType: 'json',
		data: {
			nilai_item_id : nilai_item_id, 
			nilai : nilai, 
		},
		success: function(response) {
			if (response.status == "ok") {
				$("#total_1_2").val(response.total_1);
				$("#total_2_2").val(response.total_2);
				$("#total_3_2").val(response.total_3);
				$("#total_4_2").val(response.total_4);
				$("#total_5_2").val(response.total_5);
			} else {
				console.log('gagal');
			}
		}
	});
});


/* ITEM SURVEY */
function m_item_survey_e(id) {
	$("#m_type_nc").modal('show');
	$.ajax({
		type: "GET",
		url: base_url+"master/item_survey_edit/"+id,
		success: function(data) {
			if (data.status==false){
				$(".modal-title").text("Tambah Data");
				$("#pekerjaan").val("");
				$("#pekerjaan").focus();
			}else{
				$(".modal-title").text("Edit Data");
				$("#id").val(data.id);
				$("#pekerjaan").val(data.survey);
				$("#pekerjaan").focus();
			}
			
		}
	});
	return false;
}

function m_item_survey_s() {

	var f_asal	= $("#f_type_nc");
	var form	= getFormData(f_asal);
	$.ajax({		
		type: "POST",
		url: base_url+"master/item_survey_simpan",
		data: JSON.stringify(form),
		dataType: 'json',
		contentType: 'application/json; charset=utf-8'
	}).done(function(response) {
		if (response.status == "ok") {
			window.location.assign(base_url+"master/item_survey"); 
		} else {
			console.log('gagal');
		}
	});
	return false;
}

function m_item_survey_h(id) {
	if (confirm('Anda yakin..?')) {
		$.ajax({
			type: "GET",
			url: base_url+"master/item_survey_hapus/"+id,
			success: function(response) {
				if (response.status == "ok") {
					window.location.assign(base_url+"master/item_survey"); 
				} else {
					console.log('gagal');
				}
			}
		});
	}
	return false;
}

/* Sumber NC */
function m_sumber_nc_s() {
	var f_asal	= $("#f_type_nc");
	var form = $('#f_type_nc').serialize();

	$.ajax({		
		type: "POST",
		url: base_url+"master/sumber_nc_simpan",
		data : form,
		dataType: 'json',
	}).done(function(response) {
		if (response.status == "ok") {
			window.location.assign(base_url+"master/sumber_nc"); 
		} else {
			console.log('gagal');
		}
	});
	return false;
}

function m_sumber_nc_h(id) {
	if (confirm('Anda yakin..?')) {
		$.ajax({
			type: "GET",
			url: base_url+"master/sumber_nc_hapus/"+id,
			success: function(response) {
				if (response.status == "ok") {
					window.location.assign(base_url+"master/sumber_nc"); 
				} else {
					console.log('gagal');
				}
			}
		});
	}
	return false;
}

/* Level NC */

function m_level_nc_e(id) {
	$("#m_type_nc").modal('show');
	$.ajax({
		type: "GET",
		url: base_url+"master/level_nc_edit/"+id,
		success: function(data) {
			if (data.status==false){
				$(".modal-title").text("Tambah Data");
				$("#level_nc").val("");
				$("#level_nc").focus();
			}else{
				$(".modal-title").text("Edit Data");
				$("#id").val(data.id);
				$("#level_nc").val(data.level_nc);
				$("#level_nc").focus();
			}
			
		}
	});
	return false;
}

function m_level_nc_s() {
	var f_asal	= $("#f_type_nc");
	var form = $('#f_type_nc').serialize();

	$.ajax({		
		type: "POST",
		url: base_url+"master/level_nc_simpan",
		data : form,
		dataType: 'json',
	}).done(function(response) {
		if (response.status == "ok") {
			window.location.assign(base_url+"master/level_nc"); 
		} else {
			console.log('gagal');
		}
	});
	return false;
}

function m_level_nc_h(id) {
	if (confirm('Anda yakin..?')) {
		$.ajax({
			type: "GET",
			url: base_url+"master/level_nc_hapus/"+id,
			success: function(response) {
				if (response.status == "ok") {
					window.location.assign(base_url+"master/level_nc"); 
				} else {
					console.log('gagal');
				}
			}
		});
	}
	return false;
}


/* MASTER VENDOR */
function m_vendor_e(id) {
	$("#m_vendor").modal('show');
	$.ajax({
		type: "GET",
		url: base_url+"master/vendor_edit/"+id,
		success: function(data) {
			if (data.status==false){
				$(".modal-title").text("Tambah Data");
				$("#nama_vendor").val("");
				$("#alamat").val("");
				$("#email").val("");
				$("#telepon").val("");
				$("#nama_vendor").focus();
			}else{
				$(".modal-title").text("Edit Data");
				$("#id").val(data.id);
				$("#nama_vendor").val(data.nama_vendor);
				$("#alamat").val(data.alamat);
				$("#email").val(data.email);
				$("#telepon").val(data.telepon);
				$("#nama_vendor").focus();
			}
			
		}
	});
	return false;
}

function m_vendor_s() {
	var f_asal	= $("#f_vendor");
	var form	= getFormData(f_asal);
	$.ajax({		
		type: "POST",
		url: base_url+"master/vendor_simpan",
		data: JSON.stringify(form),
		dataType: 'json',
		contentType: 'application/json; charset=utf-8'
	}).done(function(response) {
		if (response.status == "ok") {
			window.location.assign(base_url+"master/vendor"); 
		} else {
			console.log('gagal');
		}
	});
	return false;
}

function m_vendor_h(id) {
	if (confirm('Anda yakin..?')) {
		$.ajax({
			type: "GET",
			url: base_url+"master/vendor_hapus/"+id,
			success: function(response) {
				if (response.status == "ok") {
					window.location.assign(base_url+"master/vendor"); 
				} else {
					console.log('gagal');
				}
			}
		});
	}
	return false;
}

/* MASTER SUPPLIER */
function m_supplier_e(id) {
	$("#m_vendor").modal('show');
	$.ajax({
		type: "GET",
		url: base_url+"master/supplier_edit/"+id,
		success: function(data) {
			if (data.status==false){
				$(".modal-title").text("Tambah Data");
				$("#nama_vendor").val("");
				$("#alamat").val("");
				$("#email").val("");
				$("#telepon").val("");
				$("#nama_vendor").focus();
			}else{
				$(".modal-title").text("Edit Data");
				$("#id").val(data.id);
				$("#nama_vendor").val(data.nama_supplier);
				$("#alamat").val(data.alamat);
				$("#email").val(data.email);
				$("#telepon").val(data.telepon);
				$("#nama_vendor").focus();
			}
			
		}
	});
	return false;
}

function m_supplier_s() {
	var f_asal	= $("#f_vendor");
	var form	= getFormData(f_asal);
	$.ajax({		
		type: "POST",
		url: base_url+"master/supplier_simpan",
		data: JSON.stringify(form),
		dataType: 'json',
		contentType: 'application/json; charset=utf-8'
	}).done(function(response) {
		if (response.status == "ok") {
			window.location.assign(base_url+"master/supplier"); 
		} else {
			console.log('gagal');
		}
	});
	return false;
}

function m_supplier_h(id) {
	if (confirm('Anda yakin..?')) {
		$.ajax({
			type: "GET",
			url: base_url+"master/supplier_hapus/"+id,
			success: function(response) {
				if (response.status == "ok") {
					window.location.assign(base_url+"master/supplier"); 
				} else {
					console.log('gagal');
				}
			}
		});
	}
	return false;
}

function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];

    var fd = new FormData();
    var files = $('#file')[0].files;

    if(file){
    	fd.append('file',files[0]);
    	fd.append('tipe',1);

        var reader = new FileReader();

        reader.onload = function(){

            $("#previewImg").attr("src", reader.result);

             $.ajax({
              url: base_url + 'home/upload',
              type: 'POST',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){
                 if(response != 0){
                    //alert('File sudah tersimpan');
                 }else{
                    alert('File tidak bisa diupload');
                 }
              },
           });
        }

        reader.readAsDataURL(file);
    }
}

function previewFileLogo(input){

    var fd = new FormData();
    var files = $('#fileLogo')[0].files;

    if(files){

    	var file = $("input[type=file]").get(1).files[0];

    	var reader = new FileReader();
        reader.onload = function(){
        	$("#previewImgLogo").attr("src", reader.result);
        }
        reader.readAsDataURL(file);

    	fd.append('file',files[0]);
    	fd.append('tipe',2);
        $.ajax({
          url: base_url + 'home/upload',
          type: 'POST',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
             if(response != 0){
                //$("#previewImgLogo").attr("src",response); 
             }else{
                alert('File tidak bisa diupload');
             }
          },
       });
    }
}

function toastr_option() {
    toastr.options = {
        "newestOnTop": true, 
        "progressBar": false, 
        "positionClass": "toast-top-right", 
        "preventDuplicates": true, 
        "showDuration": 300, 
        "hideDuration": 500, 
        "timeOut": 500, 
        "extendedTimeOut": 500, 
        "showEasing": "swing", 
        "hideEasing": "linear", 
        "showMethod": "slideDown", 
        "hideMethod": "slideUp", 
        onHidden: function()
        {
        	window.location.reload();
        }
    }
}

/*
$('#level').change(function() {
	var tds = $(this).addClass('row-highlight').find('td');
    var values = '';
    var level = '';
    tds.each(function(index, item) {
    	if (index==0){
    		values = $(item).html();
    	}   

    	if (index==5){
    		level = $("#level").val();
    	}        
    });

    alert(level);

    if (confirm('Anda yakin..?')) {
		$.ajax({
			type: "POST",
			url: base_url+"observasi/update/"+values,
			data : {id : values, level : level},
			success: function(response) {
				if (response.status == "ok") {
					window.location.assign(base_url+"observasi"); 
				} else {
					console.log('gagal');
				}
			}
		});
	}
	return false;

});
*/

$('#thisTable tr').on('change', function(event) {    
    var tds = $(this).addClass('row-highlight').find('td');
    var values = '';
    var level = '';
    tds.each(function(index, item) {
    	if (index==0){
    		values = $(item).html();
    	}   

    	if (index==5){
    		level = $("#level").val();
    	}        
    });

    if (confirm('Anda yakin mau update level..?')) {
		$.ajax({
			type: "POST",
			url: base_url+"observasi/update",
			data : {id : values, level : level},
			success: function(response) {
				if (response.status == "ok") {
					//window.location.assign(base_url+"observasi"); 
				} else {
					console.log('gagal');
				}
			}
		});
	}
	return false;
});