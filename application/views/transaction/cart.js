$('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
$('.quantity').each(function() {
  var spinner = $(this),
    input = spinner.find('input[type="number"]'),
    btnUp = spinner.find('.quantity-up'),
    btnDown = spinner.find('.quantity-down'),
    min = input.attr('min'),
    max = input.attr('max');
  
  let id = input.attr('id');
  id = id.replace('qty', 'price')
  btnUp.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue >= max) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue + 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
    let price =  $('#'+id+' .prc').html()
    let totalPrice = parseInt($('#totalPrice').html())
    if ($('#'+id.replace('price_', '')).is(':checked')) {
      totalPrice -= $('#'+id).data('price')
      totalPrice += price*newVal
      $('#totalPrice').html(totalPrice)
    }
    $('#'+id).attr('data-price', price*newVal)
    $('#'+id).data('price', price*newVal)
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
    let price =  $('#'+id+' .prc').html()
    let totalPrice = parseInt($('#totalPrice').html())
    if ($('#'+id.replace('price_', '')).is(':checked')) {
      totalPrice -= $('#'+id).data('price')
      totalPrice += price*newVal
      $('#totalPrice').html(totalPrice)
    }
    $('#'+id).attr('data-price', price*newVal)
    $('#'+id).data('price', price*newVal)
  });

});

// Set select all.
$('#selectAll').click(function(e) {
  $('.select-all-listener').prop('checked', e.target.checked);
  $('.select-all-listener').val(e.target.checked);
  if (e.target.checked) {
    initialValue()
  } else {
    resetValue()
  }
})

function setChecked (e) {
  // Uncheck select all.
  $('#selectAll').prop('checked', false);
  
  // Get checked value.
  let check = $("#"+e).is(':checked')
  $("#"+e).val(check)

  // Set total price.
  let totalPrice = parseInt($('#totalPrice').html())
  if (check) {
    totalPrice += $('#price_'+e).data('price')
  } else {
    totalPrice -= $('#price_'+e).data('price')
  }
  
  $('#totalPrice').html(totalPrice)

  // Set total item.
  let totalItem = parseInt($('#totalItem').html())
  if (check) {
    totalItem += 1
  } else {
    totalItem -= 1
  }
  
  $('#totalItem').html(totalItem)

}


$( document ).ready(function() {
  initialValue();
});


function initialValue() {
  let totalPrice = 0;
  let totalItem = 0;
  $('.select-all-listener').each((index, data) => {
    if (data.checked) {
      totalPrice += $('#price_'+data.id).data('price')
      console.log(totalPrice)
      totalItem += 1
    }
  })

  $('#totalPrice').html(totalPrice)
  $('#totalItem').html(totalItem)
}


function resetValue() {
  $('#totalPrice').html(0)
  $('#totalItem').html(0)
}