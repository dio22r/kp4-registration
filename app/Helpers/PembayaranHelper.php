<?php

namespace App\Helpers;

use App\Models\PembayaranModel;

class PembayaranHelper
{
  public function __construct()
  {
    $this->byrModel = new PembayaranModel();
  }

  public function retrieve_json_table(
    $page,
    $perpage = 10,
    $searchdata = "",
    $searchfield = "nama",
    $arrWhere = []
  ) {

    $start = ($page - 1) * $perpage;

    $data = $this->byrModel->select("pembayaran.id_pembayaran, pembayaran.created_at, pembayaran.keterangan, jumlah_bayar, count(id_register) as jumlah_peserta")
      ->join("pembayaran_peserta as t1", "pembayaran.id_pembayaran = t1.id_pembayaran", "left")
      ->like($searchfield, $searchdata, "both")
      ->where($arrWhere)
      ->groupBy("pembayaran.id_pembayaran")
      ->orderBy("pembayaran.created_at DESC")
      ->findAll($perpage, $start);

    $result = $this->byrModel->select("count(*) as total")
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
