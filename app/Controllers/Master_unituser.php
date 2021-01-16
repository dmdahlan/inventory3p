<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Master_unituser extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Data | Driver'
        ];
        return view('data/vw_masterunituser', $data);
    }
    public function dataunit()
    {
        $list = $this->masterunit->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nopol;
            $row[] = $r->kode_nopol;
            if ($r->exp_stnk == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->exp_stnk)->toLocalizedString('dd-MMM-yy');
            }
            if ($r->exp_stnk_tahun == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->exp_stnk_tahun)->toLocalizedString('dd-MMM-yy');
            }
            if ($r->exp_kir == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->exp_kir)->toLocalizedString('dd-MMM-yy');
            }

            $row[] = $r->brand_name;
            $row[] = $r->ket_nopol;
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->masterunit->count_all(),
            "recordsFiltered" => $this->masterunit->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
