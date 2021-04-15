<body>
    <section id="logo" class="mt-3">
        <div class="container">
            <img class="mx-auto my-auto d-block" src="<?= base_url('assets/image/logo.png')?>" alt="" width="120">
        </div>
    </section>        
    <section id="card-form" class="mt-5">
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
                          <input class="form-control" type="text" id="fname" name="fname" required>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                          <label class="form-label" for="lname">Nama Belakang</label>
                          <input class="form-control" type="text" id="lname" name="lname" required>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3">
                          <label class="form-label" for="username">Username</label>
                          <input class="form-control" type="text" id="username" name="username" required>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3">
                          <label class="form-label" for="birth">Tanggal Lahir</label>
                          <input class="form-control" type="date" id="birth" name="birth" required>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                          <label class="form-label" for="email">Email</label>
                          <input class="form-control" type="text" id="email" name="email" required>
                          <div id="emailHelp" class="form-text">Contoh: email@yesmedika.com</div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                          <label class="form-label" for="phone">Nomor HP</label>
                          <input class="form-control" type="number" id="phone" name="phone" required>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3">
                          <label class="form-label" for="password">Kata Sandi</label>
                          <input class="form-control" type="password" id="password" name="password" required>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3">
                          <label class="form-label" for="cPassword">Konfirmasi Kata Sandi</label>
                          <input class="form-control" type="password" id="cPassword" name="cPassword" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>