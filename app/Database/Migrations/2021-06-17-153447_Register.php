<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Register extends Migration
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
			'key' => [
				'type' => 'text',
			],
			'qrcode' => [ // field filepath images
				'type' => 'varchar',
				'constraint' => 255,
			],
			'status_lunas' => [
				'type' => 'int',
				'constraint' => 5,
			],
			'type' => [ // panitia, tamu, peserta default peserta
				'type' => 'int',
				'constraint' => 5,
			],
		]);
		$this->forge->addKey('id', true);

		$this->forge->createTable('register');
	}

	public function down()
	{
		$this->forge->dropTable('register');
	}
}
