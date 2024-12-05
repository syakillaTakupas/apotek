<!DOCTYPE html>
<html>

<head>
    <title>Daftar Item Pesanan Pembelian</title>
</head>

<body>
    <h1>Daftar Item Pesanan Pembelian</h1>
    <a href="<?= base_url('item_pesanan_pembelian/create'); ?>">Tambah Item</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Pesanan Pembelian ID</th>
            <th>Obat ID</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['pesanan_pembelian_id']; ?></td>
                <td><?= $item['obat_id']; ?></td>
                <td><?= $item['jumlah']; ?></td>
                <td>
                    <a href="<?= base_url('item_pesanan_pembelian/edit/' . $item['id']); ?>">Edit</a>
                    <a href="<?= base_url('item_pesanan_pembelian/delete/' . $item['id']); ?>">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>