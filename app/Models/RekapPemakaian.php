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
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        master_unit.nopol,
        SUM(if(month(pemakaian_barang.tgl_pakai)=1,pemakaian_barang.total,0)) AS jan,
        SUM(if(month(pemakaian_barang.tgl_pakai)=2,pemakaian_barang.total,0)) AS feb,
        SUM(if(month(pemakaian_barang.tgl_pakai)=3,pemakaian_barang.total,0)) AS mar,
        SUM(if(month(pemakaian_barang.tgl_pakai)=4,pemakaian_barang.total,0)) AS apr,
        SUM(if(month(pemakaian_barang.tgl_pakai)=5,pemakaian_barang.total,0)) AS mei,
        SUM(if(month(pemakaian_barang.tgl_pakai)=6,pemakaian_barang.total,0)) AS jun,
        SUM(if(month(pemakaian_barang.tgl_pakai)=7,pemakaian_barang.total,0)) AS jul,
        SUM(if(month(pemakaian_barang.tgl_pakai)=8,pemakaian_barang.total,0)) AS agt,
        SUM(if(month(pemakaian_barang.tgl_pakai)=9,pemakaian_barang.total,0)) AS sep,
        SUM(if(month(pemakaian_barang.tgl_pakai)=10,pemakaian_barang.total,0)) AS okt,
        SUM(if(month(pemakaian_barang.tgl_pakai)=11,pemakaian_barang.total,0)) AS nop,
        SUM(if(month(pemakaian_barang.tgl_pakai)=12,pemakaian_barang.total,0)) AS dess
        FROM pemakaian_barang

        LEFT JOIN master_unit ON pemakaian_barang.nopol_id=master_unit.id_nopol

        WHERE pemakaian_barang.deleted_at is null && tgl_pakai BETWEEN ? AND ?
        AND master_unit.brand_name = ?

        GROUP BY  master_unit.nopol
        ORDER BY master_unit.nopol ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
