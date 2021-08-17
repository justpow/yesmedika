// Get Value for Province List
$(document).ready(async () => {
    $.ajax({                                      
        url: "<?=base_url()?>address/address/get_wilayah/provinsi",              
        type: "GET",
        dataType : 'json',
        success: function(data) {
            // console.log(data);
            $.each(data, function(key, value) {
                $('#provinsiOptions').append("<option data-id='"+ value.kode +"' value='"+ value.nama + "'>");
            });
        }
    });
});

// Get Value for City List
$( '#provinsi' ).change(function() {
    $('#kotaOptions').html('');
    $('#kota').val('');
    $('#kecamatanOptions').html('');
    $('#kecamatan').val('');
    $('#kelurahanOptions').html('');
    $('#kelurahan').val('');
    const Value = document.querySelector('#provinsi').value;
    if(!Value) return;
    const kode_provinsi = document.querySelector('option[value="' + Value + '"]').getAttribute('data-id');
    $.ajax({                                      
        url: "<?=base_url()?>address/address/get_wilayah/kota/"+kode_provinsi,              
        type: "GET",
        dataType : 'json',
        success: function(data) {
            // console.log(data);
            $.each(data, function(key, value) {
                $('#kotaOptions').append("<option data-id='"+ value.kode +"' value='"+ value.nama + "'>");
            });
        }
    });
});

// Get Value for Kecamatan List
$( '#kota' ).change(function() {
    $('#kecamatanOptions').html('');
    $('#kecamatan').val('');
    $('#kelurahanOptions').html('');
    $('#kelurahan').val('');
    const Value = document.querySelector('#kota').value;
    if(!Value) return;
    const kode_kota = document.querySelector('option[value="' + Value + '"]').getAttribute('data-id');
    $.ajax({                                      
        url: "<?=base_url()?>address/address/get_wilayah/kecamatan/"+kode_kota,              
        type: "GET",
        dataType : 'json',
        success: function(data) {
            console.log(data);
            $.each(data, function(key, value) {
                $('#kecamatanOptions').append("<option data-id='"+ value.kode +"' value='"+ value.nama + "'>");
            });
        }
    });
});

// Get Value for Kelurahan List
$( '#kecamatan' ).change(function() {
    $('#kelurahanOptions').html('');
    $('#kelurahan').val('');
    const Value = document.querySelector('#kecamatan').value;
    if(!Value) return;
    const kode_kecamatan = document.querySelector('option[value="' + Value + '"]').getAttribute('data-id');
    $.ajax({                                      
        url: "<?=base_url()?>address/address/get_wilayah/kelurahan/"+kode_kecamatan,              
        type: "GET",
        dataType : 'json',
        success: function(data) {
            console.log(data);
            $.each(data, function(key, value) {
                $('#kelurahanOptions').append("<option data-id='"+ value.kode +"' value='"+ value.nama + "'>");
            });
        }
    });
});


// check provinsi, city, kecamatan, kelurahan
$( "#add_address" ).click(function() {

    // Condition for Validation Form
    if ( validate_form() == 0 )
    {
        return;
    }

    // Ajax for Check Wilayah
    var val_prov        = $( '#provinsi' ).val();
    var val_kota        = $( '#kota' ).val();
    var val_kecamatan   = $( '#kecamatan' ).val();
    var val_kelurahan   = $( '#kelurahan' ).val();

    $.ajax({                                      
        url: "<?=base_url()?>address/address/check_kode_wilayah",              
        type: "post",
        dataType : 'json',
        data: {
            provinsi : val_prov,
            kota : val_kota,
            kecamatan : val_kecamatan,
            kelurahan : val_kelurahan,
        },
        success: function(data) {
            console.log(data);
            if ( data.kode == 0)
            {
                Swal.fire(
                    'Oops,',
                    data.message,
                    'error'
                )
                return;
            }
        }
           
    });

    // Get Value Id Wilayah for save to DB
    const kode_prov = document.querySelector('#provinsi').value;
    const kode_prov1 = document.querySelector('option[value="' + kode_prov + '"]').getAttribute('data-id');
    $( '#provinsiId' ).val(kode_prov1);

    const kode_kota = document.querySelector('#kota').value;
    const kode_kota1 = document.querySelector('option[value="' + kode_kota + '"]').getAttribute('data-id');
    $( '#kotaId' ).val(kode_kota1);

    const kode_kecamatan = document.querySelector('#kecamatan').value;
    const kode_kecamatan1 = document.querySelector('option[value="' + kode_kecamatan + '"]').getAttribute('data-id');
    $( '#kecamatanId' ).val(kode_kecamatan1);

    const kode_kelurahan = document.querySelector('#kelurahan').value;
    const kode_kelurahan1 = document.querySelector('option[value="' + kode_kelurahan + '"]').getAttribute('data-id');
    $( '#kelurahanId' ).val(kode_kelurahan1);

    // Submit Form
    $( '#add_address_submit' ).submit();
})

