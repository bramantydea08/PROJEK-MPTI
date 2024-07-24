<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $active = 'active';
            foreach ($slider as $slide) : ?>
                <div class="carousel-item <?= $active ?>">
                    <img class="w-100" src="<?= base_url('uploads/slider/' . $slide->gambar) ?>" alt="Image" />
                </div>
                <?php $active = ''; ?>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->


<!-- produk Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Produk</h1>
        </div>
        <div class="row g-4">
            <a href="<?= base_url('home/produk') ?>" class="text-custom-black text-end">SEMUA PRODUK <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            <?php
            $limited_barang = array_slice($barang, 0, 4);
            foreach ($limited_barang as $row) : ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="<?= base_url('uploads/barang/' . $row['gambar']); ?>" alt="" />
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0"><?= $row['nama']; ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</div>
<!-- produk End -->