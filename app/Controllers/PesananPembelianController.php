<?php

namespace App\Controllers;

use App\Models\PesananPembelianModel;
use App\Models\PemasokModel;
use App\Models\ObatModel;
use App\Models\ItemPesananPembelianModel;

class PesananPembelianController extends BaseController
{
    protected $pesananPembelianModel;
    protected $pemasokModel;
    protected $obatModel;
    protected $itemModel;

    public function __construct()
    {
        $this->pesananPembelianModel = new PesananPembelianModel();
        $this->pemasokModel = new PemasokModel();
        $this->obatModel = new ObatModel();
        $this->itemModel = new ItemPesananPembelianModel();
    }

    public function index()
    {
        $data['pesanan_pembelian'] = $this->pesananPembelianModel->findAll();

        // Mengambil total harga untuk setiap pesanan pembelian
        foreach ($data['pesanan_pembelian'] as &$pesanan) {
            $totalHarga = 0;
            // Ambil detail item pesanan
            $items = $this->itemModel->where('pesanan_pembelian_id', $pesanan['id'])->findAll();

            foreach ($items as $item) {
                $obat = $this->obatModel->find($item['obat_id']);
                $totalHarga += $obat['harga'] * $item['jumlah']; // Hitung total harga
            }

            $pesanan['total_harga'] = $totalHarga; // Simpan total harga dalam array
            // Dapatkan nama pemasok
            $pemasok = $this->pemasokModel->find($pesanan['pemasok_id']);
            $pesanan['nama_pemasok'] = $pemasok['nama'] ?? 'Tidak Diketahui';
        }

        return view('pesanan_pembelian/index', $data);
    }

    public function create()
    {
        $data['pemasok'] = $this->pemasokModel->findAll();
        $data['obat'] = $this->obatModel->findAll(); // Mengambil semua obat

        return view('pesanan_pembelian/create', $data);
    }

    public function store()
    {
        $pemasok_id = $this->request->getPost('pemasok_id');
        $obat_ids = $this->request->getPost('obat_id');
        $jumlahs = $this->request->getPost('jumlah');
        $tanggal_pesan = $this->request->getPost('tanggal_pesan');

        // Simpan pesanan pembelian
        $data = [
            'pemasok_id' => $pemasok_id,
            'tanggal_pesan' => $tanggal_pesan,
        ];

        $this->pesananPembelianModel->insert($data);
        $pesanan_id = $this->pesananPembelianModel->insertID(); // Ambil ID pesanan yang baru saja dibuat

        // Update stok untuk setiap obat yang dipesan
        foreach ($obat_ids as $obat_id) {
            $jumlah = $jumlahs[$obat_id];

            // Ambil stok obat saat ini
            $obat = $this->obatModel->find($obat_id);
            if ($obat) {
                $stok_sekarang = $obat['stok'];

                // Hitung stok baru
                $stok_baru = $stok_sekarang + $jumlah;

                // Update stok obat
                $this->obatModel->update($obat_id, ['stok' => $stok_baru]);

                // Simpan item pesanan pembelian
                $itemData = [
                    'pesanan_pembelian_id' => $pesanan_id,
                    'obat_id' => $obat_id,
                    'jumlah' => $jumlah,
                ];
                $this->itemModel->insert($itemData);
            }
        }

        return redirect()->to(base_url('pesanan_pembelian'))->with('success', 'Pesanan pembelian berhasil ditambahkan dan stok obat diperbarui.');
    }

    public function edit($id)
    {
        $data['pesanan'] = $this->pesananPembelianModel->find($id);
        if (!$data['pesanan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesanan Pembelian tidak ditemukan');
        }

        $data['pemasok'] = $this->pemasokModel->findAll();
        $data['obat'] = $this->obatModel->findAll();
        $data['item'] = $this->itemModel->where('pesanan_pembelian_id', $id)->findAll(); // Ambil item obat yang dipilih

        return view('pesanan_pembelian/edit', $data);
    }

    public function update($id)
    {
        // Validasi data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'pemasok_id' => 'required',
            'tanggal_pesan' => 'required|valid_date',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Update pesanan pembelian
        $data = [
            'pemasok_id' => $this->request->getPost('pemasok_id'),
            'tanggal_pesan' => $this->request->getPost('tanggal_pesan'),
        ];
        $this->pesananPembelianModel->update($id, $data);

        // Hapus item sebelumnya
        $this->itemModel->where('pesanan_pembelian_id', $id)->delete();

        // Simpan hubungan baru antara pesanan pembelian dan obat
        if ($this->request->getPost('obat_id')) {
            foreach ($this->request->getPost('obat_id') as $obatId) {
                $itemData = [
                    'pesanan_pembelian_id' => $id,
                    'obat_id' => $obatId,
                    'jumlah' => $this->request->getPost('jumlah')[$obatId], // Ambil jumlah dari input
                ];
                $this->itemModel->save($itemData);

                // Update stok obat
                $obat = $this->obatModel->find($obatId);
                if ($obat) {
                    $stok_baru = $obat['stok'] + $this->request->getPost('jumlah')[$obatId];
                    $this->obatModel->update($obatId, ['stok' => $stok_baru]);
                }
            }
        }

        return redirect()->to('/pesanan_pembelian')->with('success', 'Pesanan pembelian berhasil diperbarui.');
    }

    public function delete($id)
    {
        // Hapus item terkait
        $this->itemModel->where('pesanan_pembelian_id', $id)->delete();
        // Hapus pesanan pembelian
        $this->pesananPembelianModel->delete($id);

        return redirect()->to('/pesanan_pembelian')->with('success', 'Pesanan pembelian berhasil dihapus.');
    }
}
