<section class="profile">
    <div class="container  min-height1">

        <?php if ($this->session->flashdata('success')){ ?>
        <script>
            Swal.fire('', '<?=$this->session->flashdata('success')?>', 'success');
        </script>
        <?php }else if($this->session->flashdata('error')){ ?>
        <script>
            Swal.fire('', '<?=$this->session->flashdata('error')?>', 'error');
        </script>
        <?php } ?>

        <div class="row mt-page">
            <h5 class="fw-bold">Alamat Kamu</h5>
            <div class="row">
                <div class="col-12">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary fs-6" id="btn_tambah_alamat" data-bs-toggle="modal" data-bs-target="#tambahAlamat"><small><i class="fas fa-plus"></i>&nbsp; Tambah Alamat</small></button>
                    </div>
                    <?php
                        if ( empty($data['address']) )
                        {
                    ?>
                    <div id="notfound" class="text-center mt-5">
                        <div class="notfound">
                            <!-- <div class="notfound-404">
                                <h1>404</h1>
                            </div> -->
                            <h2>Maaf, Anda belum memiliki alamat</h2>
                            <p>Silahkan daftarkan alamat anda!</p>
                            <a href="<?= base_url('') ?>">Kembali ke Halaman Utama</a>
                        </div>
                    </div>

                    <?php
                        } else {
                    ?>
                    <?php 
                        foreach ( $data['address'] as $result ){
                         if ( $result['is_utama'] == '1' ) { 
                    ?>
                    <div class="border-bottom border-3 mb-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5><?= $result['address_name'] ?></h5>
                                    <p class="mb-1"><b>Penerima : <?= $result['recipient_name'] ?> - <?= $result['phone_number'] ?></b></p>
                                    <p class="mb-0">Alamat :</p>
                                    <p class="mb-1"><?= $result['address'] ?>, Kelurahan <?= $result['nama_kelurahan'] ?>, Kecamatan <?= $result['nama_kecamatan'] ?>, <?= $result['nama_kota'] ?>, <?= $result['nama_provinsi'] ?> <?= $result['kode_pos'] ?></p>
                                    <small class="mb-0">Catatan :</small>
                                    <small><?= $result['note_address'] ?></small>
                                </div>
                                <div>
                                    <a class="delete_address fs-5 text-primary btn btn-transparent" data-id="<?= $result['id'] ?>"><i class="fas fa-trash"></i></a>
                                </div>
                                <div>
                                    <button class="fas fa-edit fs-5 text-primary btn btn-transparent btn-edit m-2" type="button" data-id="<?= $result['id'] ?>" ></button>
                                </div>
                                <div>
                                    <span class="badge bg-transparent border border-primary text-primary px-2 py-2">Utama</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php    
                         }
                        } 
                       foreach ( $data['address'] as $result ){
                        if ( $result['is_utama'] == '0' ) {
                    ?>   
                    <div class="border-bottom border-3 mb-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5><?= $result['address_name'] ?></h5>
                                    <p class="mb-1"><b>Penerima : <?= $result['recipient_name'] ?> - <?= $result['phone_number'] ?></b></p>
                                    <p class="mb-0">Alamat :</p>
                                    <p class="mb-1"><?= $result['address'] ?>, Kelurahan <?= $result['nama_kelurahan'] ?>, Kecamatan <?= $result['nama_kecamatan'] ?>, <?= $result['nama_kota'] ?>, <?= $result['nama_provinsi'] ?> <?= $result['kode_pos'] ?></p>
                                    <small class="mb-0">Catatan :</small>
                                    <small><?= $result['note_address'] ?></small>
                                </div>
                                <div>
                                    <a class="delete_address fs-5 text-primary btn btn-transparent" data-id="<?= $result['id'] ?>"><i class="fas fa-trash"></i></a>
                                </div>
                                <div>
                                    <button class="fas fa-edit fs-5 text-primary btn btn-transparent btn-edit" type="button" data-id="<?= $result['id'] ?>"></button>
                                </div>
                            </div>
                            <div class="text-end">
                                <a type="button" href="<?= base_url('address/address/set_utama?id='.$result['id']) ?>" class="btn btn-primary fs-6"><small>Jadikan Alamat Utama</small></a>
                            </div>
                        </div>
                    </div>
                    <?php   
                            }
                          } 
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- Tambah Alamat -->
        <div class="modal fade border-0" id="tambahAlamat" tabindex="-1" aria-labelledby="tambahAlamat" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg border-0">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="judulModal">Alamat Kamu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form id="add_address_submit" action="" method="post">
                        <div class="modal-body border-0">
                            <div class="container">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="namaAlamat" class="form-label">Nama Alamat</label>
                                        <input type="text" class="form_address form-control" id="namaAlamat" name="namaAlamat" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="namaPenerima" class="form-label">Nama Penerima</label>
                                        <input type="text" class="form_address form-control" id="namaPenerima" name="namaPenerima" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="noTelp" class="form-label">No Handphone</label>
                                        <input type="text" class="form_address form-control numbers" id="noTelp" name="noTelp" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="detailAlamat1" class="form-label">Alamat</label>
                                        <div class="form-floating">
                                            <textarea class="form_address form-control" placeholder="Jalan Depok Raya No. 12" id="detailAlamat" name="detailAlamat" style="height: 100px" required></textarea>
                                            <label for="detailAlamat">Detail Alamat</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="noteAlamat" class="form-label"><small>Catatan</small></label>
                                        <input type="text" class="form_address form-control form-control-sm" id="noteAlamat" name="noteAlamat">
                                    </div>
                                    <div class="col-6">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        <input class="form_address form-control" type="text" list="provinsiOptions" id="provinsi" name="provinsi" placeholder="Pilih Provinsi" required>
                                        <input type="hidden" id="provinsiId" name="provinsiId" value="">
                                        <datalist id="provinsiOptions">
                                            
                                        </datalist>
                                    </div>
                                    <div class="col-6">
                                        <label for="kota" class="form-label">Kota/Kabupaten</label>
                                        <input class="form_address form-control" list="kotaOptions" id="kota" name="kota" placeholder="Pilih Kota/Kabupaten" required>
                                        <input type="hidden" id="kotaId" name="kotaId" value="">
                                        <datalist id="kotaOptions">
                                            
                                        </datalist>
                                    </div>
                                    <div class="col-4">
                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                        <input class="form_address form-control" list="kecamatanOptions" id="kecamatan" name="kecamatan" placeholder="Pilih Kecamatan" required>
                                        <input type="hidden" id="kecamatanId" name="kecamatanId" value="">
                                        <datalist id="kecamatanOptions">
                                            
                                        </datalist>
                                    </div>
                                    <div class="col-4">
                                        <label for="kelurahan" class="form-label">Kelurahan</label>
                                        <input class="form_address form-control" list="kelurahanOptions" id="kelurahan" name="kelurahan" placeholder="Pilih Kelurahan" required>
                                        <input type="hidden" id="kelurahanId" name="kelurahanId" value="">
                                        <datalist id="kelurahanOptions">
                                            
                                        </datalist>
                                    </div>
                                    <div class="col-4">
                                        <label for="inputZip" class="form-label">Zip</label>
                                        <input type="text" class="form_address form-control numbers" id="inputZip" name="inputZip" required>
                                    </div>
                                    <div class="col-12" id="showUtama">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="isUtama" name="isUtama" value="1">
                                            <label class="form-check-label" for="isUtama">
                                                Jadikan alamat utama
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="add_address" type="button" class="btn btn-primary">Submit</button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
        <!-- Tambah Alamat -->
    </div>
</section>