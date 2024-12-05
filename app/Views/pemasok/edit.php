<?= $this->extend('index') ?> <!-- Ensure you have the correct template file -->
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-white text-center">
            <h1 class="h3 mb-0">Edit Pemasok</h1>
        </div>
        <div class="card-body p-4">
            <!-- Display validation errors -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Terdapat beberapa kesalahan:
                    <ul class="mt-2 mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form action="<?= base_url('pemasok/update/' . $pemasok['id']); ?>" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pemasok</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($pemasok['nama']); ?>" placeholder="Masukkan nama pemasok" required>
                </div>

                <div class="mb-3">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" class="form-control" id="kontak" name="kontak" value="<?= esc($pemasok['kontak']); ?>" placeholder="Masukkan kontak pemasok" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning me-2 shadow-sm">
                        <i class="bi bi-pencil-square me-1"></i> Update
                    </button>
                    <a href="<?= base_url('pemasok'); ?>" class="btn btn-secondary shadow-sm">
                        <i class="bi bi-arrow-left-circle-fill me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
