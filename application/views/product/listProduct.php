
<form action="<?= base_url('home/cari_produk/');?>" id="productForm" method="get">
    <section class="head-home">
        <div id="head-home" class="position-relative overflow-hidden p-3 p-md-5 text-center bg-dark text-light">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 fw-normal">YESMedika Alkes</h1>
                <p class="lead fw-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab cupiditate earum soluta culpa alias iure labore dicta. Velit soluta, possimus ea eos earum exercitationem libero. Ex quae incidunt eos optio.</p>
                <div class="input-group mb-3">
                    <input id="searchField" type="text" class="form-control" placeholder="Cari..." aria-label="Search bar" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="searchBtn"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </section>
    <section class="main-menu">
        <div class="container my-5">
            <div class="row">
                <div class="card-filter col-md-12 col-lg-3">
                    <h6 class="fw-bold my-3">FILTER</h6>
                    <div class="card shadow" >
                        <ul class="list-group">
                            <li class="list-group-item" type="button" data-bs-toggle="collapse" data-bs-target="#merekCollapse">Merek</li>
                            <div class="collapse show multi-collapse" id="merekCollapse">
                                <div class="card card-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="2" id="mrk_soft" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="mrk_soft">
                                            Softies
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="mrk_sensi" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="mrk_sensi">
                                            Sensi
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <li class="list-group-item" type="button" data-bs-toggle="collapse" data-bs-target="#hargaCollapse">Harga</li>
                            <div class="collapse show multi-collapse" id="hargaCollapse">
                                <div class="card card-body">
                                    <label for="harga-minimum" class="form-label">Harga Minimum</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input id="minPrice" type="number" class="form-control" placeholder="Harga Minimum" name="price[]">
                                    </div>
                                    <label for="harga-maksimum" class="form-label">Harga Maksimum</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input id="maxPrice" type="number" class="form-control" placeholder="Harga Maksimum" name="price[]">
                                    </div>
                                    <button type="submit" style="display:none;"></button>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="card-product col-md-12 col-lg-9">
                    <div class="row product-list">

                    </div>
                    <!-- loading animation -->
                    <div class="scroller-status">
                        <div class="infinite-scroll-request loader-ellips">
                            <span class="loader-ellips__dot"></span>
                            <span class="loader-ellips__dot"></span>
                            <span class="loader-ellips__dot"></span>
                        </div>
                        <p class="infinite-scroll-last">End of content</p>
                        <p class="infinite-scroll-error">No more pages to load</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
