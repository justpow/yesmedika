<section class="head-product">
    <div class="container">
        <div class="card mt-page rounded-0 shadow-sm">
            <div class="card-body p-5">
                <div class="row">
                    <div id="image-product" class="col-md-6 px-2 py-2 text-center">
                        <img src="<?= base_url('assets/image/').json_decode($data['photo'])[0] ?>" class="img-fluid rounded" alt="Product image" width="400">
                        <div class="thumbnail d-flex justify-content-center flex-wrap mt-3 mx-auto" style="width:25rem;">
                            <div class="owl-carousel">
                                <?php foreach(json_decode($data['photo']) as $photo_name): ?>
                                <img src="<?= base_url('assets/image/').$photo_name ?>" class="rounded m-1" alt="Product image" width="60">
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div id="detail-product" class="col-md-6">
                        <form action="<?= base_url().'product/add-to-cart' ?>" method="post">
                            <input type="text" name="productId" value="<?= $data['id'] ?>" hidden>
                            <input type="text" id="variantId" name="variantId" value="<?php 
                                    if(isset($data['variants'])){ echo $data['variants'][0]['id'];} else { echo 0; }?>" hidden> 
                            <div class="komponen-detail ms-5">
                                <h3 class="text-uppercase fw-bold"><?= $data['name'] ?></h3>
                                <h4 id="price" class="fw-bold harga">Rp. <?php 
                                    if(isset($data['variants'])){ echo $data['variants'][0]['price'];} else { echo $data['price']; }?></h3>
                                <small><em>(Harga sudah termasuk pajak)</em></small>
                                <div class="add-to-cart mt-3">
                                    <?php if(isset($data['variants'])): ?>
                                    <p>Varian</p>
                                    <div class="btn-group d-flex">
                                        <?php foreach($data['variants'] as $variant): ?>
                                        <div class="btn-radio ms-1">
                                            <input onclick="variantListener(<?= $variant['id'] ?>,<?= $variant['price'] ?>)" type="radio" class="btn-check" name="options" id="<?= $variant['id'] ?>" autocomplete="off"/>
                                            <label class="btn btn-secondary" for="<?= $variant['id'] ?>"><?= $variant['name'] ?></label>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                        <?php endif; ?>
                                </div>
                                <div class="add-to-cart mt-3">
                                    <p>Jumlah Product</p>
                                    <div class="quantity">
                                        <input name="qty" type="number" min="1" max="9" step="1" value="1">
                                        <button id="btn-add-cart" type="submit" name="add2cart" class="btn btn-primary ms-2 mt-1 text-uppercase"><i class="fas fa-cart-plus me-1"></i> beli</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <div class="mt-5">
                    <h4 class="fw-bold">Detail Produk</h4>
                    <p><?= $data['description'] ?></p>
                </div>
                <div class="mt-5">
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
    </div>
</section>