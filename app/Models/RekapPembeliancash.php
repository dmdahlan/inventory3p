<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPembeliancash extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        vw_pembelian_cash.nama, 
        SUM(vw_pembelian_cash.total) AS pembelian,
        SUM(vw_pembelian_cash.total_bayar) AS pembayaran,
        if(vw_pembelian_cash.nota_order=vw_pembelian_cash.notaorder_id,SUM(vw_pembelian_cash.total)-SUM(vw_pembelian_cash.total_bayar),SUM(vw_pembelian_cash.total)) AS sisa
        FROM vw_pembelian_cash

        
        WHERE vw_pembelian_cash.tgl_nota BETWEEN ? AND ? AND vw_pembelian_cash.brand_name = ?

        GROUP BY vw_pembelian_cash.nama
        ORDER BY vw_pembelian_cash.nama ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
