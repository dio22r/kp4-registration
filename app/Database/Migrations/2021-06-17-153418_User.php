<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
				'constraint' => 150,
			],
			'alamat' => [
				'type' => 'varchar',
				'constraint' => 150,
			],
			'kontak' => [
				'type' => 'varchar',
				'constraint' => 100,
			],
			'total_tagihan' => [
				'type' => 'bigint',
			],
			'keterangan' => [
				'type' => 'text',
				'null' => true,
			],
			'status_lunas' => [
				'type' => 'int'
			],
		]);
		$this->forge->addKey('id', true);

		//$this->forge->createTable('register');
	}

	public function down()
	{
		//
	}
}
