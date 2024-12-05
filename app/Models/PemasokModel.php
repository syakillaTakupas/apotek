<?php

namespace App\Models;

use CodeIgniter\Model;

class PemasokModel extends Model
{
    protected $table = 'pemasok';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'kontak'];

    public function getAllPemasok()
    {
        return $this->findAll();
    }
}
