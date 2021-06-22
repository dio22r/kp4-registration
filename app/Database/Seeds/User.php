<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \App\Helpers\UserHelper;

class User extends Seeder
{
	public function run()
	{
		$userHelper = new UserHelper();

		$data = [
			[
				"nama" => "Dio Ratar",
				"username" => "admin",
				"password" => "12345",
				"role" => 1,
				'status' => 1
			],
			[
				"nama" => "Pdt. Vecky Mamentu",
				"username" => "vecky_mamentu",
				"password" => "12345",
				"role" => 2,
				'status' => 1
			],
			[
				"nama" => "Usher",
				"username" => "usher",
				"password" => "12345",
				"role" => 3,
				'status' => 1
			],
		];

		foreach ($data as $key => $arrVal) {
			$userHelper->insert_data($arrVal);
		}
	}
}
