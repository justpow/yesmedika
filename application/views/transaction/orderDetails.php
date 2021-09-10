<section class="orderDetails">
    <div class="container">
        <form action="<?= base_url('transaction/checkout') ?>" method="POST">
            <div class="row mt-page">
                <h5 class="fw-bold">Detail Pesanan</h5>
                <div class="col-lg-7">
                    <div class="border-bottom mb-5">
                        <div class="card-header border-bottom-0 bg-transparent fw-bold">
                            Barang yang dibeli
                        </div>
                        <div class="card-body">
                            <?php foreach($data['item_checked'] as $key => $value): ?>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                <img class="rounded-3" src="<?= base_url('assets/image/').json_decode($value->product['photo'])[0] ?>" alt="Product Image" width="100">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1"><?= $value->product['name'] ?></h5>
                                    <p class="mb-1"><small><?= $value->qty ?> Barang, Variasi: <?= isset($value->variant) ? $value->variant['name'] : '-' ?></small></p>
                                    <p class="card-text harga fw-bold">Rp. <?= $value->product['price'] ?></p>
                                </div>
                            </div>
                            <div class="mb-1 mt-4">
                                <label for="exampleFormControlTextarea1" class="form-label">Catatan Barang</label>
                                <textarea class="form-control" name='<?= $key ?>' id="exampleFormControlTextarea1" rows="2"></textarea>
                            </div>
                            <br>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="border-bottom mb-5">
                        <div class="card-header border-bottom-0 bg-transparent fw-bold">
                            Alamat Pengiriman
                        </div>
                        <div class="card-body">
                            <?php if (empty($data['address_all'])) {?>
                                <div id="notfound" class="text-center">
                                    <div class="notfound">
                                        <h6>Maaf, Anda belum memiliki alamat</h6>
                                        <p>Silahkan daftarkan alamat anda!</p>
                                        <a href="<?= base_url('address/list-address') ?>">Tambah Alamat</a>
                                    </div>
                                </div>  
                            
                            <?php } else { ?>
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <input type="hidden" name="address_id" value="<?= $data['address']['id'] ?>">
                                        <p id="nama_address" class="mb-1"><small><?= $data['address']['address_name'] ?></small></p>
                                        <p id="penerima_address" class="card-text mb-1">Penerima: <?= $data['address']['recipient_name'] ?> (<?= $data['address']['phone_number'] ?>)</p>
                                        <p id="alamat_address" class="mb-1"><small>Alamat: <?= $data['address']['address'] ?>, Kelurahan <?= $data['address']['nama_kelurahan'] ?>, Kecamatan <?= $data['address']['nama_kecamatan'] ?>, <?= $data['address']['nama_kota'] ?>, <?= $data['address']['nama_provinsi'] ?> <?= $data['address']['kode_pos'] ?></small></p>
                                        <p id="note_address" class="card-text mb-1"><small>Catatan: <?= $data['address']['note_address'] ?></small></p>
                                    </div>
                                    <div class="flex-grow-1 ms-1 align-self-center">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#gantiAlamat"><small>Ganti Alamat</small></button>
                                    </div>
                                </div>    
                            <?php }?>
                        </div>
                    </div>
                    <div class="border-bottom mb-5">
                        <div class="card-header border-bottom-0 bg-transparent fw-bold">
                            Jenis Pengiriman
                        </div>
                        <div class="card-body">
                            <div class="form-check mb-3 w-100">
                                <input class="form-check-input me-5" type="radio" name="selectKurir" id="kurir1">
                                <label class="form-check-label mb-2 d-flex text-center align-items-center" for="kurir1"> 
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-cart-arrow-down text-primary fs-1"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="card-text mb-1">Pickup in Store</p>
                                    </div>
                                    <div class="flex-grow-1 ms-1">
                                        <p class="card-text mb-1">Free</p>
                                    </div>
                                </label>
                            </div>  
                            <div class="form-check mb-3 w-100">
                                <input class="form-check-input me-5" type="radio" name="selectKurir" id="kurir2">
                                <label class="form-check-label mb-2 d-flex text-center align-items-center" for="kurir2"> 
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-shipping-fast text-primary fs-1"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="card-text mb-1">Antar aja</p>
                                    </div>
                                    <div class="flex-grow-1 ms-1">
                                        <p class="card-text mb-1">Rp. 10.000</p>
                                    </div>
                                </label>
                            </div>  
                        </div>
                    </div>
                    <div class="border-bottom mb-5">
                        <div class="card-header border-bottom-0 bg-transparent fw-bold">
                            Pembayaran
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1 me-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="selectPembayaran" id="cod">
                                        <label class="form-check-label" for="cod">
                                            COD
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="selectPembayaran" id="transfer">
                                        <label class="form-check-label" for="transfer">
                                            Transfer Bank
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 pt-3">
                    <div class="card border-2 rounded-custom-1 mx-auto shadow-sm" style="width:80%;">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold">Ringkasan Belanja</h5>
                            <div class="row">
                                <div class="col-7">
                                    <p class="card-text">Subtotal</p>
                                </div>
                                <div class="col-5 text-end">
                                    <p class="card-text">Rp. <?= $data['grand_total'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <p class="card-text">Pengiriman</p>
                                </div>
                                <div class="col-5 text-end">
                                    <p class="card-text">Free</p>
                                </div>
                            </div>
                            <div class="row fw-bold mt-3">
                                <div class="col-7">
                                    <p class="card-text">Total Belanja</p>
                                </div>
                                <div class="col-5 text-end">
                                    <p class="card-text">Rp. <?= $data['grand_total'] ?></p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end mt-3">Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include './application/views/transaction/transactionModal/modalChangeAddress.php'; ?>
</section>