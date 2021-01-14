<?php

namespace App\Controllers;

class Memo_read extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Memo',
            'read_memo'     => $this->memoread->readmemo()
        ];
        return view('data/vw_bacamemo', $data);
    }
}
