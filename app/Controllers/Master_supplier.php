<?php

namespace App\Controllers;

class Master_supplier extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Master | Suppiler'
        ];
        return view('data/vw_mastersupplier', $data);
    }
    public function datasupplier()
    {
        $list = $this->mastersupplier->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->supplier;
            $row[] = $r->alamat_supplier;
            $row[] = $r->telp_supplier;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_supplier(' . "'" . $r->id_supplier . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_supplier(' . "'" . $r->id_supplier . "'" . ')">Hapus</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->mastersupplier->count_all(),
            "recordsFiltered" => $this->mastersupplier->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {
        $this->_validate('save');
        $data = [
            'supplier'            => $this->request->getPost('supplier'),
            'alamat_supplier'     => $this->request->getPost('alamat_suplier'),
            'telp_supplier'       => $this->request->getPost('telp_supplier'),
            'ppn'                 => $this->request->getPost('ppn')
        ];

        if ($this->mastersupplier->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->mastersupplier->find($id));
    }
    public function update()
    {
        $this->_validate('update');
        $data = [
            'id_supplier'         => $this->request->getPost('id'),
            'supplier'            => $this->request->getPost('supplier'),
            'alamat_supplier'     => $this->request->getPost('alamat_suplier'),
            'telp_supplier'       => $this->request->getPost('telp_supplier'),
            'ppn'                 => $this->request->getPost('ppn')
        ];

        if ($this->mastersupplier->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->mastersupplier->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function getsupplier()
    {
        echo json_encode($this->mastersupplier->orderBy('supplier', 'ASC')->findAll());
    }
    public function _validate($method)
    {
        if (!$this->validate($this->_getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('supplier')) {
                $data['inputerror'][] = 'supplier';
                $data['error_string'][] = $validation->getError('supplier');
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
            $supplier         = 'required|is_unique[master_supplier.supplier]';
        } else {
            $supplier         = 'required|is_unique[master_supplier.supplier,id_supplier,{id}]';
        }
        $rulesValidation = [
            'supplier' => [
                'rules' => $supplier,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
