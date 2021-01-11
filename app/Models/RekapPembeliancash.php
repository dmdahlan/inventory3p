<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPembeliancash extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        master_driver.nama,
        sum(if(pembelian_cash.nota_order=pembelian_cash.nota_order,pembelian_cash.total,0)) AS pembelian,
        vw_pembelian_cash.total_bayar as pembayaran,
        0 as sisa

        FROM pembelian_cash

        LEFT JOIN master_driver ON pembelian_cash.driver_id=master_driver.id_driver
        LEFT JOIN master_unit ON pembelian_cash.nopol_id=master_unit.id_nopol
        LEFT JOIN vw_pembelian_cash on pembelian_cash.id_cash=vw_pembelian_cash.cash_id
        
        WHERE pembelian_cash.deleted_at is null && pembelian_cash.tgl_nota BETWEEN ? AND ? AND master_unit.brand_name = ?

        GROUP BY master_driver.nama
        ORDER BY master_driver.nama ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
