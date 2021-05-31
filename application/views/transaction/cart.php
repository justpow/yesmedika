<section class="cart">
    <div class="container">
        <div class="row mt-5">
            <h5 class="fw-bold">Keranjang</h5>
            <div class="col-lg-7">
                <div class="form-check mt-5 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Pilih Semua
                    </label>
                </div>
                <?php foreach($data as $cart): ?>
                <div class="border-bottom border-3 mb-5">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 my-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <img class="rounded-3" src="<?= base_url('assets/image/').json_decode($cart['product']['photo'])[0] ?>" alt="Product Image" width="100">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1"><?= $cart['product']['name'] ?></h5>
                                <p class="mb-1"><small>Variasi: <?= $cart['variant']['name']?></small></p>
                                <p class="card-text harga fw-bold mb-1">Rp. <?php 
                            if(isset($cart['variant'])){ echo $cart['variant']['price'];} else { echo $cart['product']['price']; }?></p>
                            </div>
                            <div class="flex-grow-1 ms-3 align-self-center">
                                <i class="fas fa-trash-alt text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-0 bg-white d-flex justify-content-end">
                        <p class="col-auto my-auto pe-3">Jumlah Product</p>
                        <div class="quantity col-auto">
                            <input type="number" min="1" max="9" step="1" value="<?= $cart['qty'] ?>">
                        </div>    
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-5 pt-3">
                <div class="card border-2 mx-auto shadow-sm" style="width:80%;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Ringkasan Belanja</h5>
                        <div class="row">
                            <div class="col-5">
                                <p class="card-text">Total Barang</p>
                            </div>
                            <div class="col-7 text-end">
                                <p class="card-text"><?= count($data) ?> Barang</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <p class="card-text">Total Harga</p>
                            </div>
                            <div class="col-7 text-end">
                                <p class="card-text">Rp. <?php $total = 0; foreach ($data as $cart) {
                                    if (isset($cart['variant'])) {
                                        $total += $cart['variant']['price'];
                                    } else {
                                        $total += $cart['product']['price'];
                                    }
                                } echo $total; ?></p>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary float-end mt-3">Lanjutkan Pembayaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>