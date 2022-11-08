Dropzone.autoDiscover = false;
$(document).ready(function(){
    var goToStep =0;

    if (page=="edit_nc"){
      goToStep = step;
      $('#smartwizard').smartWizard("goToStep", step);
    }
  
    $("div#upload-temuan").dropzone({
        url: base_url + "nc/uploadNC",
        params: { type : 1},
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        removedfile: function(file) {
           var name = file.name; 
           var id = file.id
           $.ajax({
             type: 'POST',
             url: 'nc/removeImage',
             data: {name: name, request: 2, id : id, type : 1},
             sucess: function(data){
                console.log('success: ' + data);
             }
           });
           var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
         }
    });

    $("div#upload-investigasi").dropzone({
        url: base_url + "nc/uploadNC",
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        removedfile: function(file) {
           var name = file.name; 
           var id = file.id
           $.ajax({
             type: 'POST',
             url: 'nc/removeImage',
             data: {name: name, request: 2, id : id},
             sucess: function(data){
                console.log('success: ' + data);
             }
           });
           var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
         }
    });

    $("div#upload-realisasi").dropzone({
        url: base_url + "nc/uploadNC",
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        removedfile: function(file) {
           var name = file.name; 
           $.ajax({
             type: 'POST',
             url: 'nc/removeImage',
             data: {name: name,request: 2},
             sucess: function(data){
                console.log('success: ' + data);
             }
           });
           var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
         }
    });

    /*
    var file_image = "http://someserver.com/myimage.jpg";
    var mockFile = { name: "myimage.jpg", size: 12345 };
    $("div#my-dropzone").dropzone({
        url: base_url + "nc/getImage",
        maxFiles: 1,
        maxFilesize:10,//mb
        acceptedFiles:'image/*',
        init: function() {
            this.on("addedfile", function(file){
                this.options.thumbnail.call(this,file,file_image);
             });
             //this.addFile.emit(this,mockFile);
        }
    });*/
/*
    var myDropzoneTemuan = new Dropzone(
        '#upload_temuan_edit2', { 
            url : "#",
            autoProcessQueue: true,
            clickable: false,
            
        },

        $.ajax({
          url: base_url + "nc/getImage",
          type: 'post',
          data: {request: 2},
          dataType: 'json',
          success: function(response){
            $.each(response, function(key,value) {
              var mockFile = { name: value.name, size: value.size };
              myDropzoneTemuan.options.addedfile.call(myDropzoneTemuan, mockFile);
              myDropzoneTemuan.options.thumbnail.call(myDropzoneTemuan, mockFile, value.path);
              myDropzoneTemuan.options.complete.call(myDropzoneTemuan, mockFile);
            });
          }
        })
    );
*/

/*
    var oakDropzone = new Dropzone("#upload_temuan_edit", {
    url: base_url + "nc/getImage",
    init: function () {

        var trabajoId = $("#trabajoId").val();
        var getArchivosUrl = base_url + "nc/getImages?request=2"; //"/trabajo/getArchivosByTrabajo?trabajoId=" + trabajoId;

        $("#fileLoader").show();

        $.get(getArchivosUrl)
            .done(function (response) {

                for (var i = 0; i < response.data.length; i++) {

                    var file = response.data[i];
                    var fileData = { id: file.Id, name: file.Nombre, size: file.Tamaño, metadata: file.Metadata };
                    fileData.accepted = true;

                    oakDropzone.files.push(fileData);
                    oakDropzone.emit('addedfile', fileData);
                    oakDropzone.emit('thumbnail', fileData, 'data:' + response.data[i].Extension + ';base64,' + response.data[i].Preview);
                    oakDropzone.emit('complete', fileData);

                    $(oakDropzone.element[oakDropzone.element.length - 1]).attr('data-file-id', fileData.id);
                }

                $("#fileLoader").hide();

                $('#oakDropzone #template .dz-details .actionButtons .downloadFile').on('click', function (event) {

                    event.preventDefault();

                    var archivoId = $(this).data('file-id');

                    var downloadUrl = "http://localhost:11154/trabajo/downloadFile?fileId=" + archivoId;

                    window.open(downloadUrl, 'blank');
                });

            }).catch(function (response) {

                displayErrorToaster(response);
            });

        this.on("sending", function (file, xhr, formData) {

            formData.append("Id", trabajoId);
            formData.append("File", file);
        });

        this.on("success", function (file, response) {

            file.id = response.data;

            $(oakDropzone.element[oakDropzone.element.length - 1]).attr('data-file-id', file.id);

            displaySuccessToaster(response);
        });

        this.on("removedfile", function (file) {

            var deleteUrl = "/trabajo/RemoveFile?fileId=" + file.id;

            $.post(deleteUrl)
                .done(function (response) {
                    displaySuccessToaster(response);
                }).catch(function (response) {
                    displayErrorToaster(response);
                });
        });
    },
    
    dictRemoveFileConfirmation: 'Realmente desea quitar el archivo seleccionado?',
    dictDefaultMessage: '',
    clickable: "#btnUploadFile",
    previewTemplate: document.querySelector('#previews').innerHTML,
    addRemoveLinks: false
});
*/

    var myDropzoneTheFirst = new Dropzone(
        '#upload_investigasi_edit', { 
            url: base_url + "nc/uploadNC",
            params: { type : 2},
            autoProcessQueue: true,

            /*
            success: function (file, response) {
            if(response != 0){
               var anchorEl = document.createElement('a');
               anchorEl.setAttribute('href', base_url+response);
               anchorEl.setAttribute('target','_blank');
               anchorEl.innerHTML = "<center>Download</center>";
               file.previewTemplate.appendChild(anchorEl);
              }
            },*/
          
            addRemoveLinks: true,
            /*
            init: function() {
                this.on("complete", function(file) {
                    $(".dz-remove").html("<div><span class='fa fa-trash text-danger' style='font-size: 1.5em; cursor:pointer;'></span></div>");
                });
            },*/

            removedfile: function(file) {
            var name = file.name; 
            $.ajax({
               type: 'POST',
               url: base_url + 'nc/removeImage',
               dataType: 'json',
               data: {name: name, request: 2},
               sucess: function(data){
                  console.log('success: ' + data);
               }
             });
             var _ref;
              return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
           }
        },

        $.ajax({
          url: base_url + "nc/getImageInvestigasi",
          type: 'post',
          data: {request: 2},
          dataType: 'json',
          success: function(response){
            $.each(response, function(key,value) {
              var mockFile = { name: value.name, size: value.size };
              myDropzoneTheFirst.options.addedfile.call(myDropzoneTheFirst, mockFile);
              myDropzoneTheFirst.options.thumbnail.call(myDropzoneTheFirst, mockFile, value.path);
              myDropzoneTheFirst.options.complete.call(myDropzoneTheFirst, mockFile);
            });
          }
        })
    );


    var upload_closing = new Dropzone(
        '#upload_closing', { 
            url: base_url + "nc/uploadNC",
            params: { type : 3},
            autoProcessQueue: true,
            addRemoveLinks: true,
            removedfile: function(file) {
            var name = file.name; 
            $.ajax({
               type: 'POST',
               url: base_url + 'nc/removeImage',
               dataType: 'json',
               data: {name: name,request: 2},
               sucess: function(data){
                  console.log('success: ' + data);
               }
             });
             var _ref;
              return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
           }
        },

        $.ajax({
          url: base_url + "nc/getImageRealisasi",
          type: 'post',
          data: {request: 2},
          dataType: 'json',
          success: function(response){
            $.each(response, function(key,value) {
              var mockFile = { name: value.name, size: value.size };
              upload_closing.options.addedfile.call(upload_closing, mockFile);
              upload_closing.options.thumbnail.call(upload_closing, mockFile, value.path);
              upload_closing.options.complete.call(upload_closing, mockFile);
            });
          }
        })
    );
});