<?php

namespace App\Controllers;

class Pembelian_kredit extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Pembelian | Kredit'
        ];
        return view('data/vw_pembeliankredit', $data);
    }
    public function datakredit()
    {
        $list = $this->pembeliankredit->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->tgl_nota;
            $row[] = $r->supplier;
            $row[] = $r->brand;
            $row[] = $r->nopol;
            $row[] = $r->nota_supp;
            $row[] = $r->nota_order;
            $row[] = $r->nama_barang;
            $row[] = $r->qty;
            $row[] = $r->harga;
            $row[] = $r->disc;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_kredit(' . "'" . $r->id_kredit . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_krefit(' . "'" . $r->id_kredit . "'" . ')">Hapus</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->pembeliankredit->count_all(),
            "recordsFiltered" => $this->pembeliankredit->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
