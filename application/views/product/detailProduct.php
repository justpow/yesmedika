<section class="head-product">
    <div class="container">
        <div class="row mt-5">
            <div id="image-product" class="col-md-6 d-flex px-2 py-2">
                <img src="<?= base_url('assets/image/perban.jpg') ?>" class="img-fluid rounded mx-auto my-auto" alt="Product image" width="400">
                <div class="thumbnail d-flex flex-column justify-content-around">
                    <img src="<?= base_url('assets/image/perban.jpg') ?>" class="rounded" alt="Product image" width="100">
                    <img src="<?= base_url('assets/image/perban.jpg') ?>" class="rounded" alt="Product image" width="100">
                    <img src="<?= base_url('assets/image/perban.jpg') ?>" class="rounded" alt="Product image" width="100">
                </div>
            </div>
            <div id="detail-product" class="col-md-6">
                <div class="komponen-detail ms-5">
                    <h3 class="text-uppercase fw-bold">Perban Serbaguna</h3>
                    <h4 class="text-danger fw-bold">Rp. 50.000</h3>
                    <small><em>(Harga sudah termasuk pajak)</em></small>
                    <div class="add-to-cart mt-3">
                        <p>Varian</p>
                        <div class="btn-group d-flex">
                            <div class="btn-radio">
                                <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked/>
                                <label class="btn btn-secondary" for="option1">Putih</label>
                            </div>
                            <div class="btn-radio ms-1">
                                <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" />
                                <label class="btn btn-secondary" for="option2">Hitam</label>
                            </div>
                        </div>
                    </div>
                    <div class="add-to-cart mt-3">
                        <p>Jumlah Product</p>
                        <div class="quantity">
                            <input type="number" min="1" max="9" step="1" value="1">
                            <button id="btn-add-cart" type="button" class="btn btn-primary ms-2 mt-1 text-uppercase"><i class="fas fa-cart-plus me-1"></i> beli</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-5 rounded-0">
            <div class="card-body shadow">
                <h4 class="fw-bold">Detail Produk</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus neque placeat quisquam cum ex, illum dolor, accusamus, impedit magnam voluptatem nihil! Quia veniam numquam magnam ullam ratione ipsam dolorum qui?</p>
            </div>
        </div>
        <div class="card mt-5 rounded-0">
            <div class="card-body shadow">
                <h4 class="fw-bold">Ulasan</h4>
                <div class="card mt-1 rounded-0 border-0">
                    <div class="card-body d-flex">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="<?= base_url('assets/image/profile.png')?>" class="rounded float-start" alt="Foto Profile" width="70" height="70">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="fw-bold mb-0">Satrio</h4>
                                <div class="stars-outer" style="order:1;">
                                    <div class="stars-inner" style="width:40% !important; "></div>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus incidunt doloribus accusamus ipsa fuga voluptatum ipsam omnis facilis similique nemo dicta, dolorem ad est animi recusandae cumque dolores reiciendis.!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-1 rounded-0 border-0">
                    <div class="card-body d-flex">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="<?= base_url('assets/image/profile.png')?>" class="rounded float-start" alt="Foto Profile" width="70" height="70">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="fw-bold mb-0">Satrio</h4>
                                <div class="stars-outer" style="order:1;">
                                    <div class="stars-inner" style="width:40% !important; "></div>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus incidunt doloribus accusamus ipsa fuga voluptatum ipsam omnis facilis similique nemo dicta, dolorem ad est animi recusandae cumque dolores reiciendis.!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>