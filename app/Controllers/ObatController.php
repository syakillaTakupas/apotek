<?php

namespace App\Controllers;

use App\Models\ObatModel;

class ObatController extends BaseController
{
    // Menampilkan daftar obat
    public function index()
    {
        $model = new ObatModel();
        $data['obat'] = $model->findAll(); // Mengambil semua data obat
        return view('obat/index', $data); // Mengembalikan tampilan index
    }

    // Menampilkan form untuk menambahkan obat baru
    public function create()
    {
        return view('obat/create'); // Mengembalikan tampilan create
    }

    // Menyimpan data obat baru
    public function store()
    {
        $model = new ObatModel();

        // Validasi data sebelum menyimpan
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]',
            'stok' => 'required|numeric', // Validasi untuk stok
            'harga' => 'required|numeric', // Validasi untuk harga
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Menyimpan data obat
        $model->save([
            'nama' => $this->request->getPost('nama'),
            'stok' => $this->request->getPost('stok'),
            'harga' => $this->request->getPost('harga'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa') // Ensure this is included if applicable
        ]);

        return redirect()->to('/obat')->with('success', 'Obat berhasil ditambahkan.'); // Redirect ke daftar obat
    }


    // Menampilkan form untuk mengedit obat
    public function edit($id)
    {
        $model = new ObatModel();
        $data['obat'] = $model->find($id); // Mengambil data obat berdasarkan ID

        // Jika tidak ditemukan, redirect kembali
        if (!$data['obat']) {
            return redirect()->to('/obat')->with('error', 'Obat tidak ditemukan.');
        }

        return view('obat/edit', $data); // Mengembalikan tampilan edit
    }

    // Memperbarui data obat
    public function update($id)
    {
        $model = new ObatModel();

        // Validasi data sebelum memperbarui
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]',
            'stok' => 'required|numeric', // Validasi untuk stok
            'harga' => 'required|numeric', // Validasi untuk harga
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Memperbarui data obat
        $model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'stok' => $this->request->getPost('stok'),
            'harga' => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/obat')->with('success', 'Obat berhasil diperbarui.'); // Redirect ke daftar obat
    }

    // Menghapus obat
    public function delete($id)
    {
        $model = new ObatModel();
        $model->delete($id); // Menghapus data obat
        return redirect()->to('/obat')->with('success', 'Obat berhasil dihapus.'); // Redirect ke daftar obat
    }
}
