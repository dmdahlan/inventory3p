<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Pembayaran_stnk extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Pembayaran | STNK & KIR'
        ];
        return view('data/vw_pembayaranstnk', $data);
    }
    public function databayar()
    {
        $list = $this->pembayaranstnk->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        $total = 0;
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nopol;
            $row[] = $r->brand_name;
            $row[] = $r->stnk_kir;
            if ($r->expired == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->expired)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = Time::parse($r->tgl_bayar)->toLocalizedString('dd-MMM-yy');
            $row[] = $this->rupiah($r->nominal_bayar);
            $row[] = $r->via;
            $row[] = $r->bank;
            $row[] = $this->rupiah($r->nominal_pengurusan);
            $row[] = $this->rupiah($r->nominal_simulasi);
            $jasa = $r->nominal_pengurusan - $r->nominal_simulasi;
            $row[] = $this->rupiah($jasa);
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_bayar(' . "'" . $r->id_bayarstnk . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_bayar(' . "'" . $r->id_bayarstnk . "'" . ')">Hapus</a>
                    ';
            $total += $r->nominal_bayar;
            $data[] = $row;
        }
        $data[] = array(
            '', '', '', '', '', 'TOTAL', $this->rupiah($total), '', '', '', '', '', ''
        );
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->pembayaranstnk->count_all(),
            "recordsFiltered" => $this->pembayaranstnk->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {
        $this->_validate('save');
        if (!empty($_POST['tgl_bayar'])) {
            $tgl_bayar = time::parse($this->request->getPost('tgl_bayar'));
        } else {
            $tgl_bayar = null;
        }
        if (!empty($_POST['expired'])) {
            $expired = time::parse($this->request->getPost('expired'));
        } else {
            $expired = null;
        }
        $data = [
            'tgl_bayar'             => $tgl_bayar,
            'nopol_id'              => $this->request->getPost('nopol_id'),
            'stnk_kir'              => $this->request->getPost('stnk_kir'),
            'expired'               => $expired,
            'nominal_bayar'         => $this->request->getPost('nominal'),
            'via'                   => $this->request->getPost('via'),
            'bank'                  => $this->request->getPost('bank'),
            'nominal_pengurusan'    => $this->request->getPost('nominal_pengurusan'),
            'nominal_simulasi'      => $this->request->getPost('nominal_simulasi'),
        ];

        if ($this->pembayaranstnk->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->pembayaranstnk->find($id));
    }
    public function update()
    {
        $this->_validate('update');
        if (!empty($_POST['tgl_bayar'])) {
            $tgl_bayar = time::parse($this->request->getPost('tgl_bayar'));
        } else {
            $tgl_bayar = null;
        }
        if (!empty($_POST['expired'])) {
            $expired = time::parse($this->request->getPost('expired'));
        } else {
            $expired = null;
        }
        $data = [
            'id_bayarstnk'          => $this->request->getPost('id'),
            'tgl_bayar'             => $tgl_bayar,
            'nopol_id'              => $this->request->getPost('nopol_id'),
            'stnk_kir'              => $this->request->getPost('stnk_kir'),
            'expired'               => $expired,
            'nominal_bayar'         => $this->request->getPost('nominal'),
            'via'                   => $this->request->getPost('via'),
            'bank'                  => $this->request->getPost('bank'),
            'nominal_pengurusan'    => $this->request->getPost('nominal_pengurusan'),
            'nominal_simulasi'      => $this->request->getPost('nominal_simulasi'),
        ];

        if ($this->pembayaranstnk->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->pembayaranstnk->delete($id)) {
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

            if ($validation->hasError('tgl_bayar')) {
                $data['inputerror'][] = 'tgl_bayar';
                $data['error_string'][] = $validation->getError('tgl_bayar');
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
            $tgl_bayar         = 'required';
        } else {
            $tgl_bayar         = 'required';
        }
        $rulesValidation = [
            'tgl_bayar' => [
                'rules' => $tgl_bayar,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
