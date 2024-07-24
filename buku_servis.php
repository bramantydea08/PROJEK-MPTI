<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Judul Buku Servis -->
            <div class="col-12 text-center mb-4">
                <h1 class="mb-5">BUKU SERVIS</h1>
            </div>
            <!-- Tabel Buku Servis Kendaraan -->
            <div class="col-12 mb-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Jenis Kendaraan</th>
                            <th scope="col">Plat Kendaraan</th>
                            <th scope="col">Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($servis) : ?>
                            <tr>
                                <td><?= $servis[0]->kendaraan; ?></td>
                                <td><?= $servis[0]->plat; ?></td>
                                <td><?= $servis[0]->point; ?></td>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Judul Riwayat Servis -->
            <div class="col-12 text-center mb-4">
                <h1 class="mb-5">RIWAYAT SERVIS</h1>
            </div>
            <!-- Tabel Riwayat Servis -->
            <div class="col-12 mb-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50%;">Tanggal Terakhir Service</th>
                            <th scope="col" style="width: 50%;">Servis/Penambahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($servis) : ?>
                            <?php foreach ($servis as $s) : ?>
                                <tr>
                                    <td><?= date('d-m-Y', strtotime($s->tgl_servis)); ?></td>
                                    <td><?= $s->keterangan; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Judul Rekomendasi Perbaikan -->
            <div class="col-12 text-center mb-4">
                <h1 class="mb-5">REKOMENDASI PERBAIKAN</h1>
            </div>
            <!-- Tabel Rekomendasi Perbaikan -->
            <div class="col-12 mb-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50%;">Tanggal Terakhir Servis</th>
                            <th scope="col" style="width: 50%;">Rekomendasi Perbaikan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($servis) : ?>
                            <?php foreach ($servis as $s) : ?>
                                <tr>
                                    <td><?= date('d-m-Y', strtotime($s->tgl_servis)); ?></td>
                                    <td><?= $s->rekomendasi; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>