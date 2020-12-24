<?php

namespace App\Controllers;

class Print_pokredit extends BaseController
{
    public function index()
    {
        if (empty($this->request->getVar('keyword'))) {
            $keyword = $this->printpokredit->max();
        } else {
            $keyword = $this->request->getVar('keyword');
        }
        $cari = $this->request->getVar('keyword');
        $data = [
            'title'         => 'Print | PO Kredit',
            'po'            => $this->printpokredit->inv($cari),
            'ket'           => $this->printpokredit->ket($keyword)
        ];
        return view('print/vw_printpokredit', $data);
    }
}
