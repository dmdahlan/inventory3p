<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapHutangkredit extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        vw_pembelian_kredit.supplier,	
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=1,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=1,vw_pembelian_kredit.total,0))) AS jan,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=2,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=2,vw_pembelian_kredit.total,0))) AS feb,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=3,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=3,vw_pembelian_kredit.total,0))) AS mar,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=4,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=4,vw_pembelian_kredit.total,0))) AS apr,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=5,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=5,vw_pembelian_kredit.total,0))) AS mei,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=6,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=6,vw_pembelian_kredit.total,0))) AS jun,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=7,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=7,vw_pembelian_kredit.total,0))) AS jul,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=8,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=8,vw_pembelian_kredit.total,0))) AS agt,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=9,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=9,vw_pembelian_kredit.total,0))) AS sep,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=10,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=10,vw_pembelian_kredit.total,0))) AS okt,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=11,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=11,vw_pembelian_kredit.total,0))) AS nop,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=12,vw_pembelian_kredit.total - vw_pembelian_kredit.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_kredit.tgl_nota)=12,vw_pembelian_kredit.total,0))) AS dess
        FROM vw_pembelian_kredit

        WHERE vw_pembelian_kredit.tgl_nota BETWEEN ? AND ? AND vw_pembelian_kredit.brand_name = ?

        GROUP BY vw_pembelian_kredit.supplier
        ORDER BY vw_pembelian_kredit.supplier ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
