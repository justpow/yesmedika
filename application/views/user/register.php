<body>
    <section id="logo" class="mt-3">
        <div class="container">
            <img class="mx-auto my-auto d-block" src="<?= base_url('assets/image/logo.png')?>" alt="" width="120">
        </div>
    </section>        
    <section id="card-form" class="mt-5">
        <div class="container">
            <div class="card mx-auto" style="max-width: 50%;">
                <div class="card-body">
                    <h3 class="fw-bold px-3 py-3 text-center">Buat Akun</h3>
                    <?php if ($this->session->flashdata('register_error')): ?>
                      <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('register_error') ?>
                      </div>
                    <?php endif; ?>
                    <form action="<?= base_url('register/submit') ?>" method="post">
                        <div class="mb-3">
                          <label class="form-label" for="fname">Nama Depan:</label>
                          <input class="form-control" type="text" id="fname" name="fname">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="lname">Nama Belakang:</label>
                          <input class="form-control" type="text" id="lname" name="lname">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="birth">Tanggal Lahir:</label>
                          <input class="form-control" type="date" id="birth" name="birth">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="username">Username:</label>
                          <input class="form-control" type="text" id="username" name="username">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="email">Email:</label>
                          <input class="form-control" type="text" id="email" name="email">
                          <div id="emailHelp" class="form-text">Contoh: email@yesmedika.com</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="phone">Nomor HP:</label>
                          <input class="form-control" type="number" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="password">Kata Sandi:</label>
                          <input class="form-control" type="password" id="password" name="password">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="cPassword">Konfirmasi Kata Sandi:</label>
                          <input class="form-control" type="password" id="cPassword" name="cPassword">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>