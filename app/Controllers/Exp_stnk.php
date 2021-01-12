<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Exp_stnk extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Expired | STNK'
        ];
        return view('data/vw_expstnk', $data);
    }
    public function datastnk()
    {
        $stnk = $this->masterunit->expstnk()->getResult();
        $data = array();
        $no = @$_POST['start'];

        foreach ($stnk as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nopol;
            if ($r->exp_stnk == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->exp_stnk)->toLocalizedString('dd-MMM-YY');
            }
            if ($r->exp_stnk_tahun == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->exp_stnk_tahun)->toLocalizedString('dd-MMM-YY');
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
