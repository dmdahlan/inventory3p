<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Pembelian_bayarcash extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Pembayaran | Cash'
        ];
        return view('data/vw_bayarcash', $data);
    }
    public function datacash()
    {
        $list = $this->bayarcash->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        $total = 0;
        $hutang = 0;

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = Time::parse($r->tgl_nota)->toLocalizedString('dd-MMM-yy');
            $row[] = $r->nama;
            $row[] = $r->nota_order;
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
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="tambah" onclick="tambah_bayar(' . "'" . $r->id_cash . "'" . ')">Edit</a>
                    ';
            } else {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_bayar(' . "'" . $r->id_cash . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Edit" onclick="hapus_cash(' . "'" . $r->id_bayarcash . "'" . ')">hapus</a>
                    ';
            }
            $total += $r->total;
            $hutang += $r->total - $r->nominal1 - $r->nominal2;
            $data[] = $row;
        }
        $data[] = array(
            '', '', '', 'TOTAL', $this->rupiah($total), '', '', '', '', '', '', '', '', $this->rupiah($hutang), ''
        );
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->bayarcash->count_all(),
            "recordsFiltered" => $this->bayarcash->count_filtered(),
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
        $data = [
            'cash_id'       => $this->request->getVar('cash_id'),
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
        if ($this->bayarcash->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->bayarcash->getdata($id));
    }
    public function update()
    {
        if (!empty($_POST['tgl_bayar2']))
            $tgl_bayar2 = time::parse($this->request->getPost('tgl_bayar2'));
        else
            $tgl_bayar2 = null;
        $data = [
            'id_bayarcash'  => $this->request->getVar('id'),
            'cash_id'       => $this->request->getVar('cash_id'),
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
        if ($this->bayarcash->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->bayarcash->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
}
