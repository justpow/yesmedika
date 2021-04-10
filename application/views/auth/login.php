<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet" >
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
        <title>YESMedika</title>
    </head>
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
                                <label for="exampleInputEmail1" class="form-label">Email/Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">Contoh: email@yesmedika.com</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <div class="text-muted text-center mt-3 daftar">
                            Belum punya akun YESMedika? <a href="" class="text-decoration-none">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="text-center">
            <p class="text-muted mb-0">&copy; 2021, PT YESMedika</p>
        </footer>
    </body>
</html>