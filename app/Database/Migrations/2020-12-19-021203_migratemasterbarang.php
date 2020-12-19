<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratemasterbarang extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_barang' 		=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'nama_barang'    	=> ['type' => 'VARCHAR', 'constraint' => '100'],
			'kode_barang'   	=> ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
			'ket_barang'     	=> ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_barang', true);
		$this->forge->createTable('master_barang');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('master_barang');
	}
}
