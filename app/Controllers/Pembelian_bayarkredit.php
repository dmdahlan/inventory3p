<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Pembelian_bayarkredit extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Pembayaran | Kredit'
        ];
        return view('data/vw_bayarkredit', $data);
    }
    public function datakredit()
    {
        $list = $this->bayarkredit->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        $total = 0;
        $hutang = 0;

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = Time::parse($r->tgl_nota)->toLocalizedString('dd-MMM-yy');
            $row[] = $r->supplier;
            $row[] = $r->brand_name;
            if ($r->tgl_bayar1 == '') {
                $row[] =
                    '<a class="text-blue" href="javascript:void(0)" onclick="tambah_bayar(' . "'" . $r->id_kredit . "'" . ')">' . $r->nota_order;
            } else {
                $row[] =
                    '<a class="text-blue" href="javascript:void(0)" onclick="edit_bayar(' . "'" . $r->id_kredit . "'" . ')">' . $r->nota_order;
            }
            $row[] = $this->rupiah($r->total);
            if ($r->tgl_bayar1 == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_bayar1)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $r->bank1;
            $row[] = $r->via1;
            $row[] = $this->rupiah($r->nominal1);
            if ($r->tgl_bayar2 == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_bayar2)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $r->bank2;
            $row[] = $r->via2;
            $row[] = $this->rupiah($r->nominal2);
            $row[] = $this->rupiah($r->total - $r->nominal1 - $r->nominal2);
            if ($r->tgl_bayar1 == '') {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="tambah" onclick="tambah_bayar(' . "'" . $r->id_kredit . "'" . ')">Edit</a>
                    ';
            } else {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_bayar(' . "'" . $r->id_kredit . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Edit" onclick="hapus_kredit(' . "'" . $r->id_bayarkredit . "'" . ')">hapus</a>
                    ';
            }
            $total += $r->total;
            $hutang += $r->total - $r->nominal1 - $r->nominal2;
            $data[] = $row;
        }
        $data[] = array(
            '', '', '', '', 'TOTAL', $this->rupiah($total), '', '', '', '', '', '', '', '', $this->rupiah($hutang), ''
        );
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->bayarkredit->count_all(),
            "recordsFiltered" => $this->bayarkredit->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {
        if (!empty($_POST['tgl_bayar2']))
            $tgl_bayar2 = time::parse($this->request->getPost('tgl_bayar2'));
        else
            $tgl_bayar2 = null;
        $this->_validate('save');
        $data = [
            'kredit_id'       => $this->request->getVar('kredit_id'),
            'notaorder_id'    => $this->request->getVar('notaorder_id'),
            'tgl_bayar1'      => time::parse($this->request->getVar('tgl_bayar1')),
            'bank1'           => $this->request->getVar('bank1'),
            'via1'            => $this->request->getVar('via1'),
            'nominal1'        => $this->request->getVar('nominal1'),
            'tgl_bayar2'      => $tgl_bayar2,
            'bank2'           => $this->request->getVar('bank2'),
            'via2'            => $this->request->getVar('via2'),
            'nominal2'        => $this->request->getVar('nominal2'),
            'sisa_hutang'     => $this->request->getVar('sisa_hutang')
        ];
        if ($this->bayarkredit->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->bayarkredit->getdata($id));
    }
    public function update()
    {
        if (!empty($_POST['tgl_bayar2']))
            $tgl_bayar2 = time::parse($this->request->getPost('tgl_bayar2'));
        else
            $tgl_bayar2 = null;
        $this->_validate('update');
        $data = [
            'id_bayarkredit'  => $this->request->getVar('id'),
            'kredit_id'       => $this->request->getVar('kredit_id'),
            'notaorder_id'    => $this->request->getVar('notaorder_id'),
            'tgl_bayar1'      => time::parse($this->request->getVar('tgl_bayar1')),
            'bank1'           => $this->request->getVar('bank1'),
            'via1'            => $this->request->getVar('via1'),
            'nominal1'        => $this->request->getVar('nominal1'),
            'tgl_bayar2'      => $tgl_bayar2,
            'bank2'           => $this->request->getVar('bank2'),
            'via2'            => $this->request->getVar('via2'),
            'nominal2'        => $this->request->getVar('nominal2'),
            'sisa_hutang'     => $this->request->getVar('sisa_hutang')
        ];
        if ($this->bayarkredit->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->bayarkredit->delete($id)) {
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

            if ($validation->hasError('kredit_id')) {
                $data['inputerror'][] = 'kredit_id';
                $data['error_string'][] = $validation->getError('kredit_id');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('notaorder_id')) {
                $data['inputerror'][] = 'notaorder_id';
                $data['error_string'][] = $validation->getError('notaorder_id');
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
            $kredit_id          = 'required|is_unique[pembayaran_kredit.kredit_id]';
            $notaorder_id       = 'required|is_unique[pembayaran_kredit.notaorder_id]';
        } else {
            $kredit_id          = 'required|is_unique[pembayaran_kredit.kredit_id,id_bayarkredit,{id}]';
            $notaorder_id       = 'required|is_unique[pembayaran_kredit.notaorder_id,id_bayarkredit,{id}]';
        }
        $rulesValidation = [
            'kredit_id' => [
                'rules' => $kredit_id,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'notaorder_id' => [
                'rules' => $notaorder_id,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
