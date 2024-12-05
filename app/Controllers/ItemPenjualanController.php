namespace App\Controllers;

use App\Models\ItemPenjualanModel;
use App\Models\PenjualanModel;
use App\Models\ObatModel;

class ItemPenjualan extends BaseController
{
public function index()
{
$model = new ItemPenjualanModel();
$data['items'] = $model->findAll();
return view('item_penjualan/index', $data);
}

public function create()
{
$penjualanModel = new PenjualanModel();
$data['penjualan'] = $penjualanModel->findAll();

$obatModel = new ObatModel();
$data['obat'] = $obatModel->findAll();
return view('item_penjualan/create', $data);
}

public function store()
{
$model = new ItemPenjualanModel();
$model->save($this->request->getPost());
return redirect()->to('/item_penjualan');
}

public function edit($id)
{
$model = new ItemPenjualanModel();
$data['item'] = $model->find($id);
return view('item_penjualan/edit', $data);
}

public function update($id)
{
$model = new ItemPenjualanModel();
$model->update($id, $this->request->getPost());
return redirect()->to('/item_penjualan');
}

public function delete($id)
{
$model = new ItemPenjualanModel();
$model->delete($id);
return redirect()->to('/item_penjualan');
}
}