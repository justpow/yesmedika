<section id="login" class="min-height">
    <section id="logo" class="mt-3">
        <div class="container">
            <img class="mx-auto my-auto d-block" src="<?= base_url('assets/image/logo.png')?>" alt="" width="120">
            <h1 class="text-center fw-bold mt-1">YESMEDIKA</h1>
        </div>
    </section>        
    <section id="card-form" class="mt-5 min-height">
        <div class="container">
            <div class="card mx-auto shadow" style="max-width: 50%;">
                <div class="card-body">
                    <h3 class="fw-bold px-3 py-3 text-center">Silahkan Masuk</h3>
                    <?php if ($this->session->flashdata('login_error')): ?>
                      <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('login_error') ?>
                      </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('register_success')): ?>
                      <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('register_success') ?>
                      </div>
                    <?php endif; ?>
                    <form method="POST" action="<?= base_url('login/submit') ?>">
                        <div class="mb-3">
                            <label for="InputEmail" class="form-label">Email/Username</label>
                            <input type="text" class="form-control" id="InputEmail" aria-describedby="emailHelp" name="email" required autofocus>
                            <div id="emailHelp" class="form-text">Contoh: email@yesmedika.com</div>
                        </div>
                        <div class="mb-3">
                            <label for="InputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="InputPassword" name="password" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-muted text-center mt-3 daftar">
                        Belum punya akun YESMedika? <a href="<?= base_url('register') ?>" class="text-decoration-none">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>