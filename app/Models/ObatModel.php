<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table = 'obat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'stok', 'harga', 'tanggal_kadaluarsa'];

    public function getAllObat()
    {
        return $this->findAll();
    }
}
