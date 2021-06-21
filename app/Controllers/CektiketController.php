<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class CektiketController extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		$arrView = [
			"page_title" => "KP4 | Cek Tiket",
			"arrJs" => [
				"https://rawgit.com/schmich/instascan-builds/master/instascan.min.js",
				base_url("/assets/js/admin-controller/cektiket/index.js"),
			]
		];

		return view("/admin_view/cektiket/index_view", $arrView);
	}

	public function validation($base64)
	{
		$json = base64_decode($base64);
		$arrData = json_decode($json);


		return $this->respond($arrData, 200);
	}
}
