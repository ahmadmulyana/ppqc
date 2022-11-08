<script>
    $('#nama_pekerjaan').on('change', function(){
        const selectedPackage = $('#nama_pekerjaan').val();
        $.ajax({
            type: "GET",
            url: base_url+"assesment/getDataSatuan/"+selectedPackage,
            success: function(data) {
                if (data.status=="ok"){
                    $('#satuan_pekerjaan').val(data.satuan);
                }else{
                    $('#satuan_pekerjaan').val(data.satuan);
                }
            }
        });
    });
</script>