<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPembeliancash extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=1,vw_pembelian_cash.total,0)) AS jan,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=2,vw_pembelian_cash.total,0)) AS feb,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=3,vw_pembelian_cash.total,0)) AS mar,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=4,vw_pembelian_cash.total,0)) AS apr,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=5,vw_pembelian_cash.total,0)) AS mei,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=6,vw_pembelian_cash.total,0)) AS jun,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=7,vw_pembelian_cash.total,0)) AS jul,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=8,vw_pembelian_cash.total,0)) AS agt,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=9,vw_pembelian_cash.total,0)) AS sep,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=10,vw_pembelian_cash.total,0)) AS okt,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=11,vw_pembelian_cash.total,0)) AS nop,
        SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=12,vw_pembelian_cash.total,0)) AS dess
        FROM vw_pembelian_cash

        
        WHERE vw_pembelian_cash.tgl_reimburst BETWEEN ? AND ? AND vw_pembelian_cash.brand_name = ?";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
