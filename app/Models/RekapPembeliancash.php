<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapPembeliancash extends Model
{
    public function rekaphutang($tgl_awal, $tgl_akhir, $brand)
    {
        $sql = "SELECT
        master_driver.nama,
        SUM(pembelian_cash.total) AS pembelian,
        SUM(pembayaran_cash.nominal1)+SUM(pembayaran_cash.nominal2) AS pembayaran,
        if(pembelian_cash.id_cash=pembayaran_cash.cash_id,SUM(pembelian_cash.total)-SUM(pembayaran_cash.nominal1)-SUM(pembayaran_cash.nominal2),SUM(pembelian_cash.total))AS sisa

        FROM pembelian_cash
        LEFT JOIN master_driver ON pembelian_cash.driver_id=master_driver.id_driver
        LEFT JOIN pembayaran_cash ON pembelian_cash.id_cash=pembayaran_cash.cash_id

        WHERE pembelian_cash.deleted_at is null && tgl_nota BETWEEN ? AND ?
        AND pembelian_cash.brand_id = ?

        GROUP BY master_driver.nama
        ORDER BY master_driver.nama ASC";

        $query = $this->db->query($sql, array($tgl_awal, $tgl_akhir, $brand));
        return $query;
    }
}
