<!DOCTYPE html>
<html>

<head>
    <title>Edit Item Pesanan Pembelian</title>
</head>

<body>
    <h1>Edit Item Pesanan Pembelian</h1>
    <form action="<?= base_url('item_pesanan_pembelian/update/' . $item['id']); ?>" method="post">
        <label>Pesanan Pembelian ID:</label>
        <input type="number" name="pesanan_pembelian_id" value="<?= $item['pesanan_pembelian_id']; ?>" required>
        <label>Obat ID:</label>
        <input type="number" name="obat_id" value="<?= $item['obat_id']; ?>" required>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" value="<?= $item['jumlah']; ?>" required>
        <button type="submit">Update</button>
    </form>
    <a href="<?= base_url('item_pesanan_pembelian'); ?>">Kembali</a>
</body>

</html>