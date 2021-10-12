<?php

namespace App\Helpers;

use App\Models\RegistrationModel;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

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
    $arrWhere = [],
    $deletedOnly = false
  ) {
    // 
    $start = ($page - 1) * $perpage;
    $query = $this->regModel->like($searchfield, $searchdata, "both")
      ->where($arrWhere)
      ->orderBy("nama ASC");

    if ($deletedOnly) {
      $query->onlyDeleted();
    }
    $data = $query->findAll($perpage, $start);

    $query = $this->regModel->select("count(*) as total")
      ->like($searchfield, $searchdata, "both")
      ->where($arrWhere);

    if ($deletedOnly) {
      $query->onlyDeleted();
    }
    $result = $query->first();

    $total = $result["total"];

    return [
      "data" => $data,
      "total" => $total
    ];
  }


  public function qrcode_img($type, $key)
  {
    $options = new QROptions([
      'version'    => 5,
      'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    ]);

    // invoke a fresh QRCode instance
    $qrcode = new QRCode($options);

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

    $img = $qrcode->render($url);

    return [
      "url" => $url,
      "img" => $img
    ];
  }
}
