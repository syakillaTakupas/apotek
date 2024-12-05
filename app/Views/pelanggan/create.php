<?= $this->extend('index') ?> <!-- Pastikan Anda memiliki file template yang benar -->
<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Tambah Pelanggan</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?= base_url('pelanggan/store'); ?>" method="post">
                <div class="form-group mb-3">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                <div class="form-group mb-3">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="telepon">Telepon:</label>
                    <input type="text" class="form-control" id="telepon" name="telepon">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('pelanggan'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
