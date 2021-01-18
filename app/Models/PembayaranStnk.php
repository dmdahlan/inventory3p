<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranStnk extends Model
{
    protected $table = 'pembayaran_stnk';
    protected $allowedFields = ['nopol_id', 'tgl_bayar', 'stnk_kir', 'expired', 'nominal_bayar', 'via', 'bank', 'nominal_simulasi', 'nominal_pengurusan'];
    protected $id = 'id_bayarstnk';
    protected $primaryKey = 'id_bayarstnk';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('id_bayarstnk', 'tgl_bayar', 'nopol', 'brand_name', 'stnk_kir', 'expired', 'nominal_bayar', 'via', 'bank',  'nominal_pengurusan', 'nominal_simulasi', null);
    protected $column_search = array('id_bayarstnk', 'tgl_bayar', 'nopol', 'brand_name', 'stnk_kir', 'expired', 'nominal_bayar', 'via', 'bank', 'nominal_simulasi', 'nominal_pengurusan');
    protected $order = array('tgl_bayar' => 'asc');

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
        $this->dt = $this->db->table('pembayaran_stnk')
            ->join('master_unit', 'master_unit.id_nopol=pembayaran_stnk.nopol_id', 'left');
        $this->dt->where('pembayaran_stnk.deleted_at', null);
        $request = \Config\Services::request();
        if ($request->getPost('brandd')) {
            $this->dt->like('master_unit.brand_name', $request->getPost('brandd'));
        }
        if ($request->getPost('tgl_awal') && $request->getPost('tgl_akhir')) {
            $this->dt->where('tgl_bayar BETWEEN "' . date('Y-m-d', strtotime($request->getPost('tgl_awal'))) . '" AND "' . date('Y-m-d', strtotime($request->getPost('tgl_akhir'))) . '"');
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
        $query = $this->dt->where('pembayaran_stnk.deleted_at', null);
        return $query->countAllResults();
    }
}
