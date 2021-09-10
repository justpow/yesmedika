<section class="transactionDetails">
    <div class="container">
        <div class="row mt-page">
            <h5 class="fw-bold">Detail Transaksi</h5>
            <div class="col-lg-7 pt-3">
                <div class="card border-2 rounded-custom-1 shadow-sm">
                    <div class="card-body p-4">
                        <div class="head d-flex">
                            <p>Nomor Pesanan <span class="fw-bold text-primary">INV/YES/<?= $data['id'] ?></span></p>
                            <p class="ms-auto">Status: <span class="fw-bold text-primary"><?= TRANS[$data['status']] ?></span></p>      
                        </div>
                        <p class="mb-1"><small>Tanggal Pembelian: <?= $data['create_time'] ?></small></p>
                        <div class="produk mt-5">
                            <p class="fw-bolder">Produk yang dibeli</p>
                            <?php $subtotal=0; $isReviewed=false; foreach ($data['trans_prod'] as $key => $value): ?>
                            <div class="d-flex mt-3 border-bottom border-3">
                                <div class="flex-shrink-0">
                                    <img class="rounded-3" src="<?=  base_url('assets/image/').json_decode($value['product']['photo'])[0] ?>" alt="Product Image" width="100">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0"><?= $value['product']['name'] ?></h6>
                                    <p class="mb-0"><small><?= $value['qty'] ?> Barang, <?php if (isset($value['variant'])) {
                                        echo "Variasi: ".$value['variant']['name'];
                                    } ?></small></p>
                                    <p class="mb-0"><small><?= $value['qty'] ?> x Rp. <?php if (isset($value['variant'])) {
                                        echo $value['variant']['price'];
                                    } else {
                                        echo $value['product']['price'];
                                    } $subtotal += $value['total_price']; ?></small></p>
                                </div>
                                <div class="flex-grow-1 ms-3 align-self-center text-end mb-4">
                                    <p class="mb-1">Total Harga</p>
                                    <p class="mb-1 harga fw-bold">Rp. <?= $value['total_price'] ?></p>
                                </div>
                            </div>
                            <?php
                                if (isset($value['review'])) {
                                    $isReviewed = true;
                                }
                            ?>
                            <?php endforeach ?>
                        </div>
                        <div class="pengiriman mt-5">
                            <p class="fw-bolder">Info Pengiriman</p>
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-1">Jenis Kurir</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1">: &nbsp;<?= PICKUP[$data['pickup_type']] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-1">No. Resi</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1">: &nbsp;-</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-1">Alamat</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1">: <b><?= $data['recipient_name'].' ('.$data['phone_number'].')' ?></b><br><?= $data['address_string'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php if( $data['status'] == TRANS['ON_DELIVERY'] || $data['status'] == TRANS['DELIVERED']  ): ?>
                        <button type="button" class="btn btn-primary w-100 mt-5">Konfirmasi Pesanan Diterima</button> <!-- kalo status dikirim -->
                        <?php endif ?>
                        
                        <?php if( $data['status'] == TRANS['DONE'] &&  !$isReviewed): ?>
                        <button type="button" class="btn btn-primary w-100 mt-5" data-bs-toggle="modal" data-bs-target="#beriRating">Beri Ulasan</button> <!-- kalo status diterima -->
                        <?php endif ?>
                        
                        <?php if( $data['status'] == TRANS['DONE'] &&  $isReviewed): ?>
                        <button type="button" class="btn btn-primary w-100 mt-5" data-bs-toggle="modal" data-bs-target="#lihatRating">Lihat Ulasan</button> <!-- kalo status diterima -->
                        <?php endif ?>
                        
                        <button type="button" class="btn btn-outline-primary w-100 mt-2">Ajukan Permohonan Retur Barang</button> <!-- bisa ngelink ke api wa yesmedika -->
                    </div>
                </div>
            </div>
            <div class="col-lg-5 pt-3">
                <div class="card border-2 rounded-custom-1 mx-auto shadow-sm" style="width:80%;">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold">Rincian Pembayaran</h5>
                        <div class="row">
                            <div class="col-7">
                                <p class="card-text">Metode Pembayaran</p>
                            </div>
                            <div class="col-5 text-end">
                                <p class="card-text"><?= PAYMENT_TYPE[$data['payment_type']] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <p class="card-text">Subtotal</p>
                            </div>
                            <div class="col-5 text-end">
                                <p class="card-text">Rp. <?= $subtotal ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <p class="card-text">Pengiriman</p>
                            </div>
                            <div class="col-5 text-end">
                                <p class="card-text">Rp. <?= $data['shipping_cost'] ?></p>
                            </div>
                        </div>
                        <div class="row fw-bold mt-3">
                            <div class="col-7">
                                <p class="card-text">Total Belanja</p>
                            </div>
                            <div class="col-5 text-end">
                                <p class="card-text">Rp. <?= $subtotal+$data['shipping_cost'] ?></p>
                            </div>
                        </div>
                        <h6 class="text-primary fw-bold float-end mt-3"><?php 
                            if ($data['status'] > TRANS['WAITING_PAYMENT'] && $data['payment_type'] != PAYMENT_TYPE['COD']) {
                                echo "Lunas";
                            } else {
                                echo "Belum Lunas";
                            }
                        
                        ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <?php include './application/views/transaction/transactionModal/modalRating.php'; ?>
        <?php include './application/views/transaction/transactionModal/modalViewRating.php'; ?>
    </div>
</section>