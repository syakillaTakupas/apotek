<?php

namespace App\Controllers;

use App\Models\PenjualanModel;
use App\Models\PelangganModel;
use App\Models\ItemPenjualanModel;
use App\Models\ObatModel;

class PenjualanController extends BaseController
{
    protected $penjualanModel;
    protected $pelangganModel;
    protected $itemPenjualanModel;
    protected $obatModel;

    public function __construct()
    {
        $this->penjualanModel = new PenjualanModel();
        $this->pelangganModel = new PelangganModel();
        $this->itemPenjualanModel = new ItemPenjualanModel();
        $this->obatModel = new ObatModel(); // Pastikan model ObatModel sudah dibuat
    }

    public function index()
    {
        $penjualan = $this->penjualanModel->findAll();

        foreach ($penjualan as &$p) {
            $pelanggan = $this->pelangganModel->find($p['pelanggan_id']);
            $p['nama_pelanggan'] = $pelanggan ? $pelanggan['nama'] : 'Tidak Diketahui';

            // Ambil item penjualan untuk ditampilkan
            $itemPenjualans = $this->itemPenjualanModel->where('penjualan_id', $p['id'])->findAll();
            foreach ($itemPenjualans as &$item) {
                $obat = $this->obatModel->find($item['obat_id']);
                $item['nama_obat'] = $obat ? $obat['nama'] : 'Tidak Diketahui';
            }
            $p['item_penjualan'] = $itemPenjualans;
        }

        return view('penjualan/index', ['penjualan' => $penjualan]);
    }

    public function create()
    {
        $data['pelanggan'] = $this->pelangganModel->findAll();
        $data['obat'] = $this->obatModel->findAll();
        return view('penjualan/create', $data);
    }

    public function store()
    {
        $model = new PenjualanModel();
        $obatData = $this->request->getPost('obat');

        $total_harga = 0; // Inisialisasi total harga

        // Menghitung total harga
        foreach ($obatData as $item) {
            $harga = (float)$item['harga'];
            $jumlah = (int)$item['jumlah'];
            $total_harga += $harga * $jumlah; // Hitung total harga
        }

        // Simpan penjualan dengan total harga
        $penjualanData = [
            'pelanggan_id' => $this->request->getPost('pelanggan_id'),
            'tanggal_jual' => date('Y-m-d H:i:s'), // Simpan tanggal penjualan
            'total_harga' => $total_harga // Simpan total harga
        ];

        $model->save($penjualanData); // Simpan data penjualan

        // Simpan item penjualan di tabel item_penjualan
        $itemModel = new ItemPenjualanModel();
        $penjualanID = $model->insertID(); // Ambil ID penjualan terakhir
        foreach ($obatData as $item) {
            $itemModel->save([
                'penjualan_id' => $penjualanID, // ID penjualan yang baru dibuat
                'obat_id' => $item['id'],
                'jumlah' => (int)$item['jumlah'],
                'harga' => (float)$item['harga']
            ]);

            // Update stok obat
            $obatModel = new \App\Models\ObatModel(); // Pastikan model ObatModel sudah dibuat
            $obat = $obatModel->find($item['id']);
            $obatModel->update($item['id'], [
                'stok' => $obat['stok'] - (int)$item['jumlah'] // Kurangi stok sesuai jumlah yang terjual
            ]);
        }

        return redirect()->to('/penjualan');
    }


    public function edit($id)
    {
        $model = new PenjualanModel();
        $data['penjualan'] = $model->find($id);

        // Ambil data pelanggan dan obat untuk ditampilkan di dropdown
        $pelangganModel = new PelangganModel();
        $obatModel = new \App\Models\ObatModel();
        $data['pelanggan'] = $pelangganModel->findAll();
        $data['obat'] = $obatModel->findAll();

        // Ambil item penjualan untuk ditampilkan di form edit
        $itemModel = new ItemPenjualanModel();
        $data['item_penjualan'] = $itemModel->where('penjualan_id', $id)->findAll();

        return view('penjualan/edit', $data);
    }


