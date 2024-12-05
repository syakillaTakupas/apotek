<?= $this->extend('index') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <h1 class="mb-4 text-center">Edit Penjualan</h1>
    <form action="<?= base_url('penjualan/update/' . $penjualan['id']); ?>" method="post">
        <div class="form-group">
            <label for="pelanggan_id">Nama Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan_id" class="form-control" required>
                <?php foreach ($pelanggan as $p) : ?>
                    <option value="<?= $p['id']; ?>" <?= $p['id'] == $penjualan['pelanggan_id'] ? 'selected' : ''; ?>>
                        <?= $p['nama']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="obat-list">
            <h4 class="mt-4">Daftar Obat</h4>
            <?php foreach ($item_penjualan as $item) : ?>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="obat_id">Obat</label>
                        <select name="obat[<?= $item['obat_id']; ?>][id]" class="form-control">
                            <?php foreach ($obat as $o) : ?>
                                <option value="<?= $o['id']; ?>" <?= $o['id'] == $item['obat_id'] ? 'selected' : ''; ?>>
                                    <?= $o['nama']; ?> <!-- Pastikan kolom ini ada -->
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="obat[<?= $item['obat_id']; ?>][jumlah]" class="form-control" value="<?= $item['jumlah']; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label for="harga">Harga</label>
                        <input type="number" name="obat[<?= $item['obat_id']; ?>][harga]" class="form-control" value="<?= $item['harga']; ?>" required>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
    </form>
</div>
<?= $this->endSection() ?>