<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['auth', 'md_helper'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->validation 					= \Config\Services::validation();
		$this->db 							= \Config\Database::connect();

		$this->adminmenu 					= new \App\Models\AdminMenu;
		$this->adminrole 					= new \App\Models\AdminRole;
		$this->adminuser 					= new \App\Models\AdminUser;
		$this->adminlog 					= new \App\Models\AdminLog;

		$this->mastersupplier				= new \App\Models\MasterSupplier;
		$this->masterbarang					= new \App\Models\MasterBarang;
		$this->masterunit					= new \App\Models\MasterUnit;
		$this->masterdriver 				= new \App\Models\MasterDriver;

		$this->pembeliankredit				= new \App\Models\PembelianKredit;
		$this->bayarkredit					= new \App\Models\PembelianBayarkredit;
		$this->pembeliancash				= new \App\Models\PembelianCash;
		$this->bayarcash					= new \App\Models\PembelianBayarcash;
		$this->pembayaranstnk				= new \App\Models\PembayaranStnk;

		$this->printpokredit				= new \App\Models\PrintPokredit;
		$this->printpocash					= new \App\Models\PrintPocash;

		$this->rekapkredit					= new \App\Models\RekapPembeliankredit;
		$this->rekapcash					= new \App\Models\RekapPembeliancash;
		$this->rekaphutangkredit			= new \App\Models\RekapHutangkredit;
		$this->rekaphutangcash				= new \App\Models\RekapHutangcash;

		$this->pemakaianbarang				= new \App\Models\PemakaianBarang;

		$this->rekappakai					= new \App\Models\RekapPemakaian;
	}
	function rupiah($angka)
	{
		$hasil_rupiah = number_format($angka, 0, ',', '.');
		return $hasil_rupiah;
	}
}
