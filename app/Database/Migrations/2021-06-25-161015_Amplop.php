<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Amplop extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'int',
				'unsigned' => true,
				'auto_increment' => true,
			],
			'created_at' => [
				'type' => 'timestamp',
				'null' => true
			],
			'updated_at' => [
				'type' => 'timestamp',
				'null' => true
			],
			'nama' => [
				'type' => 'varchar',
				'constraint' => 150
			],
			'keterangan' => [
				'type' => 'varchar',
				'constraint' => 255
			],
			'amplop_key' => [
				'type' => 'varchar',
				'constraint' => 150,
			],
			'status_kembali' => [
				'type' => 'int',
				'constraint' => 5
			],
			'jumlah' => [
				'type' => 'bigint',
			],
			'ket_kembali' => [
				'type' => 'varchar',
				'constraint' => 255,
			],
			'tgl_kembali' => [
				'type' => 'datetime',
				'null' => true
			],
			'status' => [
				'type' => 'int',
				'constraint' => 5
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey('amplop_key');

		$this->forge->createTable('amplop');
	}

	public function down()
	{
		$this->forge->dropTable('amplop');
	}
}
