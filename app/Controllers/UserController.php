<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
	public function __construct()
	{
		$this->userHelper = new \App\Helpers\UserHelper();
		$this->userModel = model("userModel");
		$this->session = \Config\Services::session();
	}

	public function index()
	{
		//
	}

	public function view_login()
	{
		return view("/admin_view/login_view");
	}

	public function api_check_login()
	{
		$arrPost = $this->request->getPost();

		$arrData = $this->userModel
			->where(['username' => $arrPost["username"]])
			->first();

		if (!$arrData) {
			return redirect('form-login-kp4');
		}

		if (password_verify($arrPost["password"], $arrData["password"])) {
			$this->userHelper->set_login_info($arrData);
			return redirect('admin');
		}
		return redirect('form-login-kp4');
	}

	public function view_change_password()
	{
		// 
	}

	public function api_change_password()
	{
		// 
	}

	public function logout()
	{
		$this->session->destroy();
		return redirect('/');
	}
}
