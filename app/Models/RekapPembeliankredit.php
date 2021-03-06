<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPembeliankredit extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        vw_pembelian_kredit.supplier,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=1,vw_pembelian_kredit.total,0)) AS jan,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=2,vw_pembelian_kredit.total,0)) AS feb,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=3,vw_pembelian_kredit.total,0)) AS mar,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=4,vw_pembelian_kredit.total,0)) AS apr,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=5,vw_pembelian_kredit.total,0)) AS mei,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=6,vw_pembelian_kredit.total,0)) AS jun,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=7,vw_pembelian_kredit.total,0)) AS jul,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=8,vw_pembelian_kredit.total,0)) AS agt,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=9,vw_pembelian_kredit.total,0)) AS sep,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=10,vw_pembelian_kredit.total,0)) AS okt,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=11,vw_pembelian_kredit.total,0)) AS nop,
        SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=12,vw_pembelian_kredit.total,0)) AS dess
        FROM vw_pembelian_kredit

        WHERE vw_pembelian_kredit.tgl_nota BETWEEN ? AND ? AND vw_pembelian_kredit.brand_name = ?

        GROUP BY vw_pembelian_kredit.supplier
        ORDER BY vw_pembelian_kredit.supplier ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
