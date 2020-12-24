<?php

namespace App\Controllers;

class Print_pocash extends BaseController
{
    public function index()
    {
        if (empty($this->request->getVar('keyword'))) {
            $keyword = $this->printpocash->max();
        } else {
            $keyword = $this->request->getVar('keyword');
        }
        $cari = $this->request->getVar('keyword');
        $data = [
            'title'         => 'Print | PO Cash',
            'po'            => $this->printpocash->inv($cari),
            'ket'           => $this->printpocash->ket($keyword)
        ];
        return view('print/vw_printpocash', $data);
    }
}
