<?php

namespace App\Controllers;

use App\Models\ItemPesananPembelianModel;
use App\Models\PesananPembelianModel;
use App\Models\ObatModel;

class ItemPesananPembelian extends BaseController
{
    public function index()
    {
        $model = new ItemPesananPembelianModel();
        $data['items'] = $model->findAll();
        return view('item_pesanan_pembelian/index', $data);
    }

    public function create()
    {
        $pesananModel = new PesananPembelianModel();
        $data['pesanan'] = $pesananModel->findAll();

        $obatModel = new ObatModel();
        $data['obat'] = $obatModel->findAll();
        return view('item_pesanan_pembelian/create', $data);
    }

    public function store()
    {
        $model = new ItemPesananPembelianModel();
        $model->save($this->request->getPost());
        return redirect()->to('/item_pesanan_pembelian');
    }

    public function edit($id)
    {
        $model = new ItemPesananPembelianModel();
        $data['item'] = $model->find($id);
        return view('item_pesanan_pembelian/edit', $data);
    }

    public function update($id)
    {
        $model = new ItemPesananPembelianModel();
        $model->update($id, $this->request->getPost());
        return redirect()->to('/item_pesanan_pembelian');
    }

    public function delete($id)
    {
        $model = new ItemPesananPembelianModel();
        $model->delete($id);
        return redirect()->to('/item_pesanan_pembelian');
    }
}
