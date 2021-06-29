<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use app\Models\AmplopModel;
use app\Helpers\AmplopHelper;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;


class AmplopController extends BaseController
{
	use ResponseTrait;

	public function __construct()
	{
		$this->amplopModel = model("AmplopModel");
		$this->amplopHelper = new \App\Helpers\AmplopHelper();
	}

	public function view_index()
	{
		$arrView = [
			"page_title" => "KP4 - Amplop Masuk",
			"ctl_id" => 3,
			"arrJs" => [
				base_url("/assets/js/admin-controller/amplop/index.js")
			]
		];

		return view("/admin_view/amplop/vw_index", $arrView);
	}

	public function view_genqrcode()
	{
		$options = new QROptions([
			'version'    => 5,
			'outputType' => QRCode::OUTPUT_IMAGE_PNG,
		]);

		// invoke a fresh QRCode instance
		$qrcode = new QRCode($options);

		$arrCode = [];
		for ($i = 0; $i < 15; $i++) {
			$arrData = [
				"host" => "kp4",
				"key" => uniqid(rand())
			];

			$amplopUrl = "https://panitiasatuabadgpdikp4.com/amplop/";
			$arrCode[] = $amplopUrl . base64_encode(json_encode($arrData));
			// and dump the output
			// $qrcode->render($data);

			// ...with additional cache file
			// $filename = 'amplop-' . md5($arrData["key"]) . '.png';
			// $qrcode->render($data, APPPATH . '../writable/uploads/amplop/' . $filename);

		}

		$arrView = [
			"qrcode" => $qrcode,
			"arrCode" => $arrCode
		];

		return view("/admin_view/amplop/vw_genqrcode", $arrView);
	}

	public function view_keluar()
	{
		$arrView = [
			"page_title" => "KP4 - Amplop Keluar",
			"ctl_id" => 3,
			"arrJs" => [
				"https://rawgit.com/schmich/instascan-builds/master/instascan.min.js",
				base_url("/assets/js/admin-controller/amplop/keluar.js")
			]
		];

		return view("/admin_view/amplop/vw_keluar", $arrView);
	}

	public function view_masuk()
	{
		$arrView = [
			"page_title" => "KP4 - Amplop Masuk",
			"ctl_id" => 3,
			"arrJs" => [
				"https://rawgit.com/schmich/instascan-builds/master/instascan.min.js",
				base_url("/assets/js/admin-controller/amplop/masuk.js")
			]
		];

		return view("/admin_view/amplop/vw_masuk", $arrView);
	}


	// API
	public function index()
	{
		$page = $this->request->getGet("page");
		$perpage = $this->request->getGet("limit");

		if (!$perpage) $perpage = 20;

		if (trim($page) == "" || $page < 0) {
			$page = 1;
		}

		$statusKembali = $this->request->getGet("status_kembali");
		$status = $this->request->getGet("status");

		if ($status == 0) {
			$arrWhere = [
				"status" => 0
			];
		} else {
			$arrWhere = [
				"status" => 1
			];

			if ($statusKembali !== "all") {
				$arrWhere = [
					'status_kembali' => $statusKembali,
					"status" => 1
				];
			}
		}

		$search = (string) $this->request->getGet("search");
		$arrData = $this->amplopHelper->retrieve_json_table(
			$page,
			$perpage,
			$search,
			"nama",
			$arrWhere
		);

		foreach ($arrData["data"] as $key => $arrVal) {
			$arrData["data"][$key]["jumlah"] = "Rp. " . number_format($arrVal["jumlah"]);
			$arrData["data"][$key]["created_at"] = explode(" ", $arrVal["created_at"])[0];
			if ($arrVal["tgl_kembali"]) {
				$arrData["data"][$key]["tgl_kembali"] = explode(" ", $arrVal["tgl_kembali"])[0];
			} else {
				$arrData["data"][$key]["tgl_kembali"] = " - ";
			}

			// $tempJson = [
			// 	"host" => "kp4",
			// 	"key" => $arrVal["amplop_key"]
			// ];
			// $json = json_encode($tempJson);
			// $arrData["data"][$key]["base64"] = base64_encode($json);
		}

		$arrRespond = [
			"status" => true,
			"data" => $arrData["data"],
			"total" => $arrData["total"],
			"totalpage" => ceil($arrData["total"] / $perpage)
		];

		return $this->respond($arrRespond, 200);
	}

	public function api_keluar()
	{
		$nama = $this->request->getPost("nama");
		$ket = $this->request->getPost("keterangan");

		$arrAmplop = $this->request->getPost("amplop");

		$arrInsert = [];
		foreach ($arrAmplop as $key => $val) {
			$json = base64_decode($val);
			$arrData = json_decode($json);
			$arrInsert[] = [
				"nama" => $nama,
				"keterangan" => $ket,
				"amplop_key" => $arrData->key,
				"status" => 1
			];
		}

		$status = $this->amplopModel->insertBatch($arrInsert);

		$arrRes = [
			"status" => $status
		];

		return $this->respond($arrRes, 200);
	}

	public function api_masuk()
	{
		$jumlah = $this->request->getPost("jumlah");
		$ket = $this->request->getPost("ket_kembali");
		$amplop_key = $this->request->getPost("amplop_key");

		$arrUpdate = [
			"jumlah" => $jumlah,
			"ket_kembali" => $ket,
			"tgl_kembali" => date("Y-m-d H:i:s"),
			"status_kembali" => 1
		];

		$arrWhere = [
			"amplop_key" => $amplop_key,
			"status_kembali" => 0,
			"status" => 1
		];

		$status = $this->amplopModel
			->where($arrWhere)
			->set($arrUpdate)
			->update();
		// $status = $this->amplopModel->insertBatch($arrInsert);

		$arrRes = [
			"status" => $status
		];

		return $this->respond($arrRes, 200);
	}

	public function api_cek($base64)
	{
		$json = base64_decode($base64);
		$arrData = json_decode($json);

		if (isset($arrData->key)) {

			$arrWhere  = [
				"amplop_key" => $arrData->key,
				"status" => 1
			];

			$arrAmplop = $this->amplopModel->where($arrWhere)->first();
			if ($arrAmplop) {
				$arrRes = [
					"status" => false,
					"msg" => "QRCode sudah ada",
					"arrData" => $arrAmplop
				];
			} else {
				$arrRes = [
					"status" => true,
					"msg" => "QRCode diterima",
					"arrData" => false
				];
			}
		} else {
			$arrRes = [
				"status" => false,
				"msg" => "QRCode tidak sesuai",
				"arrData" => false
			];
		}

		return $this->respond($arrRes, 200);
	}
}
