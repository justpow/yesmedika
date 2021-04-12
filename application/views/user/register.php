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
                          <label class="form-label" for="fname">First name:</label>
                          <input class="form-control" type="text" id="fname" name="fname" value="John">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="lname">Last name:</label>
                          <input class="form-control" type="text" id="lname" name="lname" value="Doe">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="birth">Birth:</label>
                          <input class="form-control" type="date" id="birth" name="birth" value="2018-07-22">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="username">Username:</label>
                          <input class="form-control" type="text" id="username" name="username" value="Doe">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="email">Email:</label>
                          <input class="form-control" type="text" id="email" name="email" value="Doe">
                          <div id="emailHelp" class="form-text">Contoh: email@yesmedika.com</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="phone">Mobile Phone:</label>
                          <input class="form-control" type="number" id="phone" name="phone" value="08123456789">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="password">Password:</label>
                          <input class="form-control" type="password" id="password" name="password" value="Doe">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="cPassword">Confirm Password:</label>
                          <input class="form-control" type="password" id="cPassword" name="cPassword" value="Doe">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>