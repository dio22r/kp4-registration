<?php

namespace App\Helpers;

use App\Models\AmplopModel;

class AmplopHelper
{
  public function __construct()
  {
    $this->amplopModel = model("AmplopModel");
  }

  public function retrieve_json_table(
    $page,
    $perpage = 10,
    $searchdata = "",
    $searchfield = "nama",
    $arrWhere = []
  ) {

    $start = ($page - 1) * $perpage;

    $data = $this->amplopModel->select("*")
      ->like($searchfield, $searchdata, "both")
      ->where($arrWhere)
      ->orderBy("created_at DESC")
      ->findAll($perpage, $start);

    $result = $this->amplopModel->select("count(*) as total")
      ->like($searchfield, $searchdata, "both")
      ->where($arrWhere)
      ->first();

    $total = $result["total"];

    return [
      "data" => $data,
      "total" => $total
    ];
  }
}
