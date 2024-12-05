<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananPembelianModel extends Model
{
    protected $table = 'pesanan_pembelian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pemasok_id', 'tanggal_pesan'];
}
