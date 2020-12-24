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
        SUM(pembayaran_kredit.nominal1+pembayaran_kredit.nominal2)AS pembayaran,
        if(pembelian_kredit.id_kredit=pembayaran_kredit.kredit_id,SUM(pembelian_kredit.total)-sum(pembayaran_kredit.nominal1)-(pembayaran_kredit.nominal2),SUM(pembelian_kredit.total))AS sisa
        FROM pembelian_kredit
        LEFT JOIN master_supplier ON pembelian_kredit.supplier_id=master_supplier.id_supplier
        LEFT JOIN pembayaran_kredit ON pembelian_kredit.id_kredit=pembayaran_kredit.kredit_id

        WHERE pembelian_kredit.deleted_at is null && tgl_nota BETWEEN ? AND ?
        AND pembelian_kredit.brand_id = ?

        GROUP BY master_supplier.supplier
        ORDER BY master_supplier.supplier ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
