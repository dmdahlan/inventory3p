<?php

namespace App\Models;

use CodeIgniter\Model;

class PemakaianBarang extends Model
{
    protected $table = 'pemakaian_barang';
    protected $allowedFields = ['tgl_pakai', 'brand_id', 'no_perbaikan', 'nopol_id', 'keluhan_perbaikan', 'barang_id', 'qty', 'harga', 'total', 'user_id'];
    protected $id = 'id_pakai';
    protected $primaryKey = 'id_pakai';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('id_pakai', 'tgl_pakai', 'brand_name', 'no_perbaikan', 'nopol', 'keluhan_perbaikan', 'nama_barang', 'qty', 'harga', 'total', 'username');
    protected $column_search = array('id_pakai', 'tgl_pakai', 'brand_name', 'no_perbaikan', 'nopol', 'keluhan_perbaikan', 'nama_barang', 'qty', 'harga', 'total', 'username');
    protected $order = array('tgl_pakai' => 'desc');

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
        $this->dt = $this->db->table('pemakaian_barang')
            ->join('users', 'users.id=pemakaian_barang.user_id', 'left')
            ->join('master_barang', 'master_barang.id_barang=pemakaian_barang.barang_id', 'left')
            ->join('master_unit', 'master_unit.id_nopol=pemakaian_barang.nopol_id', 'left');
        $this->dt->where('pemakaian_barang.deleted_at', null);
        $request = \Config\Services::request();
        if ($request->getPost('user')) {
            $this->dt->like('id', $request->getPost('user'));
        }
        if ($request->getPost('brandd')) {
            $this->dt->like('brand_name', $request->getPost('brandd'));
        }
        if ($request->getVar('tgl_awal') && $request->getVar('tgl_akhir')) {
            $this->dt->where('tgl_pakai BETWEEN "' . date('Y-m-d', strtotime($request->getVar('tgl_awal'))) . '" AND "' . date('Y-m-d', strtotime($request->getVar('tgl_akhir'))) . '"');
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
        $query = $this->dt->where('pemakaian_barang.deleted_at', null);
        return $query->countAllResults();
    }
    public function inputby()
    {
        return $this->db->table('pemakaian_barang')
            ->join('users', 'users.id=pemakaian_barang.user_id', 'left')
            ->groupBy('username')
            ->get()->getResultArray();
    }
}
