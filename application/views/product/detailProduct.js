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

$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
    margin:5,
    nav: false,
    responsive:{
        0:{
            items:5,
            nav:true
        },
        600:{
            items:5,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
  });
});

 // Set price by selected variant.
 function variantListener(id, price, stock) {
  $('#price').html(`Rp. ${price}`);
  $('#variantId').val(id);
  $('#stock').html(stock);
  $('#qty_').attr('max', stock);
}

const perPage = 10


// Init Infinite Scroll.
let $container = initInfiniteScroll(`per_page=${perPage}`);

$container.on('load.infiniteScroll', function( event, data ) {
  console.log(data)
    // Compile body data into HTML.
    let itemsHTML = data.map( loadPage ).join('');

    // Convert HTML string into elements.
    let $items =  $( itemsHTML );
    
    // Append item elements.
    $container.infiniteScroll( 'appendItems', $items );
});

// Load initial page.
$container.infiniteScroll('loadNextPage');

// // Triggered by status button.
// $('.btn-check').click(e =>{
//     submitFilter()
// });


// function submitFilter() {
//   // Get status value.
//   let status = $('input[name="transStat"]:checked').val();

//   // Emptying the product list.
//   $('.transaction-list').html('');

//   // Destroy current infine scroll aka 'Lazy Scrolling'.
//   $container.infiniteScroll('destroy');

//   // Init Infinite Scroll along with defined query paramaters.
//   $container = initInfiniteScroll(`per_page=${perPage}&status=${status}`);

//   // Load first page.
//   $container.infiniteScroll('loadNextPage');
// }


function initInfiniteScroll(queryString) {
  let productId = $('.review-list').data('product-id');
  return $('.review-list').infiniteScroll({
      path: function() {
          return `<?= base_url('rating/list?product_id=${productId}&page=${this.loadCount + 1}&${queryString}') ?>`
      },
      responseBody: 'json',
      status: '.scroller-status',
      hideNav: '.pagination',
      history: false,
      checkLastPage: false
  });
}

function loadPage(value) {
let rating = value['rate']*20;
  return `<div class="card mt-1 rounded-0 border-0">
    <div class="card-body d-flex">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <img src="<?= base_url('assets/image/profile.png')?>" class="rounded float-start" alt="Foto Profile" width="70" height="70">
            </div>
            <div class="flex-grow-1 ms-3">
                <h4 class="fw-bold mb-0">Satrio</h4>
                <div class="stars-outer" style="order:1;">
                    <div class="stars-inner" style="width:${rating}% !important; "></div>
                </div>
                <p>${value['comment']}</p>
            </div>
        </div>
    </div>
</div>
`
}