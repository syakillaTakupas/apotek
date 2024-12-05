<?= $this->extend('index') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Pesanan Pembelian</h1>
    <a href="<?= base_url('pesanan_pembelian/create'); ?>" class="btn btn-primary mb-3">Tambah Pesanan Pembelian</a>

    <div class="row">
        <?php foreach ($pesanan_pembelian as $i => $pesanan): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan #<?= $i + 1 ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $pesanan['nama_pemasok']; ?></h6>
                        <p class="card-text">Tanggal Pesan: <?= date('d-m-Y', strtotime($pesanan['tanggal_pesan'])); ?></p>
                        <p class="card-text">Total Harga: Rp<?= number_format($pesanan['total_harga'], 2); ?></p>
                        <a href="<?= base_url('pesanan_pembelian/edit/' . $pesanan['id']); ?>" class="btn btn-warning">Edit</a>
                        <a href="<?= base_url('pesanan_pembelian/delete/' . $pesanan['id']); ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>