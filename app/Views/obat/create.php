<?= $this->extend('index') ?> <!-- Make sure you have the correct template file -->
<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Tambah Obat</h1>

    <!-- Menampilkan pesan sukses atau kesalahan -->
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

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?= base_url('obat/store'); ?>" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Obat:</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama obat" required>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok:</label>
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan jumlah stok" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga:</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan harga obat" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa:</label>
                    <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('obat'); ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
