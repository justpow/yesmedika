// Init Infinite Scroll.
let $container = initInfiniteScroll('per_page=6&sort_by=id&order_by=desc');

$container.on('load.infiniteScroll', function( event, data ) {
    // Compile body data into HTML.
    let itemsHTML = data.map( loadPage ).join('');

    // Convert HTML string into elements.
    let $items =  $( itemsHTML );
    
    // Append item elements.
    $container.infiniteScroll( 'appendItems', $items );
});

// Load initial page.
$container.infiniteScroll('loadNextPage');

// Triggered by search button.
$('#searchBtn').click(e =>{
    e.preventDefault();
    submitFilter()
});

// Triggered by enter button.
$('#productForm').submit(e =>{
    e.preventDefault();
    submitFilter()
});

function submitFilter() {
    // Get seach value.
    let query = $('#searchField').val();

    // Emptying the product list.
    $('.product-list').html('');

    // Get brand or category aka 'MEREK'.
    let brand = [];
    $("input[name='brand[]']:checked").each(function () {
        brand.push(parseInt($(this).val()));
    });
    
    // Get price range.
    let minPrice = $('#minPrice').val();
    let maxPrice = $('#maxPrice').val();

    // Define moreFilter for array value.
    let moreFilter = '';

    // Set param for brand.
    if (brand.length > 0) {
        moreFilter = `brand=${brand}`;
    }

    // Destroy current infine scroll aka 'Lazy Scrolling'.
    $container.infiniteScroll('destroy');

    // Init Infinite Scroll along with defined query paramaters.
    $container = initInfiniteScroll(`per_page=6&sort_by=id&order_by=desc&query=${query}&min=${minPrice}&max=${maxPrice}&${moreFilter}`);

    // Load first page.
    $container.infiniteScroll('loadNextPage');
}


function initInfiniteScroll(queryString) {
    return $('.product-list').infiniteScroll({
        path: function() {
            return `<?= base_url('product/product?page=${this.loadCount + 1}&${queryString}') ?>`
        },
        responseBody: 'json',
        status: '.scroller-status',
        hideNav: '.pagination',
        history: false,
        checkLastPage: false
    });
}

function loadPage(data) {
    return `<div class="col-lg-4 col-md-6 col-6 mb-3 mt-3">
                <div class="card shadow-sm text-center rounded-custom-1">
                    <img src="<?= base_url('assets/image/${JSON.parse(data.photo)[0]}') ?>" class="card-img-top rounded-custom-1 rounded-custom-2 product" alt="product">
                    <div class="card-body">
                        <h5 class="card-title">${data.name}</h5>
                        <p class="card-text harga fw-bold">Rp. ${data.price}</p>
                    </div>
                    <div class="cover rounded-custom-1">
                        <a href="<?= base_url('product/${data.id}') ?>" class="btn text-light" type="button" id="button-addon2"><i class="fas fa-search"></i>
                        <p class="title">Lihat Detail</p>
                        </a>
                    </div>
                </div>
            </div>`
}