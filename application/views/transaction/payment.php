<?php 
    if (!isset($data)) {
        redirect('transaction/history');
    }
?>

<section class="payment">
    <div class="container min-height1">
        <div class="row mt-page flex-direction-column justify-content-center">
            <div class="col-12 text-center">
                <h5 class="fw-bold">Status transaksi</h5>
                <span class="badge bg-warning text-dark fs-5">Menunggu Pembayaran</span>
                <p class="mt-4 mb-0">Batas akhir pembayaran</p>
                <h5 class="text-danger mt-1 fw-bold"><?= $data['expire'] ?></h5>
            </div>
            <div class="col-12 mt-5">
                <div class="card mx-auto" style="width:60%;">
                    <div class="card-header bg-transparent d-flex">
                        <h6 class="my-auto flex-grow-1">Transfer Manual</h6>
                        <img src="<?= base_url('assets/image/bni.png'); ?>" alt="" width="100">
                    </div>
                    <div class="card-body text-center">
                        <p class="card-title mb-1 fs-6 mt-3">No Tagihan</p>
                        <h5 class="card-text fw-bold"><?= $data['invoice'] ?></h5>
                        <p class="card-title mb-1 fs-6 mt-4">No Rekening</p>
                        <h5 class="card-text mb-1 fw-bolder">827708123121568</h5>
                        <h5 class="card-text">Atas Nama PT Yesmedika</h5>
                        <p class="card-title mb-1 fs-6 mt-4">Total Pembayaran</p>
                        <h5 class="card-text mb-4 text-danger fw-bold"> Rp. <?= $data['total'] ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="accordion accordion-flush mx-auto bg-transparent" id="accordionFlushExample" style="width:60%;">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Panduan Pembayaran
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <p>1. Lakukan transfer sesuai nominal di atas dengan tujuan <b>BANK BNI 827708123121568 (PT YESMEDIKA)</b></p>
                                <p>2. Setelah transfer, upload foto bukti pembayaran pada form <b>"Upload Bukti Pembayaran"</b> di bawah</p>
                                <p>3. Setelah upload bukti bayar selesai, anda bisa melihat detail status pesanan di menu <b>"Riwayat Pesanan"</b> </p>
                                <p>4. Untuk mempercepat proses, anda juga dapat memberi tahu Admin melalui halaman detail pesanan bahwa anda sudah upload bukti transfer</p>
                                <p>5. Setelah Admin memverifikasi pembayaran, status pesanan akan berubah menjadi <b>"Diproses"</b> </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Upload Bukti Pembayaran
                        </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <form action="<?= base_url('transaction/upload/'.$data['transaction_id']); ?>" method="POST" enctype="multipart/form-data">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputText1" class="form-label">Nama Pemilik Rekening</label>
                                            <input type="text" name='sender_name' class="form-control" id="inputText1" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputText2" class="form-label">No Rekening</label>
                                            <input type="text" name='account_number' class="form-control numbers" id="inputText2" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label">Transfer dari Bank</label>
                                            <select name='provider' id="inputState" class="form-select" required>
                                            <option selected>Choose...</option>
                                            <option>BCA</option>
                                            <option>BNI</option>
                                            <option>BRI</option>
                                            <option>MANDIRI</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputNumber1" class="form-label">Jumlah Transfer</label>
                                            <input name='amount' type="text" class="form-control numbers" id="inputNumber1" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="formFile" class="form-label">Bukti Pembayaran</label>
                                            <input name='file' class="form-control" type="file" id="formFile" required>
                                        </div>
                                        <div class="col-md-12 text-end">
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>