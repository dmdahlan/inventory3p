<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addexpstnk extends Migration
{
	public function up()
	{
		$this->forge->addColumn('master_unit', [
			'exp_stnk' => ['type' => 'DATE', 'null' => true, 'after' => 'brand_name'],
			'exp_kir' => ['type' => 'DATE', 'null' => true, 'after' => 'exp_stnk']
		]);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropColumn('master_unit', ['exp_stnk', 'exp_kir']);
	}
}
