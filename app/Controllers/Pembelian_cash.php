<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Pembelian_cash extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Pembelian | Cash'
        ];
        return view('data/vw_pembeliancash', $data);
    }
    public function datacash()
    {
        $list = $this->pembeliancash->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        $qty = 0;
        $harga = 0;
        $total = 0;
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = Time::parse($r->created_at)->toLocalizedString('dd-MMM-yy');
            $row[] = Time::parse($r->tgl_nota)->toLocalizedString('dd-MMM-yy');
            $row[] = $r->nama_toko;
            $row[] = $r->brand_name;
            $row[] = $r->nopol;
            $row[] = $r->nama;
            $row[] = $r->nota_order;
            $row[] = $r->nama_barang;
            $row[] = $r->qty;
            $row[] = $this->rupiah($r->harga);
            $row[] = $this->rupiah($r->total);
            if ($r->notaorder_id != null) {
                $row[] = '';
            } else {
                $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_cash(' . "'" . $r->id_cash . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_cash(' . "'" . $r->id_cash . "'" . ')">Hapus</a>
                    ';
            }
            $qty += $r->qty;
            $harga += $r->harga;
            $total += $r->total;
            $data[] = $row;
        }
        $data[] = array(
            '', '', '', '', '', '', '', '', 'TOTAL', $this->rupiah($qty), $this->rupiah($harga), $this->rupiah($total), ''
        );
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->pembeliancash->count_all(),
            "recordsFiltered" => $this->pembeliancash->count_filtered(),
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
            'nama_toko'             => $this->request->getPost('nama_toko'),
            'nopol_id'              => $this->request->getPost('nopol_id'),
            'driver_id'             => $this->request->getPost('driver_id'),
            'nota_order'            => $this->request->getPost('nota_order'),
            'barang_id'             => $this->request->getPost('barang_id'),
            'qty'                   => $this->request->getPost('qty'),
            'harga'                 => $this->request->getPost('harga'),
            'total'                 => $this->request->getPost('total'),
        ];
        if ($this->pembeliancash->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->pembeliancash->find($id));
    }
    public function update()
    {
        $this->_validate('update');

        $data = [
            'id_cash'             => $this->request->getPost('id'),
            'tgl_nota'              => time::parse($this->request->getPost('tgl_nota')),
            'nama_toko'             => $this->request->getPost('nama_toko'),
            'nopol_id'              => $this->request->getPost('nopol_id'),
            'driver_id'             => $this->request->getPost('driver_id'),
            'nota_order'            => $this->request->getPost('nota_order'),
            'barang_id'             => $this->request->getPost('barang_id'),
            'qty'                   => $this->request->getPost('qty'),
            'harga'                 => $this->request->getPost('harga'),
            'total'                 => $this->request->getPost('total'),
        ];

        if ($this->pembeliancash->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->pembeliancash->delete($id)) {
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
