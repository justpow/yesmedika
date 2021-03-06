
<form action="<?= base_url('home/cari_produk/');?>" id="productForm" method="get">
    <section class="head-home">
        <div id="head-home" class="position-relative overflow-hidden p-3 p-md-home text-center bg-dark text-light">
            <div class="col-md-6 p-lg-5 mx-auto my-5">
                <h1 class="display-4 fw-normal">YES Medika</h1>
                <p class="lead fw-normal">YES MEDIKA menyediakan segala jenis kebutuhan di bidang alat kesehatan</p>
                <div class="input-group mb-3">
                    <input id="searchField" type="text" class="form-control" placeholder="Masukkan nama, merk, atau jenis barang..." aria-label="Search bar" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="searchBtn"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </section>
    <section class="main-menu">
        <div class="container my-5">
            <div class="row">
                <div class="card-urutkan col-lg-12">
                    <div class="row g-3 justify-content-end">
                        <div class="col-auto">
                            <label for="urutkan" class="col-form-label">Urutkan : </label>
                        </div>
                        <div class="col-auto">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Ulasan</option>
                                <option value="1">Harga Tertinggi</option>
                                <option value="2">Harga Terendah</option>
                                <option value="3">Sesuai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-filter col-md-12 col-lg-3">
                    <h5 class="fw-bold my-3">Filter</h5>
                    <div class="card shadow-sm rounded-3" >
                        <ul class="list-group">
                            <li class="list-group-item border-0" type="button" data-bs-toggle="collapse" data-bs-target="#merekCollapse">Jenis Barang</li>
                            <div class="collapse show multi-collapse" id="merekCollapse">
                                <div class="card card-body border-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="2" id="masker" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="masker">
                                            Masker
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="srg_tangan" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="srg_tangan">
                                            Sarung Tangan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="3" id="timbangan" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="timbangan">
                                            Timbangan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="4" id="tensimeter" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="tensimeter">
                                            Tensimeter
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="5" id="gcu" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="gcu">
                                            Multicheck GCU
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="6" id="hand_sanitizer" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="hand_sanitizer">
                                            Hand Sanitizer
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="7" id="disinfektan" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="disinfektan">
                                            Disinfectan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="2" id="apd" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="apd">
                                            Alat Pelindung Diri
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="2" id="thermometer" name="brand[]" onchange="submitFilter()">
                                        <label class="form-check-label" for="thermometer">
                                            Thermometer
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <li class="list-group-item border-0" type="button" data-bs-toggle="collapse" data-bs-target="#hargaCollapse">Harga</li>
                            <div class="collapse show multi-collapse" id="hargaCollapse">
                                <div class="card card-body border-0">
                                    <label for="harga-minimum" class="form-label">Harga Minimum</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input id="minPrice" type="number" class="form-control" placeholder="Harga Minimum" name="price[]">
                                    </div>
                                    <label for="harga-maksimum" class="form-label">Harga Maksimum</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input id="maxPrice" type="number" class="form-control" placeholder="Harga Maksimum" name="price[]">
                                    </div>
                                    <button type="submit" style="display:none;"></button>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="card-product col-md-12 col-lg-9">
                    <div class="row product-list">

                    </div>
                    <!-- loading animation -->
                    <div class="scroller-status">
                        <div class="infinite-scroll-request loader-ellips">
                            <span class="loader-ellips__dot"></span>
                            <span class="loader-ellips__dot"></span>
                            <span class="loader-ellips__dot"></span>
                        </div>
                        <p class="infinite-scroll-last">End of content</p>
                        <p class="infinite-scroll-error">No more pages to load</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>