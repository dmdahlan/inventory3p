<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPemakaian extends Model
{
    protected $table = '';
    protected $id = 'id_pakai';
    protected $primaryKey = 'id_pakai';

    public function getdatapakai()
    {
        return $this->db->table('pemakaian_barang')
            ->join('users', 'users.id=pemakaian_barang.user_id', 'left')
            ->join('master_barang', 'master_barang.id_barang=pemakaian_barang.barang_id', 'left')
            ->join('master_unit', 'master_unit.id_nopol=pemakaian_barang.nopol_id', 'left')
            ->orderBy('nopol')
            ->groupBy('nama_barang,nopol')
            ->get()->getResultArray();
    }
    public function rekaphutang($tgl_awal, $tgl_akhir, $nopol)
    {
        $sql = "SELECT
        master_unit.nopol,
        master_barang.nama_barang,
        SUM(if(pemakaian_barang.barang_id=pemakaian_barang.barang_id,pemakaian_barang.qty,0)) AS qty,
        pemakaian_barang.harga,
        SUM(if(pemakaian_barang.barang_id=pemakaian_barang.barang_id,pemakaian_barang.qty,0))*pemakaian_barang.harga AS total
        
        FROM pemakaian_barang
        LEFT JOIN master_unit ON pemakaian_barang.nopol_id=master_unit.id_nopol
        LEFT JOIN master_barang ON pemakaian_barang.barang_id=master_barang.id_barang

        WHERE pemakaian_barang.deleted_at is null && tgl_pakai BETWEEN ? AND ?
        AND pemakaian_barang.nopol_id = ?

        GROUP BY master_unit.nopol,pemakaian_barang.barang_id
        ORDER BY master_unit.nopol ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $nopol));
        return $query;
    }
}
