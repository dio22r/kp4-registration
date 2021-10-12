<?php

namespace App\Helpers;

use App\Models\RegistrationModel;

class DaftarHadirHelper
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
    $data = $this->regModel->select("type, nama, alamat, status_lunas, t1.created_at")
      ->join("daftar_hadir as t1", "register.id = t1.id_peserta")
      ->like($searchfield, $searchdata, "both")
      ->where($arrWhere)
      ->orderBy("t1.created_at DESC")
      ->groupBy("t1.id_peserta")
      ->findAll($perpage, $start);

    $result = $this->regModel
      ->select("count(distinct(t1.id_peserta)) as total")
      ->join("daftar_hadir as t1", "register.id = t1.id_peserta")
      ->like($searchfield, $searchdata, "both")
      ->where($arrWhere)
      // ->groupBy("t1.id_peserta")
      ->first();

    $total = $result["total"];

    return [
      "data" => $data,
      "total" => $total
    ];
  }
}
