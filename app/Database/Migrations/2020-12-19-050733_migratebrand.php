<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratebrand extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_brand' 			=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'brand'    	  	    => ['type' => 'VARCHAR', 'constraint' => 100],
			'brand_ket'  	    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
			'brand_alamat'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_brand', true);
		$this->forge->createTable('master_brand');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('master_brand');
	}
}
