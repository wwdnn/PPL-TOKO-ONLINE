<?php

  // Models
  namespace App\Models;
  use CodeIgniter\Model;
  
  class BarangModel extends Model
  { 
    protected $table = 'barang';
    protected $primaryKey = 'kode_barang';
    protected $allowedFields = ['nama_barang', 'harga_barang', 'stok_barang', 'gambar_barang'];

    public function __construct()
    { 
      // connect db
      $this->db = \Config\Database::connect();
    }

    public function getAllBarang()
    {
      $sql = "SELECT * FROM barang";
      $query = $this->db->query($sql);
      return $query->getResultArray();
    }

    public function getBarang($kode_barang)
    {
      $sql = "SELECT * FROM barang WHERE kode_barang = ?";
      $query = $this->db->query($sql, [$kode_barang]);
      return $query->getRowArray();
    }

    public function getStok($kode_barang)
    {
      $sql = "SELECT stok_barang FROM barang WHERE kode_barang = ?";
      $query = $this->db->query($sql, [$kode_barang]);
      return $query->getRowArray();
    }
  }