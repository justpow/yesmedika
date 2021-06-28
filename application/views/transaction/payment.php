<section class="cart">
    <div class="container">
        <div class="row mt-5 pt-5 flex-direction-column justify-content-center">
            <div class="col-12 text-center">
                <h5 class="fw-bold">Status transaksi</h5>
                <span class="badge bg-warning text-dark fs-5">Menunggu Pembayaran</span>
                <p class="mt-4 mb-0">Batas akhir pembayaran</p>
                <h5 class="text-danger mt-1 fw-bold">Senin, 30 Mei 2021 23:51:40</h5>
            </div>
            <div class="col-12 mt-5">
                <div class="card mx-auto" style="width:60%;">
                    <div class="card-header bg-transparent d-flex">
                        <h6 class="my-auto flex-grow-1">Transfer Manual</h6>
                        <img src="<?= base_url('assets/image/bni.png'); ?>" alt="" width="100">
                    </div>
                    <div class="card-body text-center">
                        <p class="card-title mb-1 fs-6 mt-3">No Tagihan</p>
                        <h5 class="card-text fw-bold">INV/2021/31/02/Ab</h5>
                        <p class="card-title mb-1 fs-6 mt-4">No Rekening</p>
                        <h5 class="card-text mb-1 fw-bolder">827708123121568</h5>
                        <h5 class="card-text">Atas Nama PT Yesmedika</h5>
                        <p class="card-title mb-1 fs-6 mt-4">Total Pembayaran</p>
                        <h5 class="card-text mb-4 text-danger fw-bold"> Rp. 50.000</h5>
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
                                <p>1. Lorem ipsum dolor, sit amet consectetur adipisicing</p>
                                <p>2. Lorem ipsum dolor, sit amet consectetur adipisicing</p>
                                <p>3. Lorem ipsum dolor, sit amet consectetur adipisicing</p>
                                <p>4. Lorem ipsum dolor, sit amet consectetur adipisicing</p>
                                <p>5. Lorem ipsum dolor, sit amet consectetur adipisicing</p>
                                <p>6. Lorem ipsum dolor, sit amet consectetur adipisicing</p>
                                <p>7. Lorem ipsum dolor, sit amet consectetur adipisicing</p>
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
                            <div class="accordion-body">
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputText1" class="form-label">Nama Pemilik Rekening</label>
                                        <input type="text" class="form-control" id="inputText1">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputText2" class="form-label">No Rekening</label>
                                        <input type="text" class="form-control" id="inputText2">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputState" class="form-label">Transfer dari Bank</label>
                                        <select id="inputState" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>BCA</option>
                                        <option>BNI</option>
                                        <option>BRI</option>
                                        <option>MANDIRI</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputNumber1" class="form-label">Jumlah Transfer</label>
                                        <input type="number" class="form-control" id="inputNumber1">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="formFile" class="form-label">Bukti Pembayaran</label>
                                        <input class="form-control" type="file" id="formFile">
                                    </div>
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>