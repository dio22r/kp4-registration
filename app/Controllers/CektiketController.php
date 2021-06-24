<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class CektiketController extends BaseController
{
	use ResponseTrait;

	protected $roleAllowed = [1, 2, 3];


	public function view_index()
	{
		$arrView = [
			"page_title" => "KP4 | Cek Tiket",
			"ctl_id" => 2,
			"arrJs" => [
				"https://rawgit.com/schmich/instascan-builds/master/instascan.min.js",
				base_url("/assets/js/admin-controller/cektiket/index.js"),
			]
		];

		return view("/admin_view/cektiket/index_view", $arrView);
	}

	public function validation($base64)
	{
		$this->regModel = new \App\Models\RegistrationModel();
		$this->daftarHadirModel = new \App\Models\DaftarHadirModel();

		$json = base64_decode($base64);
		$arrData = (array) json_decode($json);
		$arrData = $this->regModel->where($arrData)->first();

		if ($arrData) {
			$arrJson = [
				"status" => false,
				"msg" => "Data sudah ada",
				"arrData" => [
					"nama" => $arrData["nama"],
					"alamat" => $arrData["alamat"],
					"status_lunas" => $arrData["status_lunas"]
				]
			];

			$arrSave = [
				"id_peserta" => $arrData["id"]
			];

			if ($arrData["status_lunas"] == 1) {
				try {
					$this->daftarHadirModel->save($arrSave);
					$arrJson["status"] = true;
					$arrJson["msg"] = "Selamat Datang";
				} catch (\Exception $e) {
					$arrJson["msg"] = "Data sudah ada";
				}
			} else {
				$arrJson["msg"] = "Harap hubungi panitia untuk validasi data anda";
			}
		} else {
			$arrJson = [
				"status" => false,
				"msg" => "Data tidak ditemukan",
				"arrData" => false
			];
		}

		return $this->respond($arrJson, 200);
	}

	public function index()
	{
		$this->daftarHadirHelper = new \App\Helpers\DaftarHadirHelper();
		$page = $this->request->getGet("page");
		$perpage = $this->request->getGet("limit");

		if (!$perpage) $perpage = 20;

		if (trim($page) == "" || $page < 0) {
			$page = 1;
		}

		$arrWhere = [];

		$search = (string) $this->request->getGet("search");
		$arrData = $this->daftarHadirHelper->retrieve_json_table($page, $perpage, $search, "nama", $arrWhere);

		$arrRespond = [
			"data" => $arrData["data"],
			"total" => $arrData["total"],
			"totalpage" => ceil($arrData["total"] / $perpage)
		];

		return $this->respond($arrRespond, 200);
	}
}
