<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Pemakaian_barang extends BaseController
{
    public function index()
    {
        $data = [
            'title'     => 'Pemakaian | Barang',
            'user'      => $this->pemakaianbarang->inputby()
        ];
        return view('data/vw_pemakaianbarang', $data);
    }
    public function datapemakaian()
    {
        $list = $this->pemakaianbarang->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        $user = user()->id;

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = Time::parse($r->tgl_pakai)->toLocalizedString('dd-MMM-YY');
            $row[] = $r->brand_name;
            $row[] = $r->no_perbaikan;
            $row[] = $r->nopol;
            $row[] = $r->keluhan_perbaikan;
            $row[] = $r->nama_barang;
            $row[] = $this->rupiah($r->qty);
            $row[] = $this->rupiah($r->harga);
            $row[] = $this->rupiah($r->total);
            $row[] = $r->username;
            if ($r->user_id == $user) {
                $row[] = '
                <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_pakai(' . "'" . $r->id_pakai . "'" . ')">Edit</a>
                <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_pakai(' . "'" . $r->id_pakai . "'" . ')">Hapus</a>
                ';
            } else {
                $row[] = '
                <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_pakai(' . "'" . $r->id_pakai . "'" . ')">Edit</a>
                <a class="btn btn-danger btn-xs disabled" href="javascript:void(0)" title="Hapus" onclick="hapus_pakai(' . "'" . $r->id_pakai . "'" . ')">Hapus</a>
                ';
            };

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->pemakaianbarang->count_all(),
            "recordsFiltered" => $this->pemakaianbarang->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {
        $this->_validate('save');
        $user = user()->id;
        $data = [
            'tgl_pakai'             => time::parse($this->request->getPost('tgl_pakai')),
            'no_perbaikan'          => $this->request->getPost('no_perbaikan'),
            'nopol_id'              => $this->request->getPost('nopol_id'),
            'keluhan_perbaikan'     => $this->request->getPost('keluhan_perbaikan'),
            'barang_id'             => $this->request->getPost('barang_id'),
            'qty'                   => $this->request->getPost('qty'),
            'harga'                 => $this->request->getPost('harga'),
            'total'                 => $this->request->getPost('total'),
            'user_id'               => $user
        ];
        if ($this->pemakaianbarang->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->pemakaianbarang->find($id));
    }
    public function update()
    {
        $this->_validate('update');

        $data = [
            'id_pakai'              => $this->request->getPost('id'),
            'tgl_pakai'             => time::parse($this->request->getPost('tgl_pakai')),
            'no_perbaikan'          => $this->request->getPost('no_perbaikan'),
            'nopol_id'              => $this->request->getPost('nopol_id'),
            'keluhan_perbaikan'     => $this->request->getPost('keluhan_perbaikan'),
            'barang_id'             => $this->request->getPost('barang_id'),
            'qty'                   => $this->request->getPost('qty'),
            'harga'                 => $this->request->getPost('harga'),
            'total'                 => $this->request->getPost('total'),
        ];

        if ($this->pemakaianbarang->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->pemakaianbarang->delete($id)) {
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

            if ($validation->hasError('tgl_pakai')) {
                $data['inputerror'][] = 'tgl_pakai';
                $data['error_string'][] = $validation->getError('tgl_pakai');
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
            'tgl_pakai' => [
                'rules' => $tgl,
                'errors' => [
                    'required' => 'tanggal harus diisi'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
