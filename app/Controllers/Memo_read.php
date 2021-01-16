<?php

namespace App\Controllers;

class Memo_read extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Memo',
            'read_memo'     => $this->memoread->readmemo(),
            'totalmemo'            => $this->memoread->view_memo()
        ];
        return view('data/vw_bacamemo', $data);
    }
}
