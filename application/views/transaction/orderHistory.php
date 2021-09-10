<section class="order-history">
    <div class="container">
        <div class="row mt-page">
            <h5 class="fw-bold">Riwayat Pesanan</h5>
            <div class="col-lg-8 col-12 mx-auto text-center mt-3">
                <div role="group" aria-label="Basic checkbox toggle button group">
                    <div class="owl-carousel">
                        <div>
                            <input type="radio" class="btn-check" id="btncheck1" autocomplete="off" name="transStat" value="1" checked>
                            <label class="btn btn-outline-primary" for="btncheck1">Menunggu Pembayaran</label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" id="btncheck3" autocomplete="off" name="transStat" value="2">
                            <label class="btn btn-outline-primary" for="btncheck3">Diproses</label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" id="btncheck4" autocomplete="off" name="transStat" value="3">
                            <label class="btn btn-outline-primary" for="btncheck4">Dikirim</label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" id="btncheck5" autocomplete="off" name="transStat" value="4">
                            <label class="btn btn-outline-primary" for="btncheck5">Sampai Ditujuan</label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" id="btncheck6" autocomplete="off" name="transStat" value="5">
                            <label class="btn btn-outline-primary" for="btncheck6">Selesai</label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" id="btncheck7" autocomplete="off" name="transStat" value="0">
                            <label class="btn btn-outline-primary" for="btncheck7">Dibatalkan</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="row transaction-list">

                </div>
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
</section>