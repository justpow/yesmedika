<section class="profile">
    <div class="container">
        
        <?php if ($this->session->flashdata('update_success')){ ?>
        <script>
            Swal.fire('', '<?=$this->session->flashdata('update_success')?>', 'success');
        </script>
        <?php }else if($this->session->flashdata('update_error')){ ?>
        <script>
            Swal.fire('', '<?=$this->session->flashdata('update_error')?>', 'error');
        </script>
        <?php } ?>

        <?php if ($this->session->flashdata('password_success')){ ?>
        <script>
            Swal.fire('', '<?=$this->session->flashdata('password_success')?>', 'success');
        </script>
        <?php }else if($this->session->flashdata('password_error')){ ?>
        <script>
            Swal.fire('', '<?=$this->session->flashdata('password_error')?>', 'error');
        </script>
        <?php } ?>

        <div class="row mt-5 pt-5">
            <h5 class="fw-bold">Profil Kamu</h5>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="<?= base_url('assets/image/profile.png') ?>" alt="Foto Profile" class="border border-primary rounded-3" style="width:6rem;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h2>Wunsel Arto Negoro</h2>
                            <p>wunselan@gmail.com</p>
                        </div>
                        
                        <div class="text-end">
                            <button type="button" class="btn btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#editProfile"><small><i class="fas fa-edit"></i>&nbsp; Edit Profile</small></button>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <h4 class="mb-0">Detail Informasi</h4>
                    <hr class="mt-1 text-primary rounded-pill" style="height:.3rem;">
                </div>
                <div class="col-12 mt-3">
                    <div class="mb-1 row">
                        <label class="col-4">Username</label>
                        <div class="col-8">
                            <p>: wunselan</p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-4">Tanggal Lahir</label>
                        <div class="col-8">
                            <p>: 12 September 1990</p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-4">Jenis Kelamin</label>
                        <div class="col-8">
                            <p>: Laki-laki</p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-4">No Handphone</label>
                        <div class="col-8">
                            <p>: 08121212999</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <h4 class="mb-0">Ubah Password</h4>
                    <hr class="mt-1 text-primary rounded-pill" style="height:.3rem;">
                </div>
                <div class="col-12 mt-3">
                    <form id="form_ubah_password" action="<?= base_url('user/profile/ubah_password') ?>" method="post">
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Kata Sandi Lama</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword" name="inputPassword" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword2" class="col-sm-4 col-form-label">Kata Sandi Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword2" name="inputPassword2" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword3" class="col-sm-4 col-form-label">Konfirmasi Kata Sandi Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword3" name="inputPassword3" required>
                            </div>
                        </div>
                        <div class="col-auto float-end">
                            <button type="button" id="submit_ubah_password" class="btn btn-primary mb-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Tambah Alamat -->
        <div class="modal fade border-0" id="editProfile" tabindex="-1" aria-labelledby="editProfile" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered border-0">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="editProfile">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-0">
                        <div class="container">
                            <form class="row g-3">
                                <div class="col-6">
                                    <label for="namaDepan" class="form-label">Nama Depan</label>
                                    <input type="text" class="form-control" id="namaDepan">
                                </div>
                                <div class="col-6">
                                    <label for="namaBelakang" class="form-label">Nama Belakang</label>
                                    <input type="text" class="form-control" id="namaBelakang">
                                </div>
                                <div class="col-12">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username">
                                </div>
                                <div class="col-12">
                                    <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="tanggalLahir">
                                </div>
                                <div class="col-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="col-6">
                                    <label for="noHandphone" class="form-label">No Handphone</label>
                                    <input type="text" class="form-control" id="noHandphone">
                                </div>
                                <div class="col-12">
                                    <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                                    <div class="row ms-1 d-flex justify-content-center">
                                        <div class="form-check col-6">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check col-6">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tambah Alamat -->
    </div>
</section>