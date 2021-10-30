<section>
    <section id="logo" class="mt-3">
        <div class="container">
            <img class="mx-auto my-auto d-block" src="<?= base_url('assets/image/logo.png')?>" alt="" width="120">
            <h1 class="text-center fw-bold mt-1">YESMEDIKA</h1>
        </div>
    </section>        
    <section id="card-form" class="mt-5 min-height">
        <div class="container">
            <div class="card mx-auto shadow" style="max-width: 70%;">
                <div class="card-body">
                    <h3 class="fw-bold px-3 py-3 text-center">Buat Akun</h3>
                    <?php if ($this->session->flashdata('register_error')): ?>
                      <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('register_error') ?>
                      </div>
                    <?php endif; ?>
                    <form action="<?= base_url('register/submit') ?>" method="post">
                      <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                          <label class="form-label" for="fname">Nama Depan</label>
                          <input class="form-control" type="text" id="fname" name="fname" required value="<?= @set_value('fname'); ?>">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                          <label class="form-label" for="lname">Nama Belakang</label>
                          <input class="form-control" type="text" id="lname" name="lname" required value="<?= @set_value('lname'); ?>">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3">
                          <label class="form-label" for="username">Username</label>
                          <input class="form-control" type="text" id="username" name="username" required value="<?= @set_value('username'); ?>">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                          <label class="form-label" for="email">Email</label>
                          <input class="form-control" type="text" id="email" name="email" required value="<?= @set_value('email'); ?>">
                          <div id="emailHelp" class="form-text"> <small>Contoh: email@yesmedika.com</small></div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                          <label class="form-label" for="phone">Nomor Handphone</label>
                          <input class="form-control numbers" type="text" id="phone" name="phone" required value="<?= @set_value('phone'); ?>">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3">
                          <label class="form-label" for="password">Kata Sandi</label>
                          <input class="form-control" type="password" id="password" name="password" required>
                          <div id="passwordHelp" class="form-text"><small>Gunakan minimal 8 karakter dengan campuran 1 huruf kapital</small></div>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3">
                          <label class="form-label" for="cPassword">Konfirmasi Kata Sandi</label>
                          <input class="form-control" type="password" id="cPassword" name="cPassword" required>
                        </div>
                        <div class="d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                        <hr>
                        <div class="text-muted text-center mt-3 daftar">
                          Sudah memiliki akun YESMedika? <a href="<?= base_url('login') ?>" class="text-decoration-none">Login</a>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</section>