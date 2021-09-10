$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
      items: 4,
      margin:10,
      nav:false,
      responsive: {
        0: {
          items: 2
        },
        600: {
          items: 3
        },
        1000: {
          items: 4
        }
      }
  });
});

const transStat = {
  0 : 'Dibatalkan',
  1 : 'Menunggu Pembayaran',
  2 : 'Diproses',
  3 : 'Dikirim',
  4 : 'Sampai Tujuan',
  5 : 'Selesai'
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

// Triggered by status button.
$('.btn-check').click(e =>{
    submitFilter()
});


function submitFilter() {
  // Get status value.
  let status = $('input[name="transStat"]:checked').val();

  // Emptying the product list.
  $('.transaction-list').html('');

  // Destroy current infine scroll aka 'Lazy Scrolling'.
  $container.infiniteScroll('destroy');

  // Init Infinite Scroll along with defined query paramaters.
  $container = initInfiniteScroll(`per_page=${perPage}&status=${status}`);

  // Load first page.
  $container.infiniteScroll('loadNextPage');
}


function initInfiniteScroll(queryString) {
  return $('.transaction-list').infiniteScroll({
      path: function() {
          return `<?= base_url('transaction/transaction/history?page=${this.loadCount + 1}&${queryString}') ?>`
      },
      responseBody: 'json',
      status: '.scroller-status',
      hideNav: '.pagination',
      history: false,
      checkLastPage: false
  });
}

function loadPage(value) {
let photo = JSON.parse(value.trans_prod[0].product.photo)[0]
let moreItem = (value['trans_prod'].length > 1) ? `(...dan ${value['trans_prod'].length -1} item lainnya)` :''
let variant = value['trans_prod'][0]['variant'] ? value['trans_prod'][0]['variant']['name'] : '-'
let transId = value['id']

  return `<div class="col-12 mx-auto d-flex justify-content-center mb-4">
  <div class="card shadow-sm rounded-custom-1" style="width:40rem">
      <div class="card-body mx-2 my-2">
          <h6>No. Pesanan : INV/YES/${transId}</h6>
          <div class="d-flex mt-3">
              <div class="flex-shrink-0">
                  <img class="rounded-3" src="<?= base_url('/assets/image/${photo}') ?>" alt="Product Image" width="80">
              </div>
              <div class="flex-grow-1 ms-3">
                  <h5 class="mb-1">${value['trans_prod'][0]['product']['name']} <small style="font-size: 0.7em;"> ${moreItem} </small></h5>
                  <p class="mb-1"><small>Variasi: ${variant}</small></p>
                  <p class="mb-1"><small>Catatan: ${value['trans_prod'][0]['note']}</small></p>
              </div>
              
          </div>
          <div class="d-flex justify-content-between mt-2">
              <small class="my-auto">Tanggal Pesan: ${value['create_time']}</small>
              <p class="my-auto harga fw-bold text-end">Status: ${transStat[value['status']]}</p>
          </div>
          <div class="mt-3">
              <a href="<?= base_url('transaction/detail/${transId}') ?>" type="button" class="btn btn-secondary col-12 text-dark border-0">
                  Lihat Pesanan
              </a>
          </div>
      </div>
  </div>
</div>`
}