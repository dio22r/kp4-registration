<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class AdminController extends BaseController
{
	use ResponseTrait;

	protected $roleAllowed = [1, 2];

	public function __construct()
	{

		$this->adminPesertaHelper = new \App\Helpers\AdminPesertaHelper();
		$this->userHelper = new \App\Helpers\UserHelper();

		$this->regModel = new \App\Models\RegistrationModel();

		$this->apiUrl = base_url("/admin/peserta/");

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
			'page_title' => 'KP4 - Admin',
			'ctl_id' => 0,
			'arrJs' => [
				base_url('/assets/js/admin-controller/peserta/index.js')
			],

			"api_url" => $this->apiUrl
		];

		return view('/admin_view/registration/index_view', $arrView);
	}

	public function view_form($id = "")
	{
		// 
	}

	// API Resources
	public function index()
	{
		$page = $this->request->getGet("page");
		$perpage = $this->request->getGet("limit");
		$statusLunas = $this->request->getGet("status_lunas");

		if (!$perpage) $perpage = 20;

		if (trim($page) == "" || $page < 0) {
			$page = 1;
		}

		$arrWhere = [
			'status_lunas' => $statusLunas
		];

		$search = (string) $this->request->getGet("search");
		$arrData = $this->adminPesertaHelper->retrieve_json_table($page, $perpage, $search, "nama", $arrWhere);

		$arrRespond = [
			"data" => $arrData["data"],
			"total" => $arrData["total"],
			"totalpage" => ceil($arrData["total"] / $perpage)
		];

		return $this->respond($arrRespond, 200);
	}

	public function show($id)
	{
		$arrData = $this->regModel->find($id);

		$return = [
			"status" => false,
			"data" => "Data tidak ditemukan"
		];

		if ($arrData) {

			$arrData["qrcode_url"] = false;
			if ($arrData["status_lunas"] == 1) {
				$arrData["qrcode_url"] = $this->adminPesertaHelper->qrcode($arrData);
			}

			$return = [
				"status" => true,
				"data" => $arrData
			];
		}

		return $this->respond($return, 200);
	}

	public function create()
	{
		//$status = $this->regModel->save();
	}

	public function update($id)
	{
		$arrJSON = $this->request->getJSON();

		$status = false;
		$msg = "Maaf Terjadi Kesalahan, silahkan coba lagi";
		try {
			$status = $this->regModel->update($id, $arrJSON);
			if ($status) {
				$msg = "Data telah terupdate";
			}
		} catch (\Exception $e) {
			$arrJSON = $e;
		}

		$return = [
			"status" => $status,
			"msg" => $msg,
			"arrPost" => $arrJSON
		];

		return $this->respond($return, 200);
	}

	public function delete($id)
	{
		$arrDelete = [
			'id' => $id,
			'status_lunas' => -1
		];
		$arrData = $this->regModel->save($arrDelete);

		return $this->respond($arrData, 200);
	}
}
