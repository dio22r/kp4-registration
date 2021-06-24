<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Helpers\RegistrationHelper;

class RegistrationController extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		$arrView = [
			'page_title' => 'KP4 | Pendaftaran',

			'arrJs' => [
				base_url('/assets/js/controller/registration.js')
			]
		];

		return view('public_view/vw_registration_form', $arrView);
	}

	public function create()
	{
		$regHelper = new RegistrationHelper();

		$arrPost = $this->request->getPost();

		$arrJson = [
			'status' => false,
			'msg' => 'Centang terlebih dahulu kode keamanan'
		];

		$status["success"] = true;
		// $status = $regHelper->verify_captcha($this->request);
		if ($status["success"]) {
			$arrSave = [
				'nama' => $arrPost['form_nama'],
				'alamat' => $arrPost['form_alamat'],
				'kontak' => $arrPost['form_kontak'],
				'total_tagihan' => 500000
			];

			$arrJson = $regHelper->insert_data($arrSave);
		}

		return $this->respond($arrJson);
	}

	public function view_complete()
	{
		return view("/public_view/vw_registration_complete");
	}
}
