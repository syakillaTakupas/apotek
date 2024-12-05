<?= $this->extend('index') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <h1 class="mb-4 text-center">Detail Penjualan #<?= $penjualan['id']; ?></h1>

    <h4>Nama Pelanggan: <?= $penjualan['nama_pelanggan']; ?></h4>
    <h4>Tanggal Penjualan: <?= date('d-m-Y', strtotime($penjualan['tanggal_jual'])); ?></h4>
    <h4>Total Harga: <?= number_format($penjualan['total_harga'], 2); ?></h4>

    <h4>Item Penjualan:</h4>
    <table class="table table-bordered">
        <thead class="bg-primary text-white">
            <tr>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penjualan['item_penjualan'] as $item) : ?>
                <tr>
                    <td><?= $item['nama_obat']; ?></td>
                    <td><?= $item['jumlah']; ?></td>
                    <td><?= number_format($item['harga'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= base_url('penjualan'); ?>" class="btn btn-secondary">Kembali ke Daftar Penjualan</a>
</div>
<?= $this->endSection() ?>