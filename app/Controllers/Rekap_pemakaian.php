<?php

namespace App\Controllers;

class Rekap_pemakaian extends BaseController
{
    public function index()
    {
        $data = [
            'title'   => 'Rekap Pemakaian',
            'rekap'   => $this->rekappakai->getdatapakai()
        ];
        return view('data/vw_rekappemakaian', $data);
    }
    public function list()
    {
        $tgl_awal  = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $nopol = $this->request->getPost('nopoll');

        $report = $this->rekappakai->rekaphutang($tgl_awal, $tgl_akhir, $nopol)->getResult();

        $data = array();
        $no = @$_POST['start'];
        $temp_qty = 0;
        $temp_harga = 0;
        $temp_total = 0;

        foreach ($report as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nopol;
            $row[] = $r->nama_barang;
            $row[] = $this->rupiah($r->qty);
            $row[] = $this->rupiah($r->harga);
            $row[] = $this->rupiah($r->total);

            $temp_qty += $r->qty;
            $temp_harga += $r->harga;
            $temp_total += $r->total;

            //add html for action
            $data[] = $row;
        }
        $data[] = array(
            '',
            'Total',
            $this->rupiah($temp_qty),
            $this->rupiah($temp_harga),
            $this->rupiah($temp_total),
        );

        $output = array(
            "draw" => @$_POST['draw'],
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
