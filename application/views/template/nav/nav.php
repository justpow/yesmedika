<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"  href="<?= base_url() ?>">
      <img src="<?= base_url('assets/image/logo.png') ?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
      <h6 class="d-inline-block align-text-top fw-bold">YES! Medika</h6>
    </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Artikel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('cart') ?>">Keranjang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('transaction/history') ?>">Riwayat Pesanan</a>
        </li>
      </ul>
      <form class="d-flex mb-auto">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      <ul class="navbar-nav me-2 mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= base_url('user/profile') ?>">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Setting</a></li>
            <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Log Out</a></li>
          </ul>
        </li>
        </ul>

    </div>
  </div>
</nav>
<!-- Navbar End -->
