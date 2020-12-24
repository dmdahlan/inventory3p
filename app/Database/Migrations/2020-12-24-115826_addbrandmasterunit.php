<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addbrandmasterunit extends Migration
{
	public function up()
	{
		$this->forge->addColumn('master_unit', ['brand' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true, 'after' => 'nopol']]);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropColumn('master_unit', 'brand_id');
	}
}
