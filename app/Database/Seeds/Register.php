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
				'total_tagihan' => 750000
			],
			[
				"nama" => "Christie",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 750000
			],
			[
				"nama" => "Donking",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 750000
			],
			[
				"nama" => "Brur Kaleb",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 750000
			],
			[
				"nama" => "Gian",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 750000
			],
			[
				"nama" => "Aldy",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 750000
			],
			[
				"nama" => "Given",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 750000
			],
			[
				"nama" => "Ka Yop",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 750000
			],
			[
				"nama" => "Ayen",
				"alamat" => "Desa Rerer",
				"kontak" => "0982101232",
				'total_tagihan' => 750000
			],
		];

		foreach ($data as $key => $arrVal) {
			$regHelper->insert_data($arrVal);
		}
	}
}
