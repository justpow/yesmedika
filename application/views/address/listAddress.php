<section class="profile">
    <div class="container">
        <div class="row mt-5 pt-5">
            <h5 class="fw-bold">Alamat Kamu</h5>
            <div class="row">
                <div class="col-12">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#tambahAlamat"><small><i class="fas fa-plus"></i>&nbsp; Tambah Alamat</small></button>
                    </div>
                    <div class="border-bottom border-3 mb-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5>Home</h5>
                                    <p class="mb-1"><b>Penerima : Wunsel Arto - 081232332101</b></p>
                                    <p class="mb-0">Alamat :</p>
                                    <p class="mb-1">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus vel nemo corporis animi ea repellat saepe obcaecati sit, tempore accusamus explicabo! Fuga cupiditate vero, similique hic neque culpa maiores iure.</p>
                                    <small class="mb-0">Catatan :</small>
                                    <small>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</small>
                                </div>
                                <div>
                                    <button class="fas fa-edit fs-5 text-primary btn btn-transparent" type="button"></button>
                                </div>
                                <div>
                                    <span class="badge bg-transparent border border-primary text-primary px-2 py-2">Utama</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom border-3 mb-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5>Kantor</h5>
                                    <p class="mb-1"><b>Penerima : Wunsel Arto - 081232332101</b></p>
                                    <p class="mb-0">Alamat :</p>
                                    <p class="mb-1">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus vel nemo corporis animi ea repellat saepe obcaecati sit, tempore accusamus explicabo! Fuga cupiditate vero, similique hic neque culpa maiores iure.</p>
                                    <small class="mb-0">Catatan :</small>
                                    <small>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</small>
                                </div>
                                <div>
                                    <button class="fas fa-edit fs-5 text-primary btn btn-transparent" type="button"></button>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary fs-6"><small>Jadikan Alamat Utama</small></button>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom border-3 mb-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5>Kantor Kedua</h5>
                                    <p class="mb-1"><b>Penerima : Wunsel Arto - 081232332101</b></p>
                                    <p class="mb-0">Alamat :</p>
                                    <p class="mb-1">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus vel nemo corporis animi ea repellat saepe obcaecati sit, tempore accusamus explicabo! Fuga cupiditate vero, similique hic neque culpa maiores iure.</p>
                                    <small class="mb-0">Catatan :</small>
                                    <small>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</small>
                                </div>
                                <div>
                                    <button class="fas fa-edit fs-5 text-primary btn btn-transparent" type="button"></button>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary fs-6"><small>Jadikan Alamat Utama</small></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tambah Alamat -->
        <div class="modal fade border-0" id="tambahAlamat" tabindex="-1" aria-labelledby="tambahAlamat" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered border-0">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="tambahAlamat">Tambah Alamat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-0">
                        <div class="container">
                            <form class="row g-3">
                                <div class="col-12">
                                    <label for="namaAlamat" class="form-label">Nama Alamat</label>
                                    <input type="text" class="form-control" id="namaAlamat">
                                </div>
                                <div class="col-6">
                                    <label for="namaPenerima" class="form-label">Nama Penerima</label>
                                    <input type="text" class="form-control" id="namaPenerima">
                                </div>
                                <div class="col-6">
                                    <label for="noTelp" class="form-label">No Handphone</label>
                                    <input type="text" class="form-control" id="noTelp">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="inputAddress" placeholder="Jalan Depok Raya No. 12">
                                </div>
                                <div class="col-6">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select id="provinsi" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>DKI Jakarta</option>
                                        <option>Jawa Barat</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="provinsi" class="form-label">Kota</label>
                                    <select id="provinsi" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>Jakarta Pusat</option>
                                        <option>Jakarta Timur</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <select id="kecamatan" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>Gambir</option>
                                        <option>Kemayoran</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="kecamatan" class="form-label">Kelurahan</label>
                                    <select id="kecamatan" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>Cempaka Baru</option>
                                        <option>Sumur Batu</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="inputZip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="inputZip">
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tambah Alamat -->
    </div>
</section>