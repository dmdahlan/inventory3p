<?php

namespace App\Models;

use CodeIgniter\Model;

class PrintPocash extends Model
{
    protected $primaryKey = 'id_cash';

    public function inv($keyword)
    {
        return $this->db->table('pembelian_cash')
            ->join('master_brand', 'master_brand.id_brand=pembelian_cash.brand_id', 'left')
            ->join('master_driver', 'master_driver.id_driver=pembelian_cash.driver_id', 'left')
            ->join('master_unit', 'master_unit.id_nopol=pembelian_cash.nopol_id', 'left')
            ->join('master_barang', 'master_barang.id_barang=pembelian_cash.barang_id', 'left')
            ->where('nota_order', $keyword)
            ->get()->getResultArray();
    }
    public function ket($keyword)
    {
        return $this->db->table('pembelian_cash')
            ->join('master_brand', 'master_brand.id_brand=pembelian_cash.brand_id', 'left')
            ->join('master_driver', 'master_driver.id_driver=pembelian_cash.driver_id', 'left')
            ->join('master_unit', 'master_unit.id_nopol=pembelian_cash.nopol_id', 'left')
            ->join('master_barang', 'master_barang.id_barang=pembelian_cash.barang_id', 'left')
            ->where('nota_order', $keyword)
            ->get()->getRowArray();
    }
    public function max()
    {
        return $this->db->table('pembelian_cash')
            ->selectMax('nota_order')->get()->getRowArray();
    }
}