    public function update($id)
    {
        $model = new PenjualanModel();
        $obatData = $this->request->getPost('obat');

        // Hapus item penjualan yang lama dan update stok
        $itemModel = new ItemPenjualanModel();
        $oldItems = $itemModel->where('penjualan_id', $id)->findAll();

        foreach ($oldItems as $oldItem) {
            // Kembalikan stok obat yang sudah terjual
            $obatModel = new \App\Models\ObatModel();
            $obat = $obatModel->find($oldItem['obat_id']);
            $obatModel->update($oldItem['obat_id'], [
                'stok' => $obat['stok'] + $oldItem['jumlah'] // Kembalikan stok
            ]);
        }

        // Inisialisasi total harga
        $total_harga = 0;

        // Menghitung total harga
        foreach ($obatData as $item) {
            $harga = (float)$item['harga'];
            $jumlah = (int)$item['jumlah'];
            $total_harga += $harga * $jumlah;
        }

        // Simpan penjualan dengan total harga
        $penjualanData = [
            'pelanggan_id' => $this->request->getPost('pelanggan_id'),
            'tanggal_jual' => date('Y-m-d H:i:s'), // Simpan tanggal penjualan
            'total_harga' => $total_harga // Simpan total harga
        ];

        $model->update($id, $penjualanData); // Update data penjualan

        // Simpan item penjualan di tabel item_penjualan
        $itemModel->where('penjualan_id', $id)->delete(); // Hapus item penjualan yang lama

        foreach ($obatData as $item) {
            $itemModel->save([
                'penjualan_id' => $id, // ID penjualan yang diupdate
                'obat_id' => $item['id'],
                'jumlah' => (int)$item['jumlah'],
                'harga' => (float)$item['harga']
            ]);

            // Update stok obat
            $obatModel = new \App\Models\ObatModel(); // Pastikan model ObatModel sudah dibuat
            $obat = $obatModel->find($item['id']);
            $obatModel->update($item['id'], [
                'stok' => $obat['stok'] - (int)$item['jumlah'] // Kurangi stok sesuai jumlah yang terjual
            ]);
        }

        return redirect()->to('/penjualan');
    }


    public function delete($id)
    {
        // Hapus item penjualan terkait
        $this->itemPenjualanModel->where('penjualan_id', $id)->delete();
        // Hapus penjualan
        $this->penjualanModel->delete($id);
        return redirect()->to('/penjualan');
    }

    public function detail($id)
    {
        $penjualan = $this->penjualanModel->find($id);

        // Ambil nama pelanggan
        $pelanggan = $this->pelangganModel->find($penjualan['pelanggan_id']);
        $penjualan['nama_pelanggan'] = $pelanggan ? $pelanggan['nama'] : 'Tidak Diketahui';

        // Ambil item penjualan
        $itemPenjualans = $this->itemPenjualanModel->where('penjualan_id', $id)->findAll();
        foreach ($itemPenjualans as &$item) {
            $obat = $this->obatModel->find($item['obat_id']);
            $item['nama_obat'] = $obat ? $obat['nama'] : 'Tidak Diketahui';
        }

        $penjualan['item_penjualan'] = $itemPenjualans;

        return view('penjualan/detail', ['penjualan' => $penjualan]);
    }


    public function bayar($id)
    {
        $penjualan = $this->penjualanModel->find($id);

        // Pastikan penjualan ditemukan
        if (!$penjualan) {
            return redirect()->to('/penjualan')->with('error', 'Penjualan tidak ditemukan.');
        }

        // Tandai penjualan sebagai "dibayar"
        $this->penjualanModel->update($id, ['status' => 'dibayar']);

        return redirect()->to('/penjualan')->with('success', 'Pembayaran berhasil dilakukan.');
    }

    public function prosesBayar($id)
    {
        $penjualan = $this->penjualanModel->find($id);
        if (!$penjualan) {
            return redirect()->to('/penjualan')->with('error', 'Penjualan tidak ditemukan.');
        }

        // Perbarui status pembayaran
        $this->penjualanModel->update($id, ['status' => 'dibayar']);

        return redirect()->to('/penjualan')->with('success', 'Pembayaran berhasil dilakukan.');
    }
}
