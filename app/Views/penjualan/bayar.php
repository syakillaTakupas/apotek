<?= $this->extend('index') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <h1 class="text-center mb-4">Pembayaran Penjualan</h1>
    <div class="card">
        <div class="card-body">
            <h5>Nama Pelanggan: <?= $penjualan['nama_pelanggan'] ?? 'Tidak Diketahui'; ?></h5>
            <h5>Total Harga: Rp <?= number_format($penjualan['total_harga'], 2); ?></h5>
            <form action="<?= base_url('penjualan/proses_bayar/' . $penjualan['id']); ?>" method="post">
                <?= csrf_field(); ?>
                <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                <a href="<?= base_url('penjualan'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
