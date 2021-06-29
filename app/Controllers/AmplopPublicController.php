<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AmplopModel;

class AmplopPublicController extends BaseController
{

	public function __construct()
	{
		$this->amplopModel = model("AmplopModel");
	}

	public function view_show($base64)
	{
		$json = base64_decode($base64);
		$arrData = json_decode($json);

		$arrRes = [
			"status" => false,
			"msg" => "QRCode tidak valid",
			"arrData" => false
		];

		if (isset($arrData->key)) {
			$arrWhere  = [
				"amplop_key" => $arrData->key,
				"status" => 1
			];

			$arrAmplop = $this->amplopModel->where($arrWhere)->first();
			if ($arrAmplop) {
				$arrRes = [
					"status" => true,
					"msg" => "QRCode dapat diteirima",
					"arrData" => $arrAmplop
				];
			}
		}

		$arrView = [
			"page_title" => "KP4 - Amplop",
			"arrRes" => $arrRes
		];

		return view("/public_view/amplop/view_show", $arrView);
	}
}
