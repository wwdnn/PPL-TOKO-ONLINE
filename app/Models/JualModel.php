<?php

namespace App\Models;
use CodeIgniter\Model;

class JualModel extends Model
{
  protected $table = 'jual';
  protected $primaryKey = 'id_jual';
  protected $allowedFields = ['id_jual', 'kode_barang', 'nomor_transaksi', 'jumlah_terjual', 'harga_jual'];
}