<style>
    .custom-btn-color {
        background-color: #841818;
        color: #fff;
        border-color: #841818;
    }

    .custom-btn-color:hover {
        background-color: #6e1212;
        border-color: #6e1212;
    }
</style>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(<?= base_url('assets/') ?>img/carousel-bg-2.jpg)">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Beranda</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Produk</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Produk Start -->
<div class="container-xxl py-5">
    <div class="container">
        <!-- <div class="row mb-4">
            <div class="col-lg-12">
                <h1 class="mb-3">Semua Produk</h1>
            </div>
        </div> -->

        <!-- Form Pencarian -->
        <div class="row mb-5">
            <div class="col-lg-4">
                <form action="<?= base_url('home/search') ?>" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Cari Produk..." required>
                        <button class="btn custom-btn-color" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach ($barang as $row) : ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="<?= base_url('uploads/barang/' . $row['gambar']); ?>" alt="" />
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0"><?= $row['nama']; ?></h5>
                            <br>
                            <h5 class="fw-bold mb-0">Harga : Rp.<?= number_format($row['harga'], 2, ',', '.'); ?></h5>
                            <small class="text-danger d-block mb-2" style="font-size: 10px;">*tidak termasuk biaya pasang</small>
                            <a href="#" class="btn btn-outline-info mt-3 radius detail-produk custom-btn-color" data-bs-toggle="modal" data-bs-target="#detail<?= $row['id_barang']; ?>">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Modal Start -->
                <div class="modal fade text-left w-100" id="detail<?= $row['id_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel16">Detail Produk</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="modal-body d-flex text-center">
                                <div class="deskripsi">
                                    <h3><?= $row['nama']; ?></h3>
                                    <img class="img-fluid" src="<?= base_url('uploads/barang/' . $row['gambar']); ?>" alt="" />
                                    <div class="product-details" style="text-align: left;"> <!-- Tambahkan style inline -->
                                        <p><?= $row['deskripsi']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-button" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tutup</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal End -->
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Produk End -->