<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratemastersupplier extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_supplier' 		=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'supplier'    	    => ['type' => 'VARCHAR', 'constraint' => '100'],
			'alamat_supplier'   => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true,],
			'telp_supplier'     => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true,],
			'ppn'     			=> ['type' => 'INT', 'constraint' => 11, 'default' => 0,],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_supplier', true);
		$this->forge->createTable('master_supplier');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('master_supplier');
	}
}
