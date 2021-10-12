<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kegiatan extends Migration
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
			'deleted_at' => [
				'type' => 'timestamp',
				'null' => true
			],
			'nama_kegiatan' => [
				'type' => 'varchar',
				'constraint' => 150
			],
			'date_start' => [
				'type' => 'date',
			],
			'time_start' => [
				'type' => 'time',
			],
			'date_end' => [
				'type' => 'date',
			],
			'time_end' => [
				'type' => 'time',
			],
			'tempat' => [
				'type' => 'varchar',
				'constraint' => 150
			],
			'keterangan' => [
				'type' => 'text',
			],
			'status' => [ // active non active
				'type' => 'int',
				'constraint' => 5,
			]
		]);
		$this->forge->addKey('id', true);

		$this->forge->createTable('kegiatan');
	}

	public function down()
	{
		$this->forge->dropTable('kegiatan');
	}
}
