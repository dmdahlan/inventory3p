<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterUnit extends Model
{
    protected $table = 'master_unit';
    protected $allowedFields = ['kode_nopol', 'nopol', 'exp_stnk', 'exp_kir', 'exp_stnk_tahun', 'brand_name', 'ket_nopol'];
    protected $id = 'id_nopol';
    protected $primaryKey = 'id_nopol';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('id_nopol', 'nopol',  'kode_nopol', 'exp_stnk', 'exp_stnk_tahun', 'exp_kir', 'brand_name', 'ket_nopol');
    protected $column_search = array('id_nopol', 'nopol', 'brand_name', 'exp_stnk', 'exp_kir', 'exp_stnk_tahun', 'kode_nopol', 'ket_nopol');
    protected $order = array('nopol' => 'asc');

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
        $this->dt = $this->db->table('master_unit');
        $this->dt->where('deleted_at', null);
        $request = \Config\Services::request();
        if ($request->getPost('brand')) {
            $this->dt->where('brand_name', $request->getPost('brand'));
        }
        if ($request->getPost('stnk')) {
            $this->dt->like('exp_stnk', $request->getPost('stnk'));
        }
        if ($request->getPost('kir')) {
            $this->dt->like('exp_kir', $request->getPost('kir'));
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
    public function expstnk()
    {
        $request = \Config\Services::request();
        if ($request->getPost('brand') == '') {
            $sql = "SELECT
            master_unit.nopol AS nopol,
            master_unit.kode_nopol AS kode_nopol,
            master_unit.exp_stnk as exp_stnk,
            master_unit.exp_stnk_tahun as exp_stnk_tahun,
            master_unit.brand_name as brand_name
            FROM master_unit
            WHERE master_unit.deleted_at is null && -8<DATEDIFF(CURDATE(),master_unit.exp_stnk) AND master_unit.brand_name is not null 
            order by master_unit.exp_stnk ASC ";
            $query = $this->db->query($sql, array())->getResult();
            return $query;
        } else {
            $merek = $request->getPost('brand');
            $sql = "SELECT
            master_unit.nopol AS nopol,
            master_unit.kode_nopol AS kode_nopol,
            master_unit.exp_stnk as exp_stnk,
            master_unit.exp_stnk_tahun as exp_stnk_tahun,
            master_unit.brand_name as brand_name
            FROM master_unit
            WHERE master_unit.deleted_at is null && -8<DATEDIFF(CURDATE(),master_unit.exp_stnk) AND master_unit.brand_name ='$merek' 
            order by master_unit.exp_stnk ASC";
            $query = $this->db->query($sql, array())->getResult();
            return $query;
        }
    }
    public function totalexpstnk()
    {
        $sql = "SELECT
        COUNT(*) AS total
        FROM master_unit
        WHERE master_unit.deleted_at is null && -8<DATEDIFF(CURDATE(),master_unit.exp_stnk)";
        $query = $this->db->query($sql, array());
        return $query;
    }
    public function expkir()
    {
        $request = \Config\Services::request();
        if ($request->getPost('brandd') == '') {
            $sql = "SELECT
            master_unit.nopol AS nopol,
            master_unit.exp_kir as exp_kir,
            master_unit.brand_name as brand_name
            FROM master_unit
            WHERE master_unit.deleted_at is null && -8<DATEDIFF(CURDATE(),master_unit.exp_kir) AND master_unit.brand_name is not null
            ORDER BY master_unit.exp_kir ASC";
            $query = $this->db->query($sql, array())->getResult();
            return $query;
        } else {
            $merekk = $request->getPost('brandd');
            $sql = "SELECT
            master_unit.nopol AS nopol,
            master_unit.exp_kir as exp_kir,
            master_unit.brand_name as brand_name
            FROM master_unit
            WHERE master_unit.deleted_at is null && -8<DATEDIFF(CURDATE(),master_unit.exp_kir) AND master_unit.brand_name ='$merekk'
            ORDER BY master_unit.exp_kir ASC";
            $query = $this->db->query($sql, array())->getResult();
            return $query;
        }
    }
    public function totalexpkir()
    {
        $sql = "SELECT
        COUNT(*) AS total
        FROM master_unit
        WHERE master_unit.deleted_at is null && -8<DATEDIFF(CURDATE(),master_unit.exp_kir)";
        $query = $this->db->query($sql, array());
        return $query;
    }
}
