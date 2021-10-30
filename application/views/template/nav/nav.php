<nav class="navbar navbar-expand-lg bg-light navbar-light fixed-top py-sm-3 shadow-sm">
    <div class="container nav-container">
        <a href="<?= base_url('') ?>" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-dark text-decoration-none">
          <img src="<?= base_url('assets/image/logo.png') ?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
          <h6 class="d-inline-block align-text-top fw-bold mb-0">YES! Medika</h6>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-auto flex-grow-0" id="navbarNav">
            <ul class="navbar-nav nav text-small fs-nav">
                <?php if ( $this->session->userdata('user')['id'] != 1 ) { ?>
                <li class="nav-item">
                    <a href="<?= base_url('') ?>" class="nav-link text-dark text-center">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('cart') ?>" class="nav-link text-dark text-center position-relative">
                        Keranjang
                        <span class="badge-keranjang position-absolute translate-middle badge rounded-pill bg-primary">
                            <?= @$this->yesmedika->countCart() ?>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('transaction/history') ?>" class="nav-link text-dark text-center">
                        Riwayat Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('address/list-address') ?>" class="nav-link text-dark text-center">
                        Alamat
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark text-center" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu text-small fs-nav" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?= base_url('user/profile') ?>">Profil</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Log Out</a></li>
                    </ul>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a href="<?= base_url('login') ?>" class="nav-link text-dark text-center">
                        Login
                        
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>


