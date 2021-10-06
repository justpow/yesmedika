<!-- Beri Feedback -->
<form>
    <div class="modal fade border-0" id="addPayment" tabindex="-1" aria-labelledby="addPayment" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg border-0 modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="judulModal">Upload Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0" style="min-height:20rem;max-height:38rem;">
                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-12 d-flex justify-content-end text-end gap-3">
                                <p class="my-auto"><small>Batas akhir pembayaran :</small></p>
                                <p class="text-danger my-auto fw-bold"><small><?= $data['expire'] ?></small></p>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="card mx-auto border-0">
                                    <div class="row">
                                        <div class="col-3">
                                            <p class="mb-1">No Pesanan</p>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-1">: <span class="text-primary fw-bold">&nbsp;INV/YES/<?= $data['id'] ?></span></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <p class="mb-1">Pembayaran</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-1">: &nbsp;Transfer Manual</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <p class="mb-1">Bank</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-1">: &nbsp;BNI</p>
                                        </div>
                                    </div>
                                    <div class="text-center border rounded-custom-1 my-3">
                                        <p class="card-title mb-1 fs-6 mt-4">No Rekening</p>
                                        <h5 class="card-text mb-1 fw-bolder">827708123121568</h5>
                                        <h5 class="card-text">Atas Nama PT Yesmedika</h5>
                                        <p class="card-title mb-1 fs-6 mt-4">Total Pembayaran</p>
                                        <h5 class="card-text mb-4 text-danger fw-bold">Rp. <?= $value['total_price'] ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="accordion accordion-flush mx-auto bg-transparent" id="accordionFlushExample">
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
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="nama_rekening" placeholder="">
                                                            <label for="floatingInput">Nama Pemilik Rekening</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control numbers" id="nomor_rekening" placeholder="">
                                                            <label for="floatingInput">No Rekening</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                                <option selected>Pilih Bank</option>
                                                                <option value="1">BNI</option>
                                                                <option value="2">BNI</option>
                                                                <option value="3">BNI</option>
                                                            </select>
                                                            <label for="floatingSelect">Bank</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control numbers" id="total" placeholder="">
                                                            <label for="floatingInput">Jumlah Transfer</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="formFile" class="form-label">Bukti Pembayaran</label>
                                                        <input class="form-control" type="file" id="formFile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                     
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="float-end">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Beri Feedback -->