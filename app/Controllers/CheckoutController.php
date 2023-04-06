<?php

namespace App\Controllers;

class CheckoutController extends BaseController
{
  public function index()
  {
    $carts = \Config\Services::cart();
    $data = [
      'carts' => $carts->contents()
    ];

    return view('CheckoutView', $data);
  }

  public function process()
  {
    $carts = \Config\Services::cart();
    $transaksi = new \App\Models\TransaksiModel();

    // get data from form
    $data = [
      'nomor_transaksi' => $transaksi->countAllResults() + 1,
      'nama_pembeli' => $this->request->getPost('nama_pembeli'),
      'nomor_pembeli' => $this->request->getPost('nomor_pembeli'),
      'alamat_pembeli' => $this->request->getPost('alamat_pembeli'),
      'kecamatan_pembeli' => $this->request->getPost('kecamatan_pembeli'),
      'kota_pembeli' => $this->request->getPost('kota_pembeli'),
      'provinsi_pembeli' => $this->request->getPost('provinsi_pembeli'),
      'kodePos_pembeli' => $this->request->getPost('kodePos_pembeli'),
      'total_harga' => $carts->total(),
      'tanggal_transaksi' => date('Y-m-d')
    ];

    $validate = $this->validate([
      'nama_pembeli' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama pembeli harus diisi'
        ]
      ],
      'nomor_pembeli' => [
        'rules' => 'required|numeric|min_length[10]|max_length[13]',
        'errors' => [
          'required' => 'Nomor pembeli harus diisi',
          'numeric' => 'Nomor pembeli harus berupa angka dengan diawali 08',
          'min_length' => 'Nomor pembeli harus berupa angka dengan diawali 08',
          'max_length' => 'Nomor pembeli harus berupa angka dengan diawali 08'
        ]
      ],
      'alamat_pembeli' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Alamat pembeli harus diisi'
        ]
      ],
      'kecamatan_pembeli' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Kecamatan pembeli harus diisi'
        ]
      ],
      'kota_pembeli' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Kota pembeli harus diisi'
        ]
      ],
      'provinsi_pembeli' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Provinsi pembeli harus diisi'
        ]
      ],
      'kodePos_pembeli' => [
        'rules' => 'required|numeric|min_length[5]|max_length[5]',
        'errors' => [
          'required' => 'Kode pos pembeli harus diisi',
          'numeric' => 'Kode pos pembeli harus berupa angka',
          'min_length' => 'Kode pos pembeli harus berupa angka',
          'max_length' => 'Kode pos pembeli harus berupa angka'
        ]
      ]
    ]);

  
    // if nomor pembeli tidak diawali 08
    if (substr($data['nomor_pembeli'], 0, 2) != '08') {
      return view('CheckoutView', [
        'validation' => $this->validator,
        'carts' => $carts->contents()
      ]);
    }

    // validate data
    if (!$validate) {
      return view('CheckoutView', [
        'validation' => $this->validator,
        'carts' => $carts->contents()
      ]);
    }

    // insert data to database
    $transaksi->insert($data);

    // insert detail transaksi
    $detail_transaksi = new \App\Models\JualModel();
    $barang = new \App\Models\BarangModel();


    foreach ($carts->contents() as $item) {
      $detail_transaksi->insert([
        'id_jual' => $detail_transaksi->countAllResults() + 1,
        'nomor_transaksi' => $data['nomor_transaksi'],
        'kode_barang' => $item['id'],
        'jumlah_terjual' => $item['qty'],
        'harga_jual' => $item['price']
      ]);

      // get stok barang
      $stok_barang = $barang->getStok($item['id']);
      // parse to int
      $stok_barang = (int) $stok_barang['stok_barang'];

      // update stok barang
      $barang->update($item['id'], [
        'stok_barang' => $stok_barang - $item['qty']
      ]);
    }

    // destroy cart
    $carts->destroy();

    // return with message
    return redirect()->to(base_url('/'))->with('success', 'Transaksi berhasil');
  }
}
