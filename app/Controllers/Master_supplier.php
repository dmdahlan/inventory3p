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
}
