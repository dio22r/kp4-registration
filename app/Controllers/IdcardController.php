<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class IdcardController extends BaseController
{
	public function __construct()
	{
		$this->regModel = new \App\Models\RegistrationModel();
	}

	public function print_kartu($type, $key)
	{

		$options = new QROptions([
			'version'    => 5,
			'outputType' => QRCode::OUTPUT_IMAGE_PNG,
		]);

		// invoke a fresh QRCode instance
		$qrcode = new QRCode($options);
		$arrData = [
			"key" => $key,
			"type" => $type
		];

		$arrData = $this->regModel->where($arrData)->first();

		if ($arrData) {
			if ($arrData["type"] == 3 && $arrData["status_lunas"] == 0) {
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
				exit();
			}
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			exit();
		}

		$strType = "id-pan";
		$background = "KARTU-PANITIA.png";
		if ($type == 2) {
			$strType = "id-t";
			$background = "KARTU-TAMU.png";
		} elseif ($type == 3) {
			$strType = "id-p";
			$background = "KARTU-PESERTA.png";
		}

		$url = base_url("/$strType/$key"); // isi qrcode

		$arrView = [
			"qrcode" => $qrcode,
			"url" => $url,
			"background" => $background,
			"nama" => $arrData["nama"]
		];

		return view("/admin_view/idcard/single_id_view", $arrView);
	}
}
