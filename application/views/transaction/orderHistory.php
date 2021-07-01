<section class="order-history">
    <div class="container">
        <div class="row mt-5 pt-5">
            <h5 class="fw-bold">Riwayat Pesanan</h5>
            <div class="col-8 mx-auto text-center mt-3">
                <div class="" role="group" aria-label="Basic checkbox toggle button group">
                    <div class="owl-carousel">
                        <div>
                            <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck1">Menunggu Pembayaran</label>
                        </div>
                        <div>
                            <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck2">Menunggu Konfirmasi</label>
                        </div>
                        <div>
                            <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck3">Diproses</label>
                        </div>
                        <div>
                            <input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck4">Dikirim</label>
                        </div>
                        <div>
                            <input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck5">Sampai Ditujuan</label>
                        </div>
                        <div>
                            <input type="checkbox" class="btn-check" id="btncheck6" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck6">Dibatalkan</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($data as $value) : ?>
            <div class="col-12 mx-auto d-flex justify-content-center mb-4">
                <div class="card shadow-sm rounded-custom-1" style="width:40rem">
                    <div class="card-body mx-2 my-2">
                        <h6>No. Pesanan : <?= 'INV/YES/'.$value['id'] ?></h6>
                        <div class="d-flex mt-3">
                            <div class="flex-shrink-0">
                                <img class="rounded-3" src="<?= base_url('assets/image/').json_decode($value['trans_prod'][0]['product']['photo'])[0] ?>" alt="Product Image" width="80">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1"><?= $value['trans_prod'][0]['product']['name'] ?> <small style="font-size: 0.7em;"><?php 
                                    if (count($value['trans_prod']) > 1) {
                                        echo '  (...dan '.((int)count($value['trans_prod'])-1).' item lainnya)';
                                    }
                                ?></small></h5>
                                <p class="mb-1"><small>Variasi: <?= isset($value['trans_prod'][0]['variant']) ? $value['trans_prod'][0]['variant']['name'] : '-' ?></small></p>
                                <p class="mb-1"><small>Catatan: <?= $value['trans_prod'][0]['note'] ?></small></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <small class="my-auto">Tanggal Pesan: <?= $value['create_time'] ?></small>
                            <p class="my-auto harga fw-bold text-end">Status: <?= TRANS[$value['status']] ?></p>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-secondary col-12 text-dark border-0">
                                Lihat Pesanan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
            
        </div>
    </div>
</section>