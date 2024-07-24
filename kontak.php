<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(<?= base_url('assets/') ?>img/carousel-bg-2.jpg)">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Beranda</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Hubungi Kami</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Perubahan: Tambahkan CSS untuk menyembunyikan label -->
<style>
.hide-label {
    display: none;
}
</style>

<!-- Perubahan: Tambahkan JavaScript untuk menyembunyikan label saat input fokus atau ada nilai -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.form-control');

    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.nextElementSibling.classList.add('hide-label');
        });

        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.nextElementSibling.classList.remove('hide-label');
            }
        });

        input.addEventListener('input', function() {
            if (this.value !== '') {
                this.nextElementSibling.classList.add('hide-label');
            } else {
                this.nextElementSibling.classList.remove('hide-label');
            }
        });
    });
});
</script>

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="text-primary text-uppercase">// HUBUNGI AL VARIASI //</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-6 pt-4" style="min-height: 400px">
                <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                    <img class="position-absolute img-fluid w-100 h-100 variasi" src="<?= base_url('assets/') ?>images/alvariasi.jpeg" alt="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <p class="mb-4">Silakan isi form di bawah ini jika Anda memiliki pertanyaan terkait produk, layanan, atau pertanyaan lain.</p>
                    <form action="<?= base_url(); ?>home/pesan" method="post">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="nama" placeholder="Masukkan Nama" required />
                                    <label for="name">Masukkan Nama Anda</label> <!-- Perubahan: Tambah 'for="name"' -->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No HP" required />
                                    <label for="no_hp">Masukkan No HP Anda</label> <!-- Perubahan: Tambah 'for="no_hp"' -->
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subjek" placeholder="Subjek" required />
                                    <label for="subject">Subjek</label> <!-- Perubahan: Tambah 'for="subject"' -->
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Masukkan Pesan" id="message" name="pesan" style="height: 100px" required></textarea>
                                    <label for="message">Pesan</label> <!-- Perubahan: Tambah 'for="message"' -->
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center mt-4">
                        <p>atau</p>
                        <a class="btn btn-success w-100 py-3" href="http://wa.me/6281346615882" target="_blank">
                            <i class="fab fa-whatsapp"></i> Hubungi Melalui Whatsapp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

