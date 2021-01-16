<?php

namespace App\Controllers;

class Memo_all extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Memo'
        ];
        return view('data/vw_memoall', $data);
    }
    public function datamemo()
    {
        $list = $this->memoread->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->username;
            $row[] = $r->isi_memo;
            $row[] = $r->created_at;
            if ($r->ket_memo == 1) {
                $row[] = '
                    <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="selesai" (' . "'" . $r->id_memo . "'" . ')">Selesai</a>
                    ';
            } else {
                $row[] = '
                    <a class="btn btn-success btn-xs" href="javascript:void(0)" title="selesai" onclick="selesai(' . "'" . $r->id_memo . "'" . ')">Ok</a>
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_memo(' . "'" . $r->id_memo . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_memo(' . "'" . $r->id_memo . "'" . ')">Hapus</a>
                    ';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->memoread->count_all(),
            "recordsFiltered" => $this->memoread->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {
        $this->_validate('save');
        $data = [
            'from_id'             => user()->id,
            'to_id'               => $this->request->getPost('to_id'),
            'subject'             => $this->request->getPost('subject'),
            'isi_memo'            => $this->request->getPost('isi_memo'),
            'ket_memo'            => $this->request->getPost('ket_memo')
        ];

        if ($this->memoread->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->memoread->find($id));
    }
    public function selesai($id)
    {
        $this->memoread->memook($id);
        echo json_encode(array("status" => TRUE));
    }
    public function update()
    {
        $this->_validate('update');
        $data = [
            'id_memo'             => $this->request->getPost('id'),
            'from_id'             => user()->id,
            'to_id'               => $this->request->getPost('to_id'),
            'subject'             => $this->request->getPost('subject'),
            'isi_memo'            => $this->request->getPost('isi_memo'),
            'ket_memo'            => $this->request->getPost('ket_memo')
        ];

        if ($this->memoread->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->memoread->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function getnama()
    {
        echo json_encode($this->adminlogin->orderBy('email', 'ASC')->findAll());
    }
    public function _validate($method)
    {
        if (!$this->validate($this->_getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('isi_memo')) {
                $data['inputerror'][] = 'isi_memo';
                $data['error_string'][] = $validation->getError('isi_memo');
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
            $isi_memo         = 'required';
        } else {
            $isi_memo         = 'required';
        }
        $rulesValidation = [
            'isi_memo' => [
                'rules' => $isi_memo,
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
