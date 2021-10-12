<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \App\Helpers\RegistrationHelper;

class Register extends Seeder
{
	public function run()
	{
		$regHelper = new RegistrationHelper();

		$data = [
			[
				"nama" => "Dio Ratar",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 500000,
				'type' => 3
			],
			[
				"nama" => "Christie",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 500000,
				'type' => 3
			],
			[
				"nama" => "Donking",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 500000,
				'type' => 3
			],
			[
				"nama" => "Brur Kaleb",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 500000,
				'type' => 3
			],
			[
				"nama" => "Gian",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 500000,
				'type' => 3
			],
			[
				"nama" => "Aldy",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 500000,
				'type' => 3
			],
			[
				"nama" => "Given",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 500000,
				'type' => 3
			],
			[
				"nama" => "Ka Yop",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 500000,
				'type' => 3
			],
			[
				"nama" => "Ayen",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 500000,
				'type' => 3
			],
		];

		foreach ($data as $key => $arrVal) {
			$regHelper->insert_data($arrVal);
		}
	}
}
