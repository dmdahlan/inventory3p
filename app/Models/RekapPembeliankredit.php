<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPembeliankredit extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        vw_pembelian_kredit.supplier, 
        SUM(vw_pembelian_kredit.total) AS pembelian,
        SUM(vw_pembelian_kredit.total_bayar) AS pembayaran,
        if(vw_pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(vw_pembelian_kredit.total)-SUM(vw_pembelian_kredit.total_bayar),SUM(vw_pembelian_kredit.total)) AS sisa
        FROM vw_pembelian_kredit

        WHERE vw_pembelian_kredit.tgl_nota BETWEEN ? AND ? AND vw_pembelian_kredit.brand_name = ?

        GROUP BY vw_pembelian_kredit.supplier
        ORDER BY vw_pembelian_kredit.supplier ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
