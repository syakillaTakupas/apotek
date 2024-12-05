<!DOCTYPE html>
<html>

<head>
    <title>Tambah Item Penjualan</title>
</head>

<body>
    <h1>Tambah Item Penjualan</h1>
    <form action="<?= base_url('item_penjualan/store'); ?>" method="post">
        <label>Penjualan ID:</label>
        <input type="number" name="penjualan_id" required>
        <label>Obat ID:</label>
        <input type="number" name="obat_id" required>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" required>
        <button type="submit">Simpan</button>
    </form>
    <a href="<?= base_url('item_penjualan'); ?>">Kembali</a>
</body>

</html>