<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Memo extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_memo' 			=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'from_id'    		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'to_id'    			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'subject'  		 	=> ['type' => 'VARCHAR', 'constraint' => 100],
			'isi_memo'  		=> ['type' => 'TEXT', 'null' => true],
			'ket_memo'  		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_memo', true);
		$this->forge->createTable('memo');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('memo');
	}
}
