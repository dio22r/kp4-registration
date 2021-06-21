<?php

namespace App\Helpers;

class RegistrationHelper
{

	public function verify_captcha($request)
	{

		$secret = '6Ldn_T0bAAAAAJt7Fxex14M0TA2xDhff6DuiNV61';

		$credential = array(
			'secret' => $secret,
			'response' => $request->getVar('g-recaptcha-response')
		);

		$verify = curl_init();
		curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($verify, CURLOPT_POST, true);
		curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
		curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($verify);

		$status = json_decode($response, true);

		return $status;
	}

	public function insert_data($arrSave)
	{
		$this->regModel = new \App\Models\RegistrationModel();

		try {
			// set key;
			$arrSave['key'] = md5("kp4-" . date("YmdHis"));

			$status = $this->regModel->save($arrSave);
			$regId = $this->regModel->getInsertID();

			if ($status) {
				$arrJson = [
					'status' => true,
					'msg' => 'Data telah tersimpan',
					'arrData' => $this->regModel->find($regId)
				];
			} else {
				$arrJson = [
					'status' => false,
					'msg' => 'Periksa kembali data anda',
					'arr_err' => $this->regModel->errors()
				];
			}
		} catch (\Exception $e) {
			$arrJson = [
				'status' => false,
				'msg' => $e->getMessage(),
			];
		}

		return $arrJson;
	}
}
