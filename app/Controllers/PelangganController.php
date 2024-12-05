<?php

namespace App\Controllers;

use App\Models\PelangganModel;

class PelangganController extends BaseController
{
    // Menampilkan daftar pelanggan
    public function index()
    {
        $model = new PelangganModel();
        $data['pelanggan'] = $model->findAll(); // Mengambil semua data pelanggan
        return view('pelanggan/index', $data); // Mengembalikan tampilan index
    }

    // Menampilkan form untuk menambahkan pelanggan baru
    public function create()
    {
        return view('pelanggan/create'); // Mengembalikan tampilan create
    }

    // Menyimpan data pelanggan baru
    public function store()
    {
        $model = new PelangganModel();

        // Validasi data sebelum menyimpan
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]',
            'alamat' => 'required', // Tambahkan validasi untuk alamat
            'telepon' => 'required|numeric', // Validasi untuk telepon
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Menyimpan data pelanggan
        $model->save([
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ]);

        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil ditambahkan.'); // Redirect ke daftar pelanggan
    }

    // Menampilkan form untuk mengedit pelanggan
    public function edit($id)
    {
        $model = new PelangganModel();
        $data['pelanggan'] = $model->find($id); // Mengambil data pelanggan berdasarkan ID

        // Jika tidak ditemukan, redirect kembali
        if (!$data['pelanggan']) {
            return redirect()->to('/pelanggan')->with('error', 'Pelanggan tidak ditemukan.');
        }

        return view('pelanggan/edit', $data); // Mengembalikan tampilan edit
    }

    // Memperbarui data pelanggan
    public function update($id)
    {
        $model = new PelangganModel();

        // Validasi data sebelum memperbarui
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]',
            'alamat' => 'required', // Tambahkan validasi untuk alamat
            'telepon' => 'required|numeric', // Validasi untuk telepon
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ]);

        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil diperbarui.'); // Redirect ke daftar pelanggan
    }

    // Menghapus pelanggan
    public function delete($id)
    {
        $model = new PelangganModel();
        $model->delete($id); // Menghapus data pelanggan
        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil dihapus.'); // Redirect ke daftar pelanggan
    }
}
