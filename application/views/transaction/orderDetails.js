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
      $('input[name="address_string"]').val(data[0].address +', Kelurahan '+ data[0].nama_kelurahan +', Kecamatan '+ data[0].nama_kecamatan +', '+ data[0].nama_kota +', '+ data[0].nama_provinsi +' '+ data[0].kode_pos);
      $('#nama_address').html('<small> '+ data[0].address_name +' </small>');
      $('#penerima_address').html('Penerima: '+ data[0].recipient_name +' ('+ data[0].phone_number +')');
      $('#alamat_address').html('<small>Alamat: '+ data[0].address +', Kelurahan '+ data[0].nama_kelurahan +', Kecamatan '+ data[0].nama_kecamatan +', '+ data[0].nama_kota +', '+ data[0].nama_provinsi +' '+ data[0].kode_pos +'</small>');
      $('#note_address').html('<small>Catatan: '+ data[0].note_address +'</small>');
      $('#gantiAlamat').modal('hide');
      $('input[name="selectAlamat"]').prop("checked", false);
      if (data[0].nama_kota == "KOTA DEPOK") {
        $('#pickup-input').append(`<div class="d-flex text-center align-items-center mt-5" id="depok-only">
        <input class="form-check-input me-5" type="radio" onclick="setOngkirFree()" id="flexRadioDefault2" name="pickup_type" value="2">
        <div class="flex-shrink-0">
            <i class="fas fa-shipping-fast text-primary fs-1"></i>
        </div>
        <div class="flex-grow-1 ms-5">
            <p class="card-text mb-1">Kurir toko</p>
        </div>
        <div class="flex-grow-1 ms-1">
            <p class="card-text mb-1">Free</p>
        </div>
        </div>`)
      } else {
        $('#depok-only').remove()
      }

      $('.address-info').data('destinationcode', data[0].kode_ongkir)
      var destinationCode = data[0].kode_ongkir
      var totalWeight = "<?= $totalWeight ?>"
      var originCode = "<?= $originCode ?>"
      var courierType = $('#flexRadioDefault3').val()
      setJNEList(originCode, destinationCode, totalWeight, courierType)
    },
    error: function (jqXhr) {
      var error = $.parseJSON( jqXhr.responseText );
      Swal.fire('', error.msg, 'error');
    }
  });

});

// JNE Click
$( document ).ready(function() {
  var totalWeight = "<?= $totalWeight ?>"
  var destinationCode = $('.address-info').data('destinationcode')
  var originCode = "<?= $originCode ?>"
  var courierType = $('#flexRadioDefault3').val()
  setJNEList(originCode, destinationCode, totalWeight, courierType)
});

$( "#flexRadioDefault3" ).click(function() {
  var totalWeight = "<?= $totalWeight ?>"
  var destinationCode = $('.address-info').data('destinationcode')
  var originCode = "<?= $originCode ?>"
  var courierType = $('#flexRadioDefault3').val()
  setJNEList(originCode, destinationCode, totalWeight, courierType)
});

$( "#flexRadioDefault1" ).click(function() {
  var subTotal = $('.sub-total').data('subtotal')          
  $('.courier-fee').html("Free")
  $('.grand-total').html("Rp. " + subTotal)
});


function getOngkir(data) {
  var subTotal = $('.sub-total').data('subtotal')
  var ongkir = 0
  var type = ''
  ongkir = data.value.split('.')[0]
  type = data.value.split('.')[1]
  $('.courier-fee').data('courierfee', ongkir)
  $('.courier-fee').html("Rp. " + ongkir)

  var total =  parseInt(subTotal)+ parseInt(ongkir)
  $('.grand-total').html("Rp. " + total)
  
  $('#shipping-desc').val(type)
}

function setOngkirFree() {
  var subTotal = $('.sub-total').data('subtotal')          
  $('.courier-fee').html("Free")
  $('.grand-total').html("Rp. " + subTotal)
}

function setJNEList(originCode, destinationCode, totalWeight, courierType) {
  $('.stripText').html("")
  $('.courier-opt').html("")
  $('.loading').attr("hidden", false)

  $.ajax({
  url: "<?= base_url('courier/get-cost')?>",
  type: "post",
  data: {
    'origin': originCode,
    'destination': destinationCode,
    'weight': totalWeight,
    'courierType': courierType
  } ,
  success: function (response) {
    var opt = ''
    if (response && response.rajaongkir && response.rajaongkir.results && response.rajaongkir.results.length > 0) {
      var list = response.rajaongkir.results[0].costs
      for (let index = 0; index < list.length; index++) {
        const type = list[index];

        if (index == 0) {
          var subTotal = $('.sub-total').data('subtotal')
          
          // set initial ongkir
          $('.courier-fee').data('courierfee', type.cost[0].value)
          $('.courier-fee').html("Rp. " + type.cost[0].value)
          $('#shipping-desc').val(type.service)

          var total =  parseInt(subTotal)+ parseInt(type.cost[0].value)
          $('.grand-total').html("Rp. " + total)
        }

        opt += `<option value="${type.cost[0].value}.${type.service}" id="${type.service}">${type.service} (${type.cost[0].etd} hari) - Rp. ${type.cost[0].value}</option>`
      }
    }

    $('.loading').attr("hidden", true)
    $('.courier-opt').html(`<select onchange="getOngkir(this);" class="form-select form-select-sm courier-select" aria-label="Default select example">
    ${opt}
    </select>`)
  },
  error: function(jqXHR, textStatus, errorThrown) {
    console.error(textStatus, errorThrown);
    var error = $.parseJSON( jqXHR.responseText );
    Swal.fire('', error.msg, 'error');
  }
});
}