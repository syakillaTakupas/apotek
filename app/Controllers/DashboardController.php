<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\PemasokModel;
use App\Models\PelangganModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $obatModel = new ObatModel();
        $pemasokModel = new PemasokModel();
        $pelangganModel = new PelangganModel();
//
        $data = [
            'totalObat' => $obatModel->countAllResults(),
            'totalPemasok' => $pemasokModel->countAllResults(),
            'totalPelanggan' => $pelangganModel->countAllResults(),
        ];

        return view('dashboard', $data); // Pastikan Anda mengirimkan $data ke view
    }
}
