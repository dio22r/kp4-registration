<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class CektiketController extends BaseController
{
	use ResponseTrait;

	protected $roleAllowed = [1, 2, 3];

	public function __construct()
	{
		$this->kegiatanModel = model("KegiatanModel");
	}

	public function view_index()
	{


		$dataKegiatan = $this->kegiatanModel->where("status", 1)->first();

		$arrView = [
			"page_title" => "KP4 | Cek Tiket",
			"ctl_id" => 3,
			"arrJs" => [
				// "https://rawgit.com/schmich/instascan-builds/master/instascan.min.js",
				base_url("/assets/js/instascan.min.js"),
				base_url("/assets/js/admin-controller/cektiket/index.js"),
			],
			"dataKegiatan" => $dataKegiatan
		];

		return view("/admin_view/cektiket/index_view", $arrView);
	}

	public function validation()
	{
		$this->regModel = new \App\Models\RegistrationModel();
		$this->daftarHadirModel = new \App\Models\DaftarHadirModel();

		$arrPost = $this->request->getPost();

		$arrType = [
			"id-pan" => 1,
			"id-t" => 2,
			"id-p" => 3,
		];

		if (!isset($arrType[$arrPost["type"]])) {
			return $this->respond(["msg" => "Error!"], 500);
		}

		$arrData = [
			"key" => $arrPost["key"],
			"type" => $arrType[$arrPost["type"]]
		];

		$arrData = $this->regModel->where($arrData)->first();
		$dataKegiatan = $this->kegiatanModel->where("status", 1)->first();

		if ($arrData && $dataKegiatan) {
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
				"id_peserta" => $arrData["id"],
				"type_peserta" => $arrData["type"],
				"id_kegiatan" => $dataKegiatan["id"],
				"date_time" => date("Y-m-d H:i:s"),
				"status_date_time" => 1 //$this->request->getPost("status")
			];

			if ($arrData["status_lunas"] == 1) {
				try {
					$this->daftarHadirModel->save($arrSave);
					$arrJson["status"] = true;
					$arrJson["msg"] = "Selamat Datang";
				} catch (\Exception $e) {
					$arrJson["msg"] = "Data sudah ada " . $e;
				}
			} else {
				$arrJson["msg"] = "Harap hubungi panitia untuk validasi data anda";
			}
		} else {
			$arrJson = [
				"status" => false,
				"msg" => "Data tidak ditemukan atau kegiatan masih belum aktif",
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


		$dataKegiatan = $this->kegiatanModel->where("status", 1)->first();

		$arrWhere = ["id_kegiatan" => $dataKegiatan["id"]];

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
