<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianKredit extends Model
{
    protected $table = 'pembelian_kredit';
    protected $allowedFields = ['tgl_nota', 'supplier_id', 'nopol_id', 'nota_supp', 'nota_order', 'barang_id', 'rincian_kredit', 'qty', 'harga', 'disc', 'pembelianppn', 'total', 'ket_kredit'];
    protected $id = 'id_kredit';
    protected $primaryKey = 'id_kredit';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('pembelian_kredit.id_kredit', 'pembelian_kredit.created_at', 'pembelian_kredit.tgl_nota', 'master_supplier.supplier', 'master_unit.brand_name', 'master_unit.nopol', 'pembelian_kredit.nota_supp', 'pembelian_kredit.nota_order', 'master_barang.nama_barang', 'pembelian_kredit.rincian_kredit', 'pembelian_kredit.qty', 'pembelian_kredit.harga', 'pembelian_kredit.disc', 'pembelian_kredit.pembelianppn', 'pembelian_kredit.total', 'ket_kredit');
    protected $column_search = array('pembelian_kredit.id_kredit', 'pembelian_kredit.tgl_nota', 'master_supplier.supplier', 'master_unit.brand_name', 'master_unit.nopol', 'pembelian_kredit.nota_supp', 'pembelian_kredit.nota_order', 'master_barang.nama_barang', 'pembelian_kredit.rincian_kredit', 'pembelian_kredit.qty', 'pembelian_kredit.harga', 'pembelian_kredit.disc', 'pembelian_kredit.pembelianppn', 'pembelian_kredit.total', 'ket_kredit');
    protected $order = array('pembelian_kredit.tgl_nota' => 'desc');

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
            ->join('master_unit', 'master_unit.id_nopol=pembelian_kredit.nopol_id', 'left')
            ->join('master_barang', 'master_barang.id_barang=pembelian_kredit.barang_id', 'left')
            ->join('vw_pembelian_kredit', 'vw_pembelian_kredit.notaorder_id=pembelian_kredit.nota_order', 'left')
            ->select('pembelian_kredit.*,pembelian_kredit.id_kredit,pembelian_kredit.created_at,master_supplier.supplier,master_unit.nopol,master_unit.brand_name,master_barang.nama_barang,vw_pembelian_kredit.notaorder_id');
        $this->dt->where('pembelian_kredit.deleted_at', null);
        $request = \Config\Services::request();
        if ($request->getPost('brandd')) {
            $this->dt->like('master_unit.brand_name', $request->getPost('brandd'));
        }
        if ($request->getPost('tgl_awal') && $request->getPost('tgl_akhir')) {
            $this->dt->where('pembelian_kredit.tgl_nota BETWEEN "' . date('Y-m-d', strtotime($request->getPost('tgl_awal'))) . '" AND "' . date('Y-m-d', strtotime($request->getPost('tgl_akhir'))) . '"');
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
