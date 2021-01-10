<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPembeliankredit extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        master_supplier.supplier,
        SUM(pembelian_kredit.total) AS pembelian,
        vw_pembelian_kredit.nominal1+vw_pembelian_kredit.nominal2 AS pembayaran,
        if(pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id,SUM(pembelian_kredit.total)-vw_pembelian_kredit.nominal1-vw_pembelian_kredit.nominal2,sum(pembelian_kredit.total))AS sisa
        FROM pembelian_kredit
        LEFT JOIN master_supplier ON pembelian_kredit.supplier_id=master_supplier.id_supplier
        LEFT JOIN vw_pembelian_kredit ON pembelian_kredit.nota_order=vw_pembelian_kredit.notaorder_id

        WHERE pembelian_kredit.deleted_at is null && pembelian_kredit.tgl_nota BETWEEN ? AND ?
        AND pembelian_kredit.brand_id = ?

        GROUP BY master_supplier.supplier
        ORDER BY master_supplier.supplier ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
