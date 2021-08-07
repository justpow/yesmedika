$( "#submit_ubah_password" ).click(function() {
    if( $( "#inputPassword" ).val() == "" || $( "#inputPassword2" ).val() == "" || $( "#inputPassword3" ).val() == "" ){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data Kata Sandi tidak boleh kosong'
        })
        return false;
    }

    if( $( "#inputPassword2" ).val() !== $( "#inputPassword3" ).val() ){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Kata sandi konfirmasi tidak sama'
        })
        return false;
    }

    Swal.fire({
        title: '',
        text: "Apakah anda yakin ingin mengubah password?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
        }).then((result) => {
        if (result.isConfirmed) {
            $( "#form_ubah_password" ).submit();
            // alert('masuk');
        }
    })
});

