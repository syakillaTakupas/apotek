<?= $this->extend('index') ?> <!-- Ensure you have the correct template file -->
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-center text-primary fw-bold">Daftar Pemasok</h1>
        <a href="<?= base_url('pemasok/create'); ?>" class="btn btn-primary btn-lg shadow">
            <i class="bi bi-plus-circle"></i> Tambah Pemasok
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="table-responsive shadow-lg rounded">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th class="fw-bold">No</th>
                    <th class="fw-bold">Nama Pemasok</th>
                    <th class="fw-bold">Kontak</th>
                    <th class="fw-bold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pemasok as $i => $p): ?>
                    <tr>
                        <td class="fw-bold"><?= $i + 1 ?></td>
                        <td><?= esc($p['nama']); ?></td>
                        <td><?= esc($p['kontak']); ?></td>
                        <td>
                            <a href="<?= base_url('pemasok/edit/' . $p['id']); ?>" class="btn btn-warning btn-sm shadow-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="<?= base_url('pemasok/delete/' . $p['id']); ?>" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pemasok ini?')">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($pemasok)): ?>
                    <tr>
                        <td colspan="4" class="text-muted fst-italic">Tidak ada data pemasok.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
