<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratepembeliancash extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_cash' 			=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'tgl_reimburst'    	=> ['type' => 'DATE', 'null' => true],
			'tgl_nota'    		=> ['type' => 'DATE'],
			'nama_toko'  	 	=> ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
			'brand_id'   		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'nopol_id'   		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'driver_id'   		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'nota_order'   		=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'barang_id'   		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'qty'   			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'harga'   			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'total'   			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_cash', true);
		$this->forge->createTable('pembelian_cash');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pembelian_cash');
	}
}
