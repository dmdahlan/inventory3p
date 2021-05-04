<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratepembeliankredit extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_kredit' 		=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'tgl_nota'    		=> ['type' => 'DATE'],
			'supplier_id'   	=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'brand_id'   		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'nopol_id'   		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'nota_supp'   		=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'nota_order'   		=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'barang_id'   		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'rincian_kredit'   	=> ['type' => 'VARCHAR', 'constraint' => 225, 'null' => true],
			'qty'   			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'harga'   			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'disc'   			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'pembelianppn'   	=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'total'   			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'ket_kredit'   		=> ['type' => 'VARCHAR', 'constraint' => 225, 'null' => true],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_kredit', true);
		$this->forge->createTable('pembelian_kredit');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pembelian_kredit');
	}
}
