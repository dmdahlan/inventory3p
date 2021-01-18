<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratepembayaranstnk extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_bayarstnk' 		 => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'nopol_id'    		 => ['type' => 'INT', 'constraint' => 11],
			'tgl_bayar' 		 => ['type' => 'DATE', 'null' => true],
			'stnk_kir' 			 => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
			'expired' 			 => ['type' => 'DATE', 'null' => true],
			'nominal_bayar'    	 => ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'via'     			 => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
			'bank'     			 => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
			'nominal_simulasi'   => ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'nominal_pengurusan' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'created_at' 	     => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	     => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	     => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_bayarstnk', true);
		$this->forge->createTable('pembayaran_stnk');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pembayaran_stnk');
	}
}
