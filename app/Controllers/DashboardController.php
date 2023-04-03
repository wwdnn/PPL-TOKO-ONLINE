<?php

namespace App\Controllers;
use App\Models\BarangModel as BarangModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $model = new BarangModel();

        $data = [
            'barangs' => $model->getAllBarang()
        ];
        
        return view('DashboardView', $data);
    }

    public function cek()
    {
        $cart = \Config\Services::cart();
        $response = $cart->contents();
        // buatkan dalam bentuk json ke bawah
        // $data = json_encode($response);
        echo '<pre>';
        print_r($response);
        echo '</pre>';
    }

    // Masukkan ke keranjang
    public function addToCart()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id' => $this->request->getPost('kode_barang'),
            'name' => $this->request->getPost('nama_barang'),
            'price' => $this->request->getPost('harga_barang'),
            'qty' => 1,
            'options' => array(
                'gambar_barang' => $this->request->getPost('gambar_barang'),
            )
        ));

        return redirect()->to(base_url());
    }
}
