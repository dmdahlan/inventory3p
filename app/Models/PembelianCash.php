<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianCash extends Model
{
    protected $table = 'pembelian_cash';
    protected $allowedFields = ['tgl_nota', 'nama_toko', 'nopol_id', 'driver_id', 'nota_order', 'barang_id', 'qty', 'harga', 'total'];
    protected $id = 'id_cash';
    protected $primaryKey = 'id_cash';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('pembelian_cash.id_cash', 'pembelian_cash.created_at', 'pembelian_cash.tgl_nota', 'nama_toko', 'master_unit.brand_name', 'master_unit.nopol', 'master_driver.nama', 'pembelian_cash.nota_order', 'nama_barang', 'qty', 'harga', 'total');
    protected $column_search = array('pembelian_cash.id_cash', 'pembelian_cash.tgl_nota', 'nama_toko', 'master_unit.brand_name', 'master_unit.nopol', 'master_driver.nama', 'pembelian_cash.nota_order', 'nama_barang');
    protected $order = array('pembelian_cash.tgl_nota' => 'desc');

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
        $this->dt = $this->db->table('pembelian_cash')
            ->join('master_driver', 'master_driver.id_driver=pembelian_cash.driver_id', 'left')
            ->join('master_unit', 'master_unit.id_nopol=pembelian_cash.nopol_id', 'left')
            ->join('master_barang', 'master_barang.id_barang=pembelian_cash.barang_id', 'left')
            ->join('vw_pembelian_cash', 'vw_pembelian_cash.notaorder_id=pembelian_cash.nota_order', 'left')
            ->select('pembelian_cash.*,pembelian_cash.id_cash,pembelian_cash.created_at,pembelian_cash.tgl_nota,master_driver.nama,master_unit.nopol,master_unit.brand_name,master_barang.nama_barang,vw_pembelian_cash.notaorder_id');
        $this->dt->where('pembelian_cash.deleted_at', null);
        $request = \Config\Services::request();
        if ($request->getPost('brandd')) {
            $this->dt->like('master_unit.brand_name', $request->getPost('brandd'));
        }
        if ($request->getPost('tgl_awal') && $request->getPost('tgl_akhir')) {
            $this->dt->where('pembelian_cash.tgl_nota BETWEEN "' . date('Y-m-d', strtotime($request->getPost('tgl_awal'))) . '" AND "' . date('Y-m-d', strtotime($request->getPost('tgl_akhir'))) . '"');
        }
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
