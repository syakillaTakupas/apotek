<!DOCTYPE html>
<html>

<head>
    <title>Tambah Item Pesanan Pembelian</title>
</head>

<body>
    <h1>Tambah Item Pesanan Pembelian</h1>
    <form action="<?= base_url('item_pesanan_pembelian/store'); ?>" method="post">
        <label>Pesanan Pembelian ID:</label>
        <input type="number" name="pesanan_pembelian_id" required>
        <label>Obat ID:</label>
        <input type="number" name="obat_id" required>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" required>
        <button type="submit">Simpan</button>
    </form>
    <a href="<?= base_url('item_pesanan_pembelian'); ?>">Kembali</a>
</body>

</html>