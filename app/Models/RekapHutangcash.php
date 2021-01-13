<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapHutangcash extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=1,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=1,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=1,vw_pembelian_cash.total ,0))) as jan,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=2,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=2,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=2,vw_pembelian_cash.total ,0))) as feb,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=3,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=3,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=3,vw_pembelian_cash.total ,0))) as mar,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=4,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=4,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=4,vw_pembelian_cash.total ,0))) as apr,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=5,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=5,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=5,vw_pembelian_cash.total ,0))) as mei,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=6,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=6,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=6,vw_pembelian_cash.total ,0))) as jun,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=7,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=7,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=7,vw_pembelian_cash.total ,0))) as jul,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=8,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=8,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=8,vw_pembelian_cash.total ,0))) as agt,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=9,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=9,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=9,vw_pembelian_cash.total ,0))) as sep,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=10,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=10,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=10,vw_pembelian_cash.total ,0))) as okt,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=11,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=11,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=11,vw_pembelian_cash.total ,0))) as nop,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id, SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=12,vw_pembelian_cash.total ,0))-SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=12,vw_pembelian_cash.total_bayar ,0)),SUM(if(MONTH(vw_pembelian_cash.tgl_reimburst)=12,vw_pembelian_cash.total ,0))) as dess
        FROM vw_pembelian_cash

        WHERE vw_pembelian_cash.tgl_reimburst BETWEEN ? AND ? AND vw_pembelian_cash.brand_name = ?";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
