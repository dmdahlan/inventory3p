<?php

namespace App\Models;

use CodeIgniter\Model;

class PrintPokredit extends Model
{
    protected $primaryKey = 'id_kredit';

    public function inv($keyword)
    {
        return $this->db->table('pembelian_kredit')
            ->join('master_brand', 'master_brand.id_brand=pembelian_kredit.brand_id', 'left')
            ->join('master_supplier', 'master_supplier.id_supplier=pembelian_kredit.supplier_id', 'left')
            ->join('master_unit', 'master_unit.id_nopol=pembelian_kredit.nopol_id', 'left')
            ->join('master_barang', 'master_barang.id_barang=pembelian_kredit.barang_id', 'left')
            ->where('nota_order', $keyword)
            ->get()->getResultArray();
    }
    public function ket($keyword)
    {
        return $this->db->table('pembelian_kredit')
            ->join('master_brand', 'master_brand.id_brand=pembelian_kredit.brand_id', 'left')
            ->join('master_supplier', 'master_supplier.id_supplier=pembelian_kredit.supplier_id', 'left')
            ->join('master_unit', 'master_unit.id_nopol=pembelian_kredit.nopol_id', 'left')
            ->join('master_barang', 'master_barang.id_barang=pembelian_kredit.barang_id', 'left')
            ->where('nota_order', $keyword)
            ->get()->getRowArray();
    }
    public function max()
    {
        return $this->db->table('pembelian_kredit')
            ->selectMax('nota_order')->get()->getRowArray();
    }
}
