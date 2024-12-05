<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pelanggan_id', 'tanggal_jual', 'total_harga','status'];

    // Fungsi untuk mendapatkan data penjualan dengan nama pelanggan dan item penjualan
    public function getPenjualan()
    {
        return $this->db->table($this->table)
            ->select('penjualan.id, pelanggan.nama AS nama_pelanggan, penjualan.tanggal_jual, penjualan.total_harga, 
                      item_penjualan.obat_id, item_penjualan.jumlah, obat.nama AS nama_obat')
            ->join('pelanggan', 'penjualan.pelanggan_id = pelanggan.id')
            ->join('item_penjualan', 'penjualan.id = item_penjualan.penjualan_id')
            ->join('obat', 'item_penjualan.obat_id = obat.id')
            ->get()
            ->getResultArray();
    }
}
