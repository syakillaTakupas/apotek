<?= $this->extend('index') ?> <!-- Pastikan Anda memiliki file template yang benar -->
<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Menampilkan pesan sukses atau kesalahan -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="mb-3 text-end">
        <a href="<?= base_url('pelanggan/create'); ?>" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Tambah Pelanggan
        </a>
    </div>

    <!-- Card untuk tabel pelanggan -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Daftar Pelanggan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($pelanggan) > 0): ?>
                            <?php foreach ($pelanggan as $i => $p): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($p['nama']); ?></td>
                                    <td><?= esc($p['alamat']); ?></td>
                                    <td><?= esc($p['telepon']); ?></td>
                                    <td>
                                        <a href="<?= base_url('pelanggan/edit/' . $p['id']); ?>" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <a href="<?= base_url('pelanggan/delete/' . $p['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada pelanggan ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-end">
            <!-- Anda bisa menambahkan pagination atau fitur lain di sini jika diperlukan -->
        </div>
    </div>
</div>

<?= $this->endSection() ?>
