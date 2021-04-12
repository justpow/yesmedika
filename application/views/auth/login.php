<body id="login">
    <section id="logo" class="mt-3">
        <div class="container">
            <img class="mx-auto my-auto d-block" src="<?= base_url('assets/image/logo.png')?>" alt="" width="120">
        </div>
    </section>        
    <section id="card-form" class="mt-5">
        <div class="container">
            <div class="card mx-auto" style="max-width: 50%;">
                <div class="card-body">
                    <h3 class="fw-bold px-3 py-3 text-center">Silahkan Masuk</h3>
                    <form>
                        <div class="mb-3">
                            <label for="InputEmail" class="form-label">Email/Username</label>
                            <input type="text" class="form-control" id="InputEmail" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Contoh: email@yesmedika.com</div>
                        </div>
                        <div class="mb-3">
                            <label for="InputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="InputPassword">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <div class="text-muted text-center mt-3 daftar">
                        Belum punya akun YESMedika? <a href="<?= base_url('register') ?>" class="text-decoration-none">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>