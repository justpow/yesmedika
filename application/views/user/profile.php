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
                            <h2><?= $data[0]['firstname'] . ' ' . $data[0]['lastname'] ?></h2>
                            <p><?= $data[0]['email'] ?></p>
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
                            <p>: <?= $data[0]['username'] ?></p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-4">Tanggal Lahir</label>
                        <div class="col-8">
                            <p>: <?= date("d F Y", strtotime($data[0]['birth_date'])) ?></p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-4">Jenis Kelamin</label>
                        <div class="col-8">
                            <p>: <?= ($data[0]['jenis_kelamin'] == 'pria') ? 'Laki-laki' : 'Perempuan' ?></p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-4">No Handphone</label>
                        <div class="col-8">
                            <p>: <?= $data[0]['phone_number'] ?></p>
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
        <!-- Update Profile -->
        <form  action="<?= base_url('user/profile/edit_prof_submit'); ?>" method="post">
            <div class="modal fade border-0" id="editProfile" tabindex="-1" aria-labelledby="editProfile" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg border-0">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="editProfile">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body border-0">
                            <div class="container">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <label for="namaDepan" class="form-label">Nama Depan</label>
                                        <input type="text" class="form-control" name="fname" id="namaDepan" value="<?= $data[0]['firstname'] ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="namaBelakang" class="form-label">Nama Belakang</label>
                                        <input type="text" class="form-control" name="lname" id="namaBelakang" value="<?= $data[0]['lastname'] ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="uname" id="username" value="<?= $data[0]['username'] ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="birth" id="tanggalLahir" value="<?= $data[0]['birth_date'] ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?= $data[0]['email'] ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="noHandphone" class="form-label">No Handphone</label>
                                        <input type="text" class="form-control" name="phone_number" id="noHandphone" value="<?= $data[0]['phone_number'] ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                                        <div class="row ms-1 d-flex justify-content-center">
                                            <div class="form-check col-6">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenisKelamin1" <?= ($data[0]['jenis_kelamin'] == 'pria') ? 'checked' : '' ?> value="pria">
                                                <label class="form-check-label" for="jenisKelamin1">
                                                    Laki-laki
                                                </label>
                                            </div>
                                            <div class="form-check col-6">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenisKelamin2" <?= ($data[0]['jenis_kelamin'] == 'wanita') ? 'checked' : '' ?> value="wanita">
                                                <label class="form-check-label" for="jenisKelamin2">
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Update Profile -->
    </div>
</section>