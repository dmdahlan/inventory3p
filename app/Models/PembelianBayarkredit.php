<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianBayarkredit extends Model
{
    protected $table = 'pembayaran_kredit';
    protected $allowedFields = ['kredit_id', 'tgl_bayar1', 'bank1', 'via1', 'nominal1', 'tgl_bayar2', 'bank2', 'via2', 'nominal2', 'sisa_hutang'];
    protected $id = 'id_bayarkredit';
    protected $primaryKey = 'id_bayarkredit';
    protected $useTimestamps = true;

    protected $column_order = array('id_kredit', 'tgl_nota', 'supplier', 'nota_order', 'total', 'tgl_bayar1', 'bank1', 'via1', 'nominal1', 'tgl_bayar2', 'bank2', 'via2', 'nominal2');
    protected $column_search = array('id_kredit', 'supplier', 'nota_order', 'total', 'tgl_bayar1', 'bank1', 'via1', 'nominal1', 'tgl_bayar2', 'bank2', 'via2', 'nominal2');
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
            ->join('master_supplier', 'master_supplier.id_supplier=pembelian_kredit.supplier_id', 'left')
            ->join('pembayaran_kredit', 'pembayaran_kredit.kredit_id=pembelian_kredit.id_kredit', 'left');
        $this->dt->where('pembelian_kredit.deleted_at', null);
        $request = \Config\Services::request();
        if ($request->getPost('brandd')) {
            $this->dt->like('brand_id', $request->getPost('brandd'));
        }
        if ($request->getPost('tgl_awal') && $request->getPost('tgl_akhir')) {
            $this->dt->where('tgl_nota BETWEEN "' . date('Y-m-d', strtotime($request->getPost('tgl_awal'))) . '" AND "' . date('Y-m-d', strtotime($request->getPost('tgl_akhir'))) . '"');
        }
        if ($request->getPost('ketlunas') == 'lunas') {
            $this->dt->where('sisa_hutang', 0);
        }
        if ($request->getPost('ketlunas') == 'blmbayar') {
            $this->dt->where('sisa_hutang ', null);
        }
        if ($request->getPost('ketlunas') == 'blmlunas') {
            $this->dt->where('sisa_hutang !=', 0);
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
    public function getdata($id)
    {
        $this->di = $this->db->table('pembelian_kredit')
            ->join('master_supplier', 'master_supplier.id_supplier=pembelian_kredit.supplier_id', 'left')
            ->join('pembayaran_kredit', 'pembayaran_kredit.kredit_id=pembelian_kredit.id_kredit', 'left');
        $this->di->where('pembelian_kredit.deleted_at', null);
        return $this->di->getWhere(['id_kredit' => $id])->getRowArray();
    }
}
