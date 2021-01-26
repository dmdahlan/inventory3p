<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Exp_kir extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Expired | Kir'
        ];
        return view('data/vw_expkir', $data);
    }
    public function datakir()
    {
        $kir = $this->masterunit->expkir();
        $data = array();
        $no = @$_POST['start'];

        foreach ($kir as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nopol;
            if ($r->exp_kir == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->exp_kir)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $r->brand_name;
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
