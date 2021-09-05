<section class="transactionDetails">
    <div class="container">
        <div class="row mt-page">
            <h5 class="fw-bold">Detail Transaksi</h5>
            <div class="col-lg-7 pt-3">
                <div class="card border-2 rounded-custom-1 shadow-sm">
                    <div class="card-body p-4">
                        <div class="head d-flex">
                            <p>Nomor Pesanan <span class="fw-bold text-primary">INV/YES/19</span></p>
                            <p class="ms-auto">Status: <span class="fw-bold text-primary">Menunggu Pembayaran</span></p>      
                        </div>
                        <p class="mb-1"><small>Tanggal Pembelian: 20 Jan 2021 12:33:12</small></p>
                        <div class="produk mt-5">
                            <p class="fw-bolder">Produk yang dibeli</p>
                            <div class="d-flex mt-3 border-bottom border-3">
                                <div class="flex-shrink-0">
                                    <img class="rounded-3" src="<?= base_url('assets/image/masker.jpg'); ?>" alt="Product Image" width="100">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">Masker kali ya</h6>
                                    <p class="mb-0"><small>10 Barang, Variasi: Hitam</small></p>
                                    <p class="mb-0"><small>1 x Rp. 10.000</small></p>
                                </div>
                                <div class="flex-grow-1 ms-3 align-self-center text-end mb-4">
                                    <p class="mb-1">Total Harga</p>
                                    <p class="mb-1 harga fw-bold">Rp. 10.000</p>
                                </div>
                            </div>
                            <div class="d-flex mt-3 border-bottom border-3">
                                <div class="flex-shrink-0">
                                    <img class="rounded-3" src="<?= base_url('assets/image/masker.jpg'); ?>" alt="Product Image" width="100">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">Masker kali ya</h6>
                                    <p class="mb-0"><small>10 Barang, Variasi: Hitam</small></p>
                                    <p class="mb-0"><small>1 x Rp. 10.000</small></p>
                                </div>
                                <div class="flex-grow-1 ms-3 align-self-center text-end mb-4">
                                    <p class="mb-1">Total Harga</p>
                                    <p class="mb-1 harga fw-bold">Rp. 10.000</p>
                                </div>
                            </div>
                        </div>
                        <div class="pengiriman mt-5">
                            <p class="fw-bolder">Info Pengiriman</p>
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-1">Kurir</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1">: &nbsp;Kurir Yesmedika</p>
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
                                    <p class="mb-1">: <b>Wunsel Arto Negoro (0812222212)</b><br>Jalan Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt dolorum delectus quisquam.</p>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary w-100 mt-5">Pesanan Diterima</button> <!-- kalo status dikirim -->
                        <button type="button" class="btn btn-primary w-100 mt-5" data-bs-toggle="modal" data-bs-target="#beriRating">Beri Ulasan</button> <!-- kalo status diterima -->
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
                                <p class="card-text">Transfer Manual</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <p class="card-text">Subtotal</p>
                            </div>
                            <div class="col-5 text-end">
                                <p class="card-text">Rp. 100.000</p>
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
                                <p class="card-text">Rp. 100.000</p>
                            </div>
                        </div>
                        <h6 class="text-primary fw-bold float-end mt-3">Lunas</h6>
                    </div>
                </div>
            </div>
        </div>
        <?php include './application/views/transaction/transactionModal/modalRating.php'; ?>
    </div>
</section>