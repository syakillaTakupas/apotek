<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Edit Pelanggan</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?= base_url('pelanggan/update/' . $pelanggan['id']); ?>" method="post">
                <div class="form-group mb-3">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($pelanggan['nama']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= esc($pelanggan['alamat']); ?></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="telepon">Telepon:</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?= esc($pelanggan['telepon']); ?>">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('pelanggan'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
