<?= $this->extend('index') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Tambah Pesanan Pembelian</h1>
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('pesanan_pembelian/store'); ?>" method="post">
                <div class="mb-3">
                    <label for="pemasok_id" class="form-label">Pemasok:</label>
                    <select name="pemasok_id" id="pemasok_id" class="form-select" required>
                        <option value="">Pilih Pemasok</option>
                        <?php foreach ($pemasok as $p) : ?>
                            <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <h4 class="mb-3">Daftar Obat:</h4>
                <?php foreach ($obat as $o) : ?>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="obat_id[]" id="obat_<?= $o['id']; ?>" value="<?= $o['id']; ?>">
                        <label class="form-check-label" for="obat_<?= $o['id']; ?>">
                            <?= $o['nama']; ?> - Rp<?= number_format($o['harga'], 2); ?>
                        </label>
                        <input type="number" name="jumlah[<?= $o['id']; ?>]" class="form-control mt-2" min="1" placeholder="Jumlah" style="width: 100px; display: inline-block;">
                    </div>
                <?php endforeach; ?>

                <div class="mb-3">
                    <label for="tanggal_pesan" class="form-label">Tanggal Pesan:</label>
                    <input type="date" name="tanggal_pesan" id="tanggal_pesan" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('pesanan_pembelian'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>