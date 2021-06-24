<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembayaran extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_pembayaran' => [
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
			'tipe_pembayaran' => [ // 1 => transfer, 2 => cash
				'type' => 'int',
				'constraint' => 5,
			],
			'bank_peserta' => [
				'type' => 'varchar',
				'constraint' => 100,
				'null' => true,
			],
			'no_rek_peserta' => [
				'type' => 'varchar',
				'constraint' => 100,
				'null' => true,
			],
			'tgl_bayar' => [
				'type' => 'datetime',
			],
			'jumlah_bayar' => [
				'type' => 'bigint',
			],
			'bukti_transaksi' => [
				'type' => 'varchar',
				'constraint' => 255,
			],
			'keterangan' => [
				'type' => 'text',
				'null' => true,
			],
			'id_user' => [
				'type' => 'int',
			],
			'status' => [
				'type' => 'int',
			],
		]);
		$this->forge->addKey('id_pembayaran', true);
		$this->forge->addKey('id_user');

		$this->forge->createTable('pembayaran');
	}

	public function down()
	{
		$this->forge->dropTable('pembayaran');
	}
}
