<!DOCTYPE html>
<html>

<head>
    <title>Daftar Item Penjualan</title>
</head>

<body>
    <h1>Daftar Item Penjualan</h1>
    <a href="<?= base_url('item_penjualan/create'); ?>">Tambah Item Penjualan</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Penjualan ID</th>
            <th>Obat ID</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['penjualan_id']; ?></td>
                <td><?= $item['obat_id']; ?></td>
                <td><?= $item['jumlah']; ?></td>
                <td>
                    <a href="<?= base_url('item_penjualan/edit/' . $item['id']); ?>">Edit</a>
                    <a href="<?= base_url('item_penjualan/delete/' . $item['id']); ?>">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>