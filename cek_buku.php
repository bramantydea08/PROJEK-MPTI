<!-- Login Form Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="bg-light text-center p-5">
                    <h1 class="mb-4">CEK BUKU SERVIS ANDA</h1>
                    <?= $this->session->flashdata('message'); ?>
                    <form action="<?= base_url('home/cek_buku_servis') ?>" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="plat" placeholder="Masukkan No Plat Kendaraan" required />
                            <label for="plat">Masukkan No Plat Kendaraan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="no_hp" placeholder="Masukkan No Telepon" required />
                            <label for="no_hp">Masukkan No HP</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Form End -->