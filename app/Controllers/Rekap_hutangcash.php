<?php

namespace App\Controllers;

class Rekap_hutangcash extends BaseController
{
    public function index()
    {
        $data = [
            'title'  => 'Rekap | Hutang Cash'
        ];
        return view('data/vw_rekaphutangcash', $data);
    }
    public function list()
    {
        $tgl_awal  = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $brand = $this->request->getPost('brand');

        $report = $this->rekaphutangcash->rekaphutang($tgl_awal, $tgl_akhir, $brand)->getResult();

        $data = array();
        foreach ($report as $r) {
            $row = array();
            $row[] = 'TOTAL HUTANG CASH';
            $row[] = $this->rupiah($r->jan);
            $row[] = $this->rupiah($r->feb);
            $row[] = $this->rupiah($r->mar);
            $row[] = $this->rupiah($r->apr);
            $row[] = $this->rupiah($r->mei);
            $row[] = $this->rupiah($r->jun);
            $row[] = $this->rupiah($r->jul);
            $row[] = $this->rupiah($r->agt);
            $row[] = $this->rupiah($r->sep);
            $row[] = $this->rupiah($r->okt);
            $row[] = $this->rupiah($r->nop);
            $row[] = $this->rupiah($r->dess);

            $total_bulan = $r->jan + $r->feb + $r->mar + $r->apr + $r->mei + $r->jun + $r->jul + $r->agt + $r->sep + $r->okt + $r->nop + $r->dess;
            $row[] = $this->rupiah($total_bulan);

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
