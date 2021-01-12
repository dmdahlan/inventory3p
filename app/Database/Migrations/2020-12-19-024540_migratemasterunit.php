<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratemasterunit extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_nopol' 			=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'kode_nopol'    	=> ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
			'nopol'  		 	=> ['type' => 'VARCHAR', 'constraint' => '100'],
			'brand_name' 		=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'exp_stnk' 			=> ['type' => 'DATE', 'null' => true],
			'exp_kir' 			=> ['type' => 'DATE', 'null' => true],
			'exp_stnk_tahun' 	=> ['type' => 'DATE', 'null' => true],
			'ket_nopol'     	=> ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_nopol', true);
		$this->forge->createTable('master_unit');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('master_unit');
	}
}
