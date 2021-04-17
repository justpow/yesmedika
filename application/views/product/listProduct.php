
<form action="<?= base_url('home/cari_produk/');?>" method="get">
    <section class="head-home">
        <div id="head-home" class="position-relative overflow-hidden p-3 p-md-5 text-center bg-dark text-light">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 fw-normal">YESMedika Alkes</h1>
                <p class="lead fw-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab cupiditate earum soluta culpa alias iure labore dicta. Velit soluta, possimus ea eos earum exercitationem libero. Ex quae incidunt eos optio.</p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari..." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </section>
    <section class="main-menu">
        <div class="container my-5">
            <div class="row">
                <div class="card-filter col-md-12 col-lg-3">
                    <h6 class="fw-bold my-3">FILTER</h6>
                    <div class="card shadow" >
                        <ul class="list-group">
                            <li class="list-group-item" type="button" data-bs-toggle="collapse" data-bs-target="#merekCollapse">Merek</li>
                            <div class="collapse show multi-collapse" id="merekCollapse">
                                <div class="card card-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="softies" id="mrk_soft" name="merek[]" onchange="this.form.submit()" 
                                        <?php if(!empty($this->input->get('merek'))) { 
                                            foreach($this->input->get('merek') as $chk){ 
                                                if($chk == 'softies'){ 
                                                    echo 'checked'; 
                                                } 
                                            }
                                        } ?> >
                                        <label class="form-check-label" for="mrk_soft">
                                            Softies
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="sensi" id="mrk_sensi" name="merek[]" onchange="this.form.submit()" 
                                        <?php if(!empty($this->input->get('merek'))) { 
                                            foreach($this->input->get('merek') as $chk){ 
                                                if($chk == 'sensi'){ 
                                                    echo 'checked'; 
                                                } 
                                            }
                                        } ?>>
                                        <label class="form-check-label" for="mrk_sensi">
                                            Sensi
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <li class="list-group-item" type="button" data-bs-toggle="collapse" data-bs-target="#hargaCollapse">Harga</li>
                            <div class="collapse show multi-collapse" id="hargaCollapse">
                                <div class="card card-body">
                                    <label for="harga-minimum" class="form-label">Harga Minimum</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" class="form-control" placeholder="Harga Minimum" name="harga[0]" value="<?= $this->input->get('harga[0]') ?>">
                                    </div>
                                    <label for="harga-maksimum" class="form-label">Harga Maksimum</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" class="form-control" placeholder="Harga Maksimum" name="harga[1]" value="<?= $this->input->get('harga[1]') ?>">
                                    </div>
                                    <button type="submit" style="display:none;"></button>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="card-product col-md-12 col-lg-9">
                    <div class="row">
                        <?php for ($i=0; $i<7 ; $i++) { ?>
                            <div class="col-lg-4 col-md-6 col-xs-12 mb-3 mt-5">
                                <div class="card shadow-sm text-center">
                                    <img src="<?= base_url('assets/image/perban.jpg') ?>" class="card-img-top" alt="product">
                                    <div class="card-body">
                                        <h5 class="card-title">Perban YESMedika</h5>
                                        <p class="card-text">Rp. 50.000/Box</p>
                                    </div>
                                    <div class="cover">
                                        <a class="btn text-light" type="button" id="button-addon2"><i class="fas fa-search"></i></a>
                                        <p class="title">Lihat Detail</p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
