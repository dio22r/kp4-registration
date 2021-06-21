<?php

namespace App\Helpers;

use App\Models\RegistrationModel;

class AdminPesertaHelper
{
  public function __construct()
  {
    $this->regModel = new RegistrationModel();
  }

  public function retrieve_json_table(
    $page,
    $perpage = 10,
    $searchdata = "",
    $searchfield = "nama",
    $arrWhere = []
  ) {
    // 
    $start = ($page - 1) * $perpage;
    $data = $this->regModel->like($searchfield, $searchdata, "both")
      ->where($arrWhere)
      ->orderBy("nama ASC")
      ->findAll($perpage, $start);

    $result = $this->regModel->select("count(*) as total")
      ->like($searchfield, $searchdata, "both")
      ->where($arrWhere)
      ->first();

    $total = $result["total"];

    return [
      "data" => $data,
      "total" => $total
    ];
  }

  public function qrcode($arrData)
  {
    // 
    if (!$arrData["qrcode"]) {

      $status = false;

      $qrData = [
        "id" => $arrData["id"],
        "key" => $arrData["key"]
      ];

      $strJson = json_encode($qrData);
      $base64 = base64_encode($strJson);

      $arrGet = [
        "cht" => "qr",
        "chs" => "250x250",
        "chl" => $base64,
        "choe" => "UTF-8"
      ];

      $qrcode_url = 'https://chart.googleapis.com/chart?' . http_build_query($arrGet);
      $image = file_get_contents($qrcode_url);

      $qrcodepath = APPPATH . "../public/assets/images/qrcode/";
      $qrcodefilename = md5(date("YmdHis")) . ".png";

      $ws = file_put_contents($qrcodepath . $qrcodefilename, $image);
      if ($ws) {
        $arrData["qrcode"] = $qrcodefilename;
        $status = $this->regModel->save($arrData);
      }

      if (!$status) {
        $arrData["qrcode"] = "";
      }
    }

    $qrcode_url = false;
    if ($arrData["qrcode"]) {
      $qrcode_url = base_url("/assets/images/qrcode/" . $arrData["qrcode"]);
    }

    return $qrcode_url;
  }
}
