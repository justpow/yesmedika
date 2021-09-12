<section class="cart">
    <div class="container min-height1">
        <form action="<?= base_url().'transaction/precheckout' ?>" method="POST">
            <div class="row mt-page">
                <h5 class="fw-bold">Keranjang</h5>
                <?php if (empty($data)) { ?>
                    <div id="notfound" class="text-center mt-5">
                        <div class="notfound">
                            <h6>Maaf, Anda belum memiliki produk pada keranjang</h6>
                            <p>Silahkan pilih produk dan masukan ke keranjang!</p>
                            <a href="<?= base_url('') ?>">Kembali ke Halaman Utama</a>
                        </div>
                    </div>  
                <?php } else { ?>
                <div class="col-lg-7">
                    <?php if ($this->session->flashdata('checkout_error')): ?>
                      <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('checkout_error') ?>
                      </div>
                    <?php endif; ?>
                    <div class="form-check mt-5 mb-2">
                        <input checked class="form-check-input" type="checkbox" value="" id="selectAll">
                        <label class="form-check-label" for="selectAll">
                            Pilih Semua
                        </label>
                    </div>
                    <?php foreach($data as $cart): ?>
                    <?php  $variant = isset($cart['variant']) ? $cart['variant']['id'] : 0; 
                           $price = isset($cart['variant']) ? $cart['variant']['price'] : $cart['product']['price'];
                    ?>
                    <div class="border-bottom border-3 mb-5">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 my-auto">
                                    <div class="form-check">
                                        <input checked class="form-check-input select-all-listener" type="checkbox" value="" id="<?=$cart['product']['id'].'_'.$variant ?>" name="<?="checked".'_'.$cart['product']['id'].'_'.$variant ?>" 
                                        onclick="setChecked('<?=$cart['product']['id'].'_'.$variant ?>')">
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <img class="rounded-3" src="<?= base_url('assets/image/').json_decode($cart['product']['photo'])[0] ?>" alt="Product Image" width="100">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1"><?= $cart['product']['name'] ?></h5>
                                    <?php if (isset($cart['variant'])) :?>
                                        <p class="mb-1"><small>Variasi: <?= $cart['variant']['name']?></small></p>
                                    <?php endif; ?>
                                    <p class="card-text harga fw-bold mb-1" id="<?='price_'.$cart['product']['id'].'_'.$variant ?>"  data-price="<?= $price*$cart['qty'] ?>">Rp. <span class="prc"><?= $price?></span></p>
                                </div>
                                <div class="flex-grow-1 ms-3 align-self-center text-end">
                                <a onclick="return false" class="remove-product" data-url="<?= base_url('remove-product-from-cart/'.$cart['cart_id']) ?>" href="#"><i class="fas fa-trash-alt text-primary"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-white d-flex justify-content-end">
                            <p class="col-auto my-auto pe-3">Jumlah Product</p>
                            <div class="quantity col-auto">
                                <input name="<?="qty".'_'.$cart['product']['id'].'_'.$variant ?>" type="number" min="1" max="9" id="<?='qty_'.$cart['product']['id'].'_'.$variant ?>"  step="1" value="<?= $cart['qty'] ?>">
                            </div>    
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-5 pt-3">
                    <div class="card border-2 rounded-custom-1 mx-auto shadow-sm" style="width:80%;">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold">Ringkasan Belanja</h5>
                            <div class="row">
                                <div class="col-5">
                                    <p class="card-text">Total Barang</p>
                                </div>
                                <div class="col-7 text-end">
                                    <p class="card-text"><span id="totalItem"><?= isset($data) ? count($data) : 0 ?></span> Barang</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="card-text">Total Harga</p>
                                </div>
                                <div class="col-7 text-end">
                                    <p class="card-text">Rp. <span id="totalPrice"><?php $total = 0; foreach ($data as $cart) {
                                    if (isset($cart['variant'])) {
                                        $total += $cart['variant']['price']*$cart['qty'];
                                    } else {
                                        $total += $cart['product']['price']*$cart['qty'];
                                    }
                                } echo $total; ?></span></p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end mt-3">Lanjutkan Pembayaran</button>
                        </div>
                    </div>
                </div>
                <?php } ?>                    
            </div>

        </form>
    </div>
</section>