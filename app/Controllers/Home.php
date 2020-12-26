<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{

		$data = [
			'title'			=> 'Home'
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