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
    // generate nomor transaksi
    $nomor_transaksi = $transaksi->countAllResults() + 1;
    $nama_pembeli = $this->request->getPost('nama_pembeli');
    $nomor_pembeli = $this->request->getPost('nomor_pembeli');
    $alamat_pembeli = $this->request->getPost('alamat_pembeli');
    $kecamatan_pembeli = $this->request->getPost('kecamatan_pembeli');
    $kota_pembeli = $this->request->getPost('kota_pembeli');
    $provinsi_pembeli = $this->request->getPost('provinsi_pembeli');
    $kodePos_pembeli = $this->request->getPost('kodePos_pembeli');
    $total_harga = $carts->total();
    $tanggal_transaksi = date('Y-m-d');

    // insert data to database
    $transaksi->insert([
      'nomor_transaksi' => $nomor_transaksi,
      'nama_pembeli' => $nama_pembeli,
      'nomor_pembeli' => $nomor_pembeli,
      'alamat_pembeli' => $alamat_pembeli,
      'kecamatan_pembeli' => $kecamatan_pembeli,
      'kota_pembeli' => $kota_pembeli,
      'provinsi_pembeli' => $provinsi_pembeli,
      'kodePos_pembeli' => $kodePos_pembeli,
      'total_harga' => $total_harga,
      'tanggal_transaksi' => $tanggal_transaksi
    ]);

    // insert detail transaksi
    $detail_transaksi = new \App\Models\JualModel();
    $barang = new \App\Models\BarangModel();


    foreach($carts->contents() as $item) {
      $detail_transaksi->insert([
        'id_jual' => $detail_transaksi->countAllResults() + 1,
        'nomor_transaksi' => $nomor_transaksi,
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