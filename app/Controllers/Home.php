<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{

		$data = [
			'title'			=> 'Home',
			'totalstnk'			=> $this->masterunit->totalexpstnk()->getRowArray(),
			'totalkir'			=> $this->masterunit->totalexpkir()->getRowArray()
		];
		return view('welcome_message', $data);
	}
	public function error()
	{
		$data = [
			'title'         => '404'
		];
		return view('auth/vw_error', $data);
	}
	//--------------------------------------------------------------------

}
