<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

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
            $row[] = Time::parse($r->tgl_nota)->toLocalizedString('dd-MMM-YY');
            $row[] = $r->supplier;
            $row[] = $r->brand;
            $row[] = $r->nopol;
            $row[] = $r->nota_supp;
            $row[] = $r->nota_order;
            $row[] = $r->nama_barang;
            $row[] = $r->qty;
            $row[] = $this->rupiah($r->harga);
            $row[] = $this->rupiah($r->disc);
            $row[] = $this->rupiah($r->pembelianppn);
            $row[] = $this->rupiah($r->total);
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_kredit(' . "'" . $r->id_kredit . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_kredit(' . "'" . $r->id_kredit . "'" . ')">Hapus</a>
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
    public function save()
    {
        $this->_validate('save');
        $data = [
            'tgl_nota'              => time::parse($this->request->getPost('tgl_nota')),
            'supplier_id'           => $this->request->getPost('supplier_id'),
            'brand_id'              => $this->request->getPost('brand_id'),
            'nopol_id'              => $this->request->getPost('nopol_id'),
            'nota_supp'             => $this->request->getPost('nota_supp'),
            'nota_order'            => $this->request->getPost('nota_order'),
            'barang_id'             => $this->request->getPost('barang_id'),
            'qty'                   => $this->request->getPost('qty'),
            'harga'                 => $this->request->getPost('harga'),
            'disc'                  => $this->request->getPost('disc'),
            'pembelianppn'          => $this->request->getPost('ppn'),
            'total'                 => $this->request->getPost('total'),
        ];
        if ($this->pembeliankredit->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->pembeliankredit->find($id));
    }
    public function update()
    {
        $this->_validate('update');

        $data = [
            'id_kredit'             => $this->request->getPost('id'),
            'tgl_nota'              => time::parse($this->request->getPost('tgl_nota')),
            'supplier_id'           => $this->request->getPost('supplier_id'),
            'brand_id'              => $this->request->getPost('brand_id'),
            'nopol_id'              => $this->request->getPost('nopol_id'),
            'nota_supp'             => $this->request->getPost('nota_supp'),
            'nota_order'            => $this->request->getPost('nota_order'),
            'barang_id'             => $this->request->getPost('barang_id'),
            'qty'                   => $this->request->getPost('qty'),
            'harga'                 => $this->request->getPost('harga'),
            'disc'                  => $this->request->getPost('disc'),
            'pembelianppn'          => $this->request->getPost('ppn'),
            'total'                 => $this->request->getPost('total'),
        ];

        if ($this->pembeliankredit->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->pembeliankredit->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function _validate($method)
    {
        if (!$this->validate($this->_getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('tgl_nota')) {
                $data['inputerror'][] = 'tgl_nota';
                $data['error_string'][] = $validation->getError('tgl_nota');
                $data['status'] = FALSE;
            }

            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
    }
    public function _getRulesValidation($method = null)
    {
        if ($method == 'save') {
            $tgl                 = 'required';
            // $shipment            = 'is_unique[deliv_order.shipment]';
        } else {
            $tgl                 = 'required';
            // $shipment            = 'is_unique[deliv_order.shipment,idm_deliv,{id}]';
        }
        $rulesValidation = [
            'tgl_nota' => [
                'rules' => $tgl,
                'errors' => [
                    'required' => 'tanggal harus diisi'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
