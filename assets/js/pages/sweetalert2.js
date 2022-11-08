$(document).ready(function(){
    // Success
    $(".sweetalert2-success").click(function() {
        Swal.fire(
        'Good job!',
        'You clicked the button!',
        'success'
        )
    });

    // Error
    $(".sweetalert2-error").click(function() {
        Swal.fire(
        'Good job!',
        'You clicked the button!',
        'error'
        )
    });

    // Info
    $(".sweetalert2-info").click(function() {
        Swal.fire(
        'Good job!',
        'You clicked the button!',
        'info'
        )
    });

    // Dialog
    $(".sweetalert2-dialog").click(function() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-primary',
              cancelButton: 'btn btn-outline-primary'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
              )
            }
          })
    });
});