<?php

namespace App\Controllers;

use App\Models\PemasokModel;

class PemasokController extends BaseController
{
    public function index()
    {
        $model = new PemasokModel();
        $data['pemasok'] = $model->findAll();
        return view('pemasok/index', $data);
    }

    public function create()
    {
        return view('pemasok/create');
    }

    public function store()
    {
        $model = new PemasokModel();
        $model->save($this->request->getPost());
        return redirect()->to('/pemasok');
    }

    public function edit($id)
    {
        $model = new PemasokModel();
        $data['pemasok'] = $model->find($id);
        return view('pemasok/edit', $data);
    }

    public function update($id)
    {
        $model = new PemasokModel();
        $model->update($id, $this->request->getPost());
        return redirect()->to('/pemasok');
    }

    public function delete($id)
    {
        $model = new PemasokModel();
        $model->delete($id);
        return redirect()->to('/pemasok');
    }
}
