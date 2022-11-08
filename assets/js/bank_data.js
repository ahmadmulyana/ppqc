Dropzone.autoDiscover = false;

$(document).ready(function(){
    $("div#upload-temuan").dropzone({
        url: "nc/uploadNC",
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
        url: "nc/uploadNC",
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
        url: "nc/uploadNC",
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


    

});

