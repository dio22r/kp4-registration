<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\UserHelper;
use CodeIgniter\API\ResponseTrait;

class KegiatanController extends BaseController
{
	use ResponseTrait;

	protected $roleAllowed = [1, 2];

	public function __construct()
	{

		$this->kegiatanModel = model("KegiatanModel");

		$this->userHelper = new UserHelper();

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
		$arrData = $this->kegiatanModel->findAll();

		$arrView = [
			"page_title" => "KP4 | Kegiatan",
			"ctl_id" => 3,
			"arrJs" => [],
			"arrData" => $arrData
		];

		return view("/admin_view/kegiatan/index_view", $arrView);
	}

	public function view_form($id = "")
	{

		$arrData = [];
		$actionUrl = base_url("/admin/kegiatan");
		if ($id) {
			$arrData = $this->kegiatanModel->find($id);
			$actionUrl = base_url("/admin/kegiatan/$id");
		}

		$arrView = [
			"page_title" => "KP4 | Kegiatan",
			"ctl_id" => 3,
			"arrJs" => [],
			"arrData" => $arrData,
			"actionUrl" => $actionUrl
		];

		return view("/admin_view/kegiatan/form_view", $arrView);
	}

	public function index()
	{
		// 
	}

	public function show($id)
	{
		$arrData = $this->kegiatanModel->find($id);
		$arrJson = [
			"status" => true,
			"data" => $arrData
		];

		return $this->respond($arrJson);
	}

	public function create()
	{
		$arrPost = $this->request->getPost();
		if ($this->kegiatanModel->save($arrPost)) {
			if ($arrPost["status"] == 1) {
				$tempId = $this->kegiatanModel->insertID;
				$this->kegiatanModel
					->set("status", 0)
					->where("id !=", $tempId)
					->update();
			}

			$redir = base_url("/admin/kegiatan");
		} else {
			$redir = base_url("/admin/kegiatan/form");
		}

		header("Location: $redir");
		exit;
	}

	public function update($id)
	{
		$arrPost = $this->request->getPost();
		$arrPost["id"] = $id;

		if ($this->kegiatanModel->save($arrPost)) {
			if ($arrPost["status"] == 1) {
				$this->kegiatanModel
					->set("status", 0)
					->where("id !=", $id)
					->update();
			}

			$redir = base_url("/admin/kegiatan");
		} else {
			$redir = base_url("/admin/kegiatan/form");
		}

		header("Location: $redir");
		exit;
	}

	public function remove($id)
	{
		$this->kegiatanModel->delete($id);
	}
}
