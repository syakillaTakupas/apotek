<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php elseif (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<div class="container mt-4">
    <h1 class="mb-4 text-center">Daftar Penjualan</h1>
    <a href="<?= base_url('penjualan/create'); ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Penjualan</a>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Penjualan</th>
                    <th>Nama Obat</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penjualan as $i => $p) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $p['nama_pelanggan']; ?></td>
                        <td><?= date('d-m-Y', strtotime($p['tanggal_jual'])); ?></td>
                        <td>
                            <?php foreach ($p['item_penjualan'] as $item) : ?>
                                <?= $item['nama_obat']; ?> (<?= $item['jumlah']; ?>)<br>
                            <?php endforeach; ?>
                        </td>
                        <td><?= number_format($p['total_harga'], 2); ?></td>
                        <td>
                            <span class="badge <?= $p['status'] == 'dibayar' ? 'badge-success' : 'badge-warning'; ?>">
                                <?= ucfirst($p['status']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('penjualan/detail/' . $p['id']); ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-info-circle"></i> Detail
                            </a>
                            <a href="<?= base_url('penjualan/edit/' . $p['id']); ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('penjualan/delete/' . $p['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                            <a href="<?= base_url('penjualan/bayar/' . $p['id']); ?>" class="btn btn-success btn-sm">
                                <i class="fas fa-money-bill-wave"></i> Bayar
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<?= $this->endSection() ?>