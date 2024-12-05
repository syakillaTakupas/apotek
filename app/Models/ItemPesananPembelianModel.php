<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemPesananPembelianModel extends Model
{
    protected $table = 'item_pesanan_pembelian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pesanan_pembelian_id', 'obat_id', 'jumlah'];

    public function getTotalItemsByPesanan($pesananPembelianId)
    {
        return $this->where('pesanan_pembelian_id', $pesananPembelianId)
            ->selectSum('jumlah', 'total_jumlah')
            ->first();
    }
}
