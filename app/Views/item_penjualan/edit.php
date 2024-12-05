<!DOCTYPE html>
<html>

<head>
    <title>Edit Item Penjualan</title>
</head>

<body>
    <h1>Edit Item Penjualan</h1>
    <form action="<?= base_url('item_penjualan/update/' . $item['id']); ?>" method="post">
        <label>Penjualan ID:</label>
        <input type="number" name="penjualan_id" value="<?= $item['penjualan_id']; ?>" required>
        <label>Obat ID:</label>
        <input type="number" name="obat_id" value="<?= $item['obat_id']; ?>" required>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" value="<?= $item['jumlah']; ?>" required>
        <button type="submit">Update</button>
    </form>
    <a href="<?= base_url('item_penjualan'); ?>">Kembali</a>
</body>

</html>