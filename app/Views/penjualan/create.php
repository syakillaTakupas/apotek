<?= $this->extend('index') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <h1 class="mb-4 text-center">Tambah Penjualan</h1>
    <form action="<?= base_url('penjualan/store'); ?>" method="post">
        <div class="form-group">
            <label for="pelanggan_id">Pilih Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan_id" class="form-control" required>
                <option value="">Pilih Pelanggan</option>
                <?php foreach ($pelanggan as $p) : ?>
                    <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="obat">Pilih Obat dan Jumlah</label>
            <div id="obat-container">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select name="obat[0][id]" class="form-control" onchange="updatePrice(this)" required>
                            <option value="">Pilih Obat</option>
                            <?php foreach ($obat as $o) : ?>
                                <option value="<?= $o['id']; ?>" data-price="<?= $o['harga']; ?>"><?= $o['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="obat[0][jumlah]" class="form-control" placeholder="Jumlah" min="1" onchange="updateTotal(this)" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="obat[0][harga]" class="form-control" placeholder="Harga" readonly>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="add-obat">Tambah Obat</button>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Simpan Penjualan</button>
    </form>
</div>

<script>
    let index = 1;

    function updatePrice(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const priceInput = selectElement.closest('.row').querySelector('input[name^="obat"][name$="[harga]"]');
        const jumlahInput = selectElement.closest('.row').querySelector('input[name^="obat"][name$="[jumlah]"]');
        const price = selectedOption.dataset.price || 0;

        // Update harga satuan
        priceInput.value = price;

        // Update total harga jika jumlah sudah diisi
        if (jumlahInput.value) {
            jumlahInput.dispatchEvent(new Event('change'));
        }
    }

    function updateTotal(jumlahInput) {
        const row = jumlahInput.closest('.row');
        const priceInput = row.querySelector('input[name^="obat"][name$="[harga]"]');
        const selectedOption = row.querySelector('select[name^="obat"][name$="[id]"] option:checked');
        const price = selectedOption.dataset.price || 0;

        // Hitung total harga
        const total = parseFloat(price) * parseInt(jumlahInput.value || 0);
        priceInput.value = total || 0;
    }

    document.getElementById('add-obat').addEventListener('click', function() {
        const container = document.getElementById('obat-container');
        const newRow = `
            <div class="row mb-2">
                <div class="col-md-4">
                    <select name="obat[${index}][id]" class="form-control" onchange="updatePrice(this)" required>
                        <option value="">Pilih Obat</option>
                        <?php foreach ($obat as $o) : ?>
                            <option value="<?= $o['id']; ?>" data-price="<?= $o['harga']; ?>"><?= $o['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="obat[${index}][jumlah]" class="form-control" placeholder="Jumlah" min="1" onchange="updateTotal(this)" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="obat[${index}][harga]" class="form-control" placeholder="Harga" readonly>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', newRow);
        index++;
    });
</script>
<?= $this->endSection() ?>
