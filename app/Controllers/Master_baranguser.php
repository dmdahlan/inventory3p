<?php

namespace App\Controllers;

class Master_baranguser extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Master | Barang'
        ];
        return view('data/vw_masterbaranguser', $data);
    }
    public function databarang()
    {
        $list = $this->masterbarang->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nama_barang;
            $row[] = $r->kode_barang;
            $row[] = $r->ket_barang;
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->masterbarang->count_all(),
            "recordsFiltered" => $this->masterbarang->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
