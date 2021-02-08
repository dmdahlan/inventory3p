<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratepembayarancash extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_bayarcash'  	=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'cash_id'   		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'notaorder_id'   	=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'tgl_bayar1'    	=> ['type' => 'DATE', 'null' => true],
			'bank1' 	  		=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'via1' 		  		=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'nominal1'   		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'tgl_bayar2'    	=> ['type' => 'DATE', 'null' => true],
			'bank2' 	  		=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'via2' 		  		=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'nominal2'   		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'sisa_hutang'   	=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'coun'   			=> ['type' => 'INT', 'constraint' => 11, 'default' => 1],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_bayarcash', true);
		$this->forge->addUniqueKey('cash_id');
		$this->forge->addUniqueKey('notaorder_id');
		$this->forge->createTable('pembayaran_cash');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pembayaran_cash');
	}
}
