<?php

namespace App\Models;

use CodeIgniter\Model;

class Memo extends Model
{
    protected $table = 'memo';
    protected $allowedFields = ['from_id', 'to_id', 'subject', 'isi_memo'];
    protected $id = 'id_memo';
    protected $primaryKey = 'id_memo';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('id_memo', 'username', 'isi_memo', 'memo.created_at');
    protected $column_search = array('id_memo', 'username', 'isi_memo', 'memo.created_at');
    protected $order = array('ket_memo' => 'asc');

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
        $this->dt = $this->db->table('memo')
            ->join('users', 'users.id=memo.from_id', 'left')
            ->select('memo.*,users.username,memo.created_at');
        $this->dt->where('memo.deleted_at', null);
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
    public function view_memo()
    {
        return $this->db->table('memo')
            ->where('memo.deleted_at', null)
            ->where('memo.ket_memo', null)
            ->where('to_id', user()->id)
            ->countAllResults();
    }
    public function readmemo()
    {
        return $this->db->table('memo')
            ->join('users', 'users.id=memo.from_id', 'left')
            ->select('memo.*,users.username,memo.created_at')
            ->where('memo.deleted_at', null)
            ->where('memo.ket_memo', null)
            ->where('to_id', user()->id)
            ->get()->getResultArray();
    }
    public function memook($id)
    {
        return $this->db->table('memo')
            ->set('ket_memo', '1')
            ->where('id_memo', $id)
            ->update();
    }
}
