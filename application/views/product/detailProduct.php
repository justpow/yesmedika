<section class="head-product">
    <div class="container">
        <div class="row mt-5 pt-5">
            <div id="image-product" class="col-md-6 px-2 py-2 text-center">
                <img src="<?= base_url('assets/image/').json_decode($data['photo'])[0] ?>" class="img-fluid rounded" alt="Product image" width="400" onclick="changeImage(this)" id="main_product_image">
                <div class="thumbnail d-flex justify-content-center flex-wrap mt-3 mx-auto" style="width:25rem;">
                    <div class="owl-carousel">
                        <?php foreach(json_decode($data['photo']) as $photo_name): ?>
                        <img src="<?= base_url('assets/image/').$photo_name ?>" class="rounded m-1" alt="Product image" width="10" onclick="changeImage(this)">
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
                            <p>Stok tersedia <b id="stock"><?php if(isset($data['variants'])){ echo $data['variants'][0]['stock'];} else { echo $data['stock'];} ?></b></p>
                        </div>
                        <div class="add-to-cart mt-3">
                            <?php if(isset($data['variants'])): ?>
                            <p>Varian</p>
                            <div class="btn-group d-flex">
                                <?php foreach($data['variants'] as $variant): ?>
                                <div class="btn-radio ms-1">
                                    <input onclick="variantListener(<?= $variant['id'] ?>,<?= $variant['price']?>,<?= $variant['stock']?>)" type="radio" class="btn-check" name="options" id="<?= $variant['id'] ?>" autocomplete="off"/>
                                    <label class="btn btn-outline-secondary" for="<?= $variant['id'] ?>"><?= $variant['name'] ?></label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                                <?php endif; ?>
                        </div>
                        <div class="add-to-cart mt-3">
                            <p>Jumlah Product</p>
                            <div class="quantity">
                                <input name="qty" id="qty_" type="number" min="1" max="<?php if(isset($data['variants'])){ echo $data['variants'][0]['stock'];} else { echo $data['stock'];} ?>" step="1" value="1">
                                <button id="btn-add-cart" type="submit" name="add2cart" class="btn btn-primary ms-2 mt-1 text-uppercase"><i class="fas fa-cart-plus me-1"></i> beli</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h4 class="fw-bold">Detail Produk</h4>
                    <p><?= $data['description'] ?></p>
                </div>
                <div class="mt-5">
                <h4 class="fw-bold">Ulasan</h4>
                    <div class="review-list" data-product-id="<?= $data['id']?>">
                     <!-- loading animation -->
                    <div class="scroller-status">
                        <div class="infinite-scroll-request loader-ellips">
                            <span class="loader-ellips__dot"></span>
                            <span class="loader-ellips__dot"></span>
                            <span class="loader-ellips__dot"></span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>