<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemPenjualanModel extends Model
{
    protected $table = 'item_penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['penjualan_id', 'obat_id', 'jumlah', 'harga'];
}
