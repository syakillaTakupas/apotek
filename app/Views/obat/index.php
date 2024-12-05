<?= $this->extend('index') ?> <!-- Pastikan Anda memiliki file template yang benar -->
<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Daftar Obat</h1>

    <!-- Menampilkan pesan sukses atau kesalahan -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Tombol Tambah Obat -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('obat/create'); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Obat
        </a>
        <form class="d-flex" method="get" action="<?= base_url('obat'); ?>">
            <input class="form-control me-2" type="search" name="search" placeholder="Cari obat..." aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
    </div>

    <!-- Tabel Obat -->
    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($obat) && count($obat) > 0): ?>
                    <?php foreach ($obat as $i => $o): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($o['nama']); ?></td>
                            <td><?= esc($o['stok']); ?></td>
                            <td>Rp <?= number_format($o['harga'], 2, ',', '.'); ?></td>
                            <td><?= date('d M Y', strtotime($o['tanggal_kadaluarsa'])); ?></td>
                            <td>
                                <a href="<?= base_url('obat/edit/' . $o['id']); ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="<?= base_url('obat/delete/' . $o['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-muted">Tidak ada data obat ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
