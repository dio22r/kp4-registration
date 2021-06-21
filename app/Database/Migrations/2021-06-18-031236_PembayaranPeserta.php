<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembayaranPeserta extends Migration
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
			'id_register' => [
				'type' => 'bigint',
			],
			'id_pembayaran' => [
				'type' => 'bigint',
			],
			'keterangan' => [
				'type' => 'varchar',
				'constraint' => 150,
				'null' => true,
			],
			'status' => [  // 1 => aktif, 0 => delete
				'type' => 'int',
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addKey('id_pembayaran');
		$this->forge->addKey('id_register');

		$this->forge->createTable('pembayaran_peserta');
	}

	public function down()
	{
		$this->forge->dropTable('pembayaran_peserta');
	}
}
