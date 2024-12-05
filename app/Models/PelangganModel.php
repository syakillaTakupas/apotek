<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'alamat', 'telepon'];

    public function getAllPelanggan()
    {
        return $this->findAll();
    }
}
