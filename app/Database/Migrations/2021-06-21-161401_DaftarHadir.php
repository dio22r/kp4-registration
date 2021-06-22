<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DaftarHadir extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'bigint',
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
			'id_peserta' => [
				'type' => 'bigint',
				'unique' => true,
			]
		]);
		$this->forge->addKey('id', true);

		$this->forge->createTable('daftar_hadir');
	}

	public function down()
	{
		$this->forge->dropTable('daftar_hadir');
	}
}
