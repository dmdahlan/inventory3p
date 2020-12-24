<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratepemakaianbarang extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_pakai' 		 	=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'tgl_pakai' 	   	=> ['type' => 'DATE', 'null' => true],
			'no_perbaikan' 	   	=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'nopol_id' 	  		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'keluhan_perbaikan' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
			'barang_id' 	  	=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'qty'  		 		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'harga'  		 	=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'total'  		 	=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'user_id' 	  		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_pakai', true);
		$this->forge->createTable('pemakaian_barang');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pemakaian_barang');
	}
}
