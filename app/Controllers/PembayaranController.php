<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class PembayaranController extends BaseController
{
	use ResponseTrait;


	protected $roleAllowed = [1, 2];
	protected $menuId = 2;

	public function __construct()
	{
		$this->apiUrl = base_url("/admin/pembayaran/");

		$this->byrModel = new \App\Models\PembayaranModel();
		$this->byrPesertaModel = new \App\Models\PembayaranPesertaModel();
		$this->regModel = new \App\Models\RegistrationModel();

		$this->userHelper = new \App\Helpers\UserHelper();

		$arrUser = $this->userHelper->get_login_info();
		$roleId = $arrUser["role"];

		if (!in_array($roleId, $this->roleAllowed)) {
			$redir = base_url("/admin/cek-tiket");
			header("Location: $redir");
			exit;
		}
	}

	public function view_index()
	{
		$arrView = [
			"page_title" => "KP4 - Admin Pembayaran",
			"ctl_id" => $this->menuId,

			"arrJs" => [
				base_url("/assets/js/admin-controller/pembayaran/index.js")
			]
		];
		return view("/admin_view/pembayaran/vw_index_pembayaran", $arrView);
	}

	public function view_form($id = "")
	{
		$idPeserta = $this->request->getGet("id");
		if (!$idPeserta) {
			$idPeserta = false;
		}

		$arrView = [
			"page_title" => "KP4 - Admin Form Pembayaran",
			"ctl_id" => $this->menuId,
			"arrJs" => [
				base_url("/assets/js/admin-controller/pembayaran/form.js")
			],
			"arrJsConfig" => [
				"api_url" => base_url("/admin/pembayaran"),
				"idPeserta" => $idPeserta
			]
		];
		return view("/admin_view/pembayaran/vw_form_pembayaran", $arrView);
	}

	public function view_nota($id)
	{
		$arrBayar = $this->byrModel->find($id);
		$arrDetail = $this->byrPesertaModel->select("t1.*")
			->join("register as t1", "t1.id = id_register")
			->where("id_pembayaran", $id)->findAll();

		if (!$arrBayar) {
			// 
		}


		$arrBayar["str_tipe_pembayaran"] = [
			1 => "Transfer",
			2 => "Tunai"
		][$arrBayar["tipe_pembayaran"]];

		$arrView = [
			"arrBayar" => $arrBayar,
			"arrDetail" => $arrDetail
		];

		return view("/admin_view/pembayaran/vw_nota_pembayaran", $arrView);
	}

	public function view_detail($id)
	{
		$arrBayar = $this->byrModel->find($id);
		$arrDetail = $this->byrPesertaModel->select("t1.*")
			->join("register as t1", "t1.id = id_register")
			->where("id_pembayaran", $id)->findAll();

		$arrBayar["str_tipe_pembayaran"] = [
			1 => "Transfer",
			2 => "Tunai"
		][$arrBayar["tipe_pembayaran"]];

		$arrView = [
			"page_title" => "KP4 - Pembayaran",
			"ctl_id" => 1,

			"arrBayar" => $arrBayar,
			"arrDetail" => $arrDetail
		];

		return view("/admin_view/pembayaran/vw_detail_pembayaran", $arrView);
	}

	public function index()
	{
		$this->byrHelper = new \App\Helpers\PembayaranHelper();;

		$page = $this->request->getGet("page");
		$perpage = $this->request->getGet("limit");

		if (!$perpage) $perpage = 20;

		if (trim($page) == "" || $page < 0) {
			$page = 1;
		}

		$arrWhere = [
			'pembayaran.status' => 1
		];

		$search = (string) $this->request->getGet("search");
		$arrData = $this->byrHelper->retrieve_json_table($page, $perpage, $search, "pembayaran.keterangan", $arrWhere);

		$arrRespond = [
			"data" => $arrData["data"],
			"total" => $arrData["total"],
			"totalpage" => ceil($arrData["total"] / $perpage)
		];

		return $this->respond($arrRespond);
	}

	public function show($id)
	{
		$arrBayar = $this->byrModel->find($id);
		$arrDetail = $this->byrPesertaModel->where("id_pembayaran", $id)->findAll();

		print_r($arrBayar);
		print_r($arrDetail);
	}

	public function create()
	{
		$arrPost = $this->request->getPost();

		$arrInsert = [
			"tipe_pembayaran" => $arrPost["tipe_pembayaran"],
			"keterangan" => $arrPost["keterangan"],
			"jumlah_bayar" => $arrPost["jumlah_bayar"],
			"status" => 1
		];

		$status = false;
		$insertId = false;

		$file = $this->request->getFile('file_bukti_pembayaran');

		if ($file) {

			// Generate a new secure name
			$name = $file->getRandomName();

			// Move the file to it's new home
			$result = $file->move(PATH_BUKTI, $name);
			if ($result) {
				// insert pembayaran


				$this->byrModel->transBegin();

				$arrInsert["bukti_transaksi"] = $name;
				$result = $this->byrModel->save($arrInsert);
				$insertId = $this->byrModel->getInsertID();

				// insert pembayaran peserta
				foreach ($arrPost["peserta"] as $key => $val) {
					$peserta = [
						"id_register" => $val,
						"id_pembayaran" => $insertId,
						"status" => 1
					];
					$this->byrPesertaModel->save($peserta);
					$this->regModel->update($val, ["status_lunas" => 1]);
				}

				if ($this->byrModel->transStatus() === FALSE) {
					$this->byrModel->transRollback();
					$insertId = false;
				} else {
					$this->byrModel->transCommit();
					$status = true;
				}
			}
		}

		$arrRespond = [
			"status" => $status,
			"id" => $insertId
		];

		return $this->respond($arrRespond, 200);
	}

	public function update($id)
	{
		// 
	}

	public function delete()
	{
		// 
	}
}
