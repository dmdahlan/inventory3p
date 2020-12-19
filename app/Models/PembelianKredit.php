<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianKredit extends Model
{
    protected $table = 'pemnelian_kredit';
    protected $allowedFields = ['tgl_nota', 'supplier_id', 'brand_id', 'nopol_id', 'nota_supp', 'nota_order', 'barang_id', 'qty', 'harga', 'disc'];
    protected $id = 'id_kredit';
    protected $primaryKey = 'id_kredit';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('id_kredit', 'tgl_nota', 'supplier_id', 'brand', 'nopol_id', 'nota_supp', 'nota_order', 'barang_id', 'qty', 'harga', 'disc');
    protected $column_search = array('id_kredit', 'tgl_nota', 'supplier_id', 'brand', 'nopol_id', 'nota_supp', 'nota_order', 'barang_id', 'qty', 'harga', 'disc');
    protected $order = array('tgl_nota' => 'desc');

    function get_datatables()
    {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
            $this->dt->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->dt->get();
        return $query->getResult();
    }
    private function _get_datatables_query()
    {
        $this->dt = $this->db->table('pembelian_kredit')
            ->join('master_brand', 'master_brand.id_brand=pembelian_kredit.brand_id', 'left')
            ->join('master_supplier', 'master_supplier.id_supplier=pembelian_kredit.supplier_id', 'left')
            ->join('master_unit', 'master_unit.id_nopol=pembelian_kredit.nopol_id', 'left')
            ->join('master_barang', 'master_barang.id_barang=pembelian_kredit.barang_id', 'left');
        $this->dt->where('pembelian_kredit.deleted_at', null);
        $i = 0;
        foreach ($this->column_search as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $_POST['search']['value']);
                } else {
                    $this->dt->orLike($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->dt->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $query = $this->dt->where('deleted_at', null);
        return $query->countAllResults();
    }
}
