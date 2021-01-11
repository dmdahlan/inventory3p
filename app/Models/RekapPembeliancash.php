<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPembeliancash extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        vw_pembelian_cash.nama,
        sum(if(vw_pembelian_cash.nota_order=vw_pembelian_cash.nota_order,vw_pembelian_cash.total,0)) AS pembelian,
        sum(if(vw_pembelian_cash.nota_order=vw_pembelian_cash.nota_order,vw_pembelian_cash.total_bayar,0)) AS pembayaran,
        0 as sisa

        FROM vw_pembelian_cash
        
        WHERE vw_pembelian_cash.tgl_nota BETWEEN ? AND ? AND vw_pembelian_cash.brand_name = ?

        GROUP BY vw_pembelian_cash.nama
        ORDER BY vw_pembelian_cash.nama ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
