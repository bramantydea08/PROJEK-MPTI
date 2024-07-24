<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>AL VARIASI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="<?= base_url('assets/') ?>images/logo.png" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/') ?>lib/animate/animate.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/') ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/') ?>lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/') ?>css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet" />
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="<?= base_url('home') ?>" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img class="img-fluid logo" src="<?= base_url('assets/') ?>images/logo.png" alt="" />
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse" style="margin-right: 30px">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="<?= base_url('home') ?>" class="nav-item nav-link <?= ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == '') ? 'active' : '' ?>">Beranda</a>
                <a href="<?= base_url('home/produk') ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'produk') ? 'active' : '' ?>">Produk</a>
                <a href="<?= base_url('home/tentang') ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'tentang') ? 'active' : '' ?>">Tentang Kami</a>
                <a href="<?= base_url('home/kontak') ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'kontak') ? 'active' : '' ?>">Hubungi Kami</a>
                <a href="<?= base_url('home/cek_buku') ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'cek_buku') ? 'active' : '' ?>">Cek Buku Servis</a>


                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="https://www.facebook.com/profile.php?id=61560435773793" target="_blank"><i class="fab fa-facebook-f text-custom-black"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href="https://www.instagram.com/alvariasi.bpp/" target="_blank"><i class="fab fa-instagram text-custom-black"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href="https://maps.app.goo.gl/fX8Z2SM4YxJeGf619" target="_blank"><i class="fa fa-map-marker-alt me-2"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->
<style>
    .navbar-brand .logo {
        width: auto; /* Atur lebar logo */
        height: 50px; /* Atur tinggi logo secara otomatis */
    }
</style>