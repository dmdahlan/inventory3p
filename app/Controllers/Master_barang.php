<?php

namespace App\Controllers;

class Master_barang extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Master | Barang'
        ];
        return view('data/vw_masterbarang', $data);
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
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_barang(' . "'" . $r->id_barang . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_barang(' . "'" . $r->id_barang . "'" . ')">Hapus</a>
                    ';
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
    public function save()
    {
        $this->_validate('save');
        $data = [
            'nama_barang'            => $this->request->getPost('nama_barang'),
            'kode_barang'            => $this->request->getPost('kode_barang'),
            'ket_barang'             => $this->request->getPost('ket_barang')
        ];

        if ($this->masterbarang->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->masterbarang->find($id));
    }
    public function update()
    {
        $this->_validate('update');

        $data = [
            'id_barang'              => $this->request->getPost('id'),
            'nama_barang'            => $this->request->getPost('nama_barang'),
            'kode_barang'            => $this->request->getPost('kode_barang'),
            'ket_barang'             => $this->request->getPost('ket_barang')
        ];

        if ($this->masterbarang->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->masterbarang->delete($id)) {
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

            if ($validation->hasError('nama_barang')) {
                $data['inputerror'][] = 'nama_barang';
                $data['error_string'][] = $validation->getError('nama_barang');
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
            $namabarang         = 'required|is_unique[master_barang.nama_barang]';
        } else {
            $namabarang         = 'required|is_unique[master_barang.nama_barang,id_barang,{id}]';
        }
        $rulesValidation = [
            'nama_barang' => [
                'rules' => $namabarang,
                'errors' => [
                    'required' => 'barang harus diisi',
                    'is_unique' => 'barang sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
