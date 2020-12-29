<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Master_unit extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Master | Kendaraan'
        ];
        return view('data/vw_masterunit', $data);
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
                $row[] = Time::parse($r->exp_stnk)->toLocalizedString('dd-MMM-YY');
            }
            if ($r->exp_kir == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->exp_kir)->toLocalizedString('dd-MMM-YY');
            }
            $row[] = $r->brand_name;
            $row[] = $r->ket_nopol;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_nopol(' . "'" . $r->id_nopol . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_nopol(' . "'" . $r->id_nopol . "'" . ')">Hapus</a>
                    ';
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
    public function save()
    {
        $this->_validate('save');
        if (!empty($_POST['exp_stnk'])) {
            $exp_stnk = time::parse($this->request->getPost('exp_stnk'));
        } else {
            $exp_stnk = null;
        }
        if (!empty($_POST['exp_kir'])) {
            $exp_kir = time::parse($this->request->getPost('exp_kir'));
        } else {
            $exp_kir = null;
        }
        $data = [
            'nopol'            => $this->request->getPost('nopol'),
            'kode_nopol'       => $this->request->getPost('kode_nopol'),
            'exp_stnk'         => $exp_stnk,
            'exp_kir'          => $exp_kir,
            'brand_name'       => $this->request->getPost('brand_name'),
            'ket_nopol'        => $this->request->getPost('ket_nopol')
        ];

        if ($this->masterunit->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->masterunit->find($id));
    }
    public function update()
    {
        $this->_validate('update');
        if (!empty($_POST['exp_stnk'])) {
            $exp_stnk = time::parse($this->request->getPost('exp_stnk'));
        } else {
            $exp_stnk = null;
        }
        if (!empty($_POST['exp_kir'])) {
            $exp_kir = time::parse($this->request->getPost('exp_kir'));
        } else {
            $exp_kir = null;
        }
        $data = [
            'id_nopol'         => $this->request->getPost('id'),
            'nopol'            => $this->request->getPost('nopol'),
            'kode_nopol'       => $this->request->getPost('kode_nopol'),
            'exp_stnk'         => $exp_stnk,
            'exp_kir'          => $exp_kir,
            'brand_name'       => $this->request->getPost('brand_name'),
            'ket_nopol'        => $this->request->getPost('ket_nopol')
        ];

        if ($this->masterunit->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->masterunit->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function getnopol()
    {
        echo json_encode($this->masterunit->orderBy('nopol', 'ASC')->findAll());
    }
    public function _validate($method)
    {
        if (!$this->validate($this->_getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('nopol')) {
                $data['inputerror'][] = 'nopol';
                $data['error_string'][] = $validation->getError('nopol');
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
            $nopol         = 'required|is_unique[master_unit.nopol]';
        } else {
            $nopol         = 'required|is_unique[master_unit.nopol,id_nopol,{id}]';
        }
        $rulesValidation = [
            'nopol' => [
                'rules' => $nopol,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
    public function exp_stnk()
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
    public function exp_kir()
    {
        $data = [
            'title'         => 'Expired | Kir'
        ];
        return view('data/vw_expkir', $data);
    }
    public function datakir()
    {

        $stnk = $this->masterunit->expkir()->getResult();
        $data = array();
        $no = @$_POST['start'];

        foreach ($stnk as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nopol;
            if ($r->exp_kir == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->exp_kir)->toLocalizedString('dd-MMM-yy');
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
