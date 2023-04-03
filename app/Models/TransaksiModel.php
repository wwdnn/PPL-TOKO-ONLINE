<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
  protected $table = 'transaksi';
  protected $primaryKey = 'nomor_transaksi';
  protected $allowedFields = ['nomor_transaksi', 'nama_pembeli', 'nomor_pembeli', 'alamat_pembeli', 'kecamatan_pembeli', 'kota_pembeli', 'provinsi_pembeli', 'kodePos_pembeli', 'total_harga', 'tanggal_transaksi'];

  public function __construct()
  {
    // connect db
    $this->db = \Config\Database::connect();
  }
}
