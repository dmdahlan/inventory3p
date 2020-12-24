<?php

namespace App\Controllers;

class Rekap_pembeliankredit extends BaseController
{
    public function index()
    {
        $data = [
            'title'  => 'Rekap | Hutang Kredit'
        ];
        return view('data/vw_rekaphutangkredit', $data);
    }
    public function list()
    {
        $tgl_awal  = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $brand = $this->request->getPost('brand');

        $report = $this->rekapkredit->rekaphutang($tgl_awal, $tgl_akhir, $brand)->getResult();

        $data = array();
        $no = @$_POST['start'];
        $temp_pembelian = 0;
        $temp_pembayaran = 0;
        $temp_sisa = 0;

        $temp_bln_total = 0;

        foreach ($report as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->supplier;
            $row[] = $this->rupiah($r->pembelian);
            $row[] = $this->rupiah($r->pembayaran);
            $row[] = $this->rupiah($r->sisa);

            $temp_pembelian += $r->pembelian;
            $temp_pembayaran += $r->pembayaran;
            $temp_sisa += $r->sisa;

            //add html for action
            $data[] = $row;
        }
        $data[] = array(
            '',
            'Total',
            $this->rupiah($temp_pembelian),
            $this->rupiah($temp_pembayaran),
            $this->rupiah($temp_sisa),
        );

        $output = array(
            "draw" => @$_POST['draw'],
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