// Check Validation Error
function validate_form()
{
    let form_input = [];
    var result = 1;

    $( ".form_address" ).each(function() {
        form_input.push( $(this) );
    });

    form_input.reverse();
    
    form_input.map(data => {
        if ( data.val() == "" ) 
        {
            Swal.fire(
                'Oops,',
                $("label[for=" + data.attr('id') + "]").text() + ' Tidak Boleh Kosong',
                'error'
            )
            result = 0;
        }
    });
    return result;
}

// Set Input Only Numbers
(function($) 
{
    $.fn.inputFilter = function(inputFilter) {
      return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    };
}(jQuery));

$( ".numbers" ).inputFilter(function(value) {
    return /^-?\d*$/.test(value); 
});


// Logic Button Edit Address
$( '.btn-edit' ).click(function(){

    $( '#showUtama' ).hide();
    var id = $(this).attr('data-id');
    $( '#add_address_submit' ).attr('action', '<?= base_url("address/address/update_address_submit/'+id+'") ?>');

    $.ajax({                                      
        url: "<?=base_url()?>address/address/get_address?id="+id,              
        type: "GET",
        dataType : 'json',
        success: function(data) {
            console.log(data);
            $( '#namaAlamat' ).val(data[0].address_name);
            $( '#namaPenerima' ).val(data[0].recipient_name);
            $( '#noTelp' ).val(data[0].phone_number);
            $( '#detailAlamat' ).val(data[0].address);
            $( '#noteAlamat' ).val(data[0].note_address);
            $( '#provinsi' ).val(data[0].nama_provinsi);
            $( '#kota' ).val(data[0].nama_kota);
            $( '#kecamatan' ).val(data[0].nama_kecamatan);
            $( '#kelurahan' ).val(data[0].nama_kelurahan);
            $( '#inputZip' ).val(data[0].kode_pos);

            let_get_provinsi();
        }
    });    

});

function let_get_provinsi()
{
    // Get Data for Update Kota
    const value_provinsi = $( '#provinsi' ).val();
    if(!value_provinsi) return;
    const selected_provinsi = document.querySelector('option[value="' + value_provinsi + '"]').getAttribute('data-id');  
    if(selected_provinsi){
        $(document).ready(async () => {
            $.ajax({                                      
                url: "<?=base_url()?>address/address/get_wilayah/kota/"+selected_provinsi,              
                type: "GET",
                dataType : 'json',
                success: function(data) {
                    $('#kotaOptions').html('');
                    $.each(data, function(key, value) {
                        $('#kotaOptions').append("<option data-id='"+ value.kode +"' value='"+ value.nama + "'>");
                    });
                    let_get_kota();
                }
            });
        });
    }
}

function let_get_kota()
{
    // Get Data for Update Kecamatan
    const value_kota = $( '#kota' ).val();
    if(!value_kota) return;
    const selected_kota = document.querySelector('option[value="' + value_kota + '"]').getAttribute('data-id');  
    if(selected_kota){
        $(document).ready(async () => {
            $.ajax({                                      
                url: "<?=base_url()?>address/address/get_wilayah/kecamatan/"+selected_kota,              
                type: "GET",
                dataType : 'json',
                success: function(data) {
                    $('#kecamatanOptions').html('');
                    $.each(data, function(key, value) {
                        $('#kecamatanOptions').append("<option data-id='"+ value.kode +"' value='"+ value.nama + "'>");
                    });
                    let_get_kecamatan();
                }
            });
        });
    }
}

function let_get_kecamatan()
{
    // Get Data for Update Kelurahan
    const value_kecamatan = $( '#kecamatan' ).val();
    if(!value_kecamatan) return;
    const selected_kecamatan = document.querySelector('option[value="' + value_kecamatan + '"]').getAttribute('data-id');  
    if(selected_kecamatan){
        $(document).ready(async () => {
            $.ajax({                                      
                url: "<?=base_url()?>address/address/get_wilayah/kelurahan/"+selected_kecamatan,              
                type: "GET",
                dataType : 'json',
                success: function(data) {
                    $('#kelurahanOptions').html('');
                    $.each(data, function(key, value) {
                        $('#kelurahanOptions').append("<option data-id='"+ value.kode +"' value='"+ value.nama + "'>");
                    });
                }
            });
        });
    }
}

// Change Action Submit for Tambah Alamat Button
$( '#btn_tambah_alamat' ).click(function(){

    $( '#showUtama' ).show();
    $( '#add_address_submit' ).attr('action', '<?= base_url("address/address/add_address_submit") ?>');

});

// Logic Button Delete Address
$( '.delete_address' ).click(function(){

    Swal.fire({
        title: '',
        text: "Apakah anda yakin ingin menghapus alamat ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?=base_url()?>address/address/delete_address?id="+$(this).attr('data-id');
        }
    })

});


