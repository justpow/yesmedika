jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
jQuery('.quantity').each(function() {
  var spinner = jQuery(this),
    input = spinner.find('input[type="number"]'),
    btnUp = spinner.find('.quantity-up'),
    btnDown = spinner.find('.quantity-down'),
    min = input.attr('min'),
    max = input.attr('max');

  btnUp.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue >= max) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue + 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  btnDown.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue <= min) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue - 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

});

$( "#select_address" ).click(function() {

  // Check or Not
  if ( !$('input[name="selectAlamat"]').is(':checked') ) {
    Swal.fire({
      icon: 'error',
      title: '',
      text: 'Silahkan Pilih Alamat Terlebih Dahulu!'
    })
    return;
  }
  
  $.ajax({                                      
    url: "<?= base_url() ?>address/address/get_address?id="+$('input[name="selectAlamat"]:checked').val(),              
    type: "GET",
    dataType : 'json',
    success: function(data) {
      $('input[name="address_id"]').val(data[0].id);
      $('#nama_address').html('<small> '+ data[0].address_name +' </small>');
      $('#penerima_address').html('Penerima: '+ data[0].recipient_name +' ('+ data[0].phone_number +')');
      $('#alamat_address').html('<small>Alamat: '+ data[0].address +', Kelurahan '+ data[0].nama_kelurahan +', Kecamatan '+ data[0].nama_kecamatan +', '+ data[0].nama_kota +', '+ data[0].nama_provinsi +' '+ data[0].kode_pos +'</small>');
      $('#note_address').html('<small>Catatan: '+ data[0].note_address +'</small>');
      $('#gantiAlamat').modal('hide');
      $('input[name="selectAlamat"]').prop("checked", false);
      console.log(data[0].address_name);
    },
    error: function (jqXhr) {
      var error = $.parseJSON( jqXhr.responseText );
      Swal.fire('', error.msg, 'error');
    }
  });

});
