<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\RegistrationHelper;
use CodeIgniter\API\ResponseTrait;

class PanitiaController extends BaseController
{
  use ResponseTrait;

  protected $roleAllowed = [1, 2];

  public function __construct()
  {

    $this->adminPesertaHelper = new \App\Helpers\AdminPesertaHelper();
    $this->userHelper = new \App\Helpers\UserHelper();

    $this->regModel = new \App\Models\RegistrationModel();

    $this->apiUrl = base_url("/admin/panitia/");

    $arrUser = $this->userHelper->get_login_info();
    $roleId = $arrUser["role"];

    if (!in_array($roleId, $this->roleAllowed)) {
      $redir = base_url("/admin/cek-tiket");
      header("Location: $redir");
      exit;
    }
  }

  public function view_index()
  {
    $arrView = [
      'page_title' => 'KP4 - Admin | Panitia',
      'ctl_id' => 1,
      'arrJs' => [
        base_url('/assets/js/admin-controller/panitia/index.js?')
      ],

      "api_url" => $this->apiUrl
    ];

    return view('/admin_view/panitia/index_view', $arrView);
  }

  public function view_form($id = "")
  {

    $actionUrl = base_url("/admin/panitia");
    if ($id) {
      $actionUrl = base_url("/admin/panitia/$id");
    }

    $arrView = [
      'page_title' => 'KP4 - Admin | Panitia',
      'ctl_id' => 1,
      'arrJs' => [],
      'actionUrl' => $actionUrl
    ];

    return view('/admin_view/panitia/form_view', $arrView);
  }

  // API Resources
  public function index()
  {
    $page = $this->request->getGet("page");
    $perpage = $this->request->getGet("limit");
    $type = $this->request->getGet("type");

    if (!$perpage) $perpage = 20;

    if (trim($page) == "" || $page < 0) {
      $page = 1;
    }

    $arrWhere = [];
    $deletedOnly = false;
    if ($type != 0) {
      $arrWhere = [
        'type' => $type
      ];
    } else {
      $arrWhere = [
        'type !=' => 3
      ];
      $deletedOnly = true;
    }


    $search = (string) $this->request->getGet("search");
    $arrData = $this->adminPesertaHelper->retrieve_json_table($page, $perpage, $search, "nama", $arrWhere, $deletedOnly);

    $arrRespond = [
      "data" => $arrData["data"],
      "total" => $arrData["total"],
      "totalpage" => ceil($arrData["total"] / $perpage)
    ];

    return $this->respond($arrRespond, 200);
  }

  public function show($id)
  {
    $arrData = $this->regModel->select("distinct(register.id) as id_reg, register.*, id_pembayaran")
      ->join("pembayaran_peserta as t1", "register.id = t1.id_register", "left")
      ->where("register.id", $id)->first();

    $return = [
      "status" => false,
      "data" => "Data tidak ditemukan"
    ];

    if ($arrData) {

      $arrData["qrcode_url"] = false;
      if ($arrData["status_lunas"] == 1) {
        // $arrData["qrcode_url"] = ""; // $this->adminPesertaHelper->qrcode($arrData);
        $arrQrcode = $this->adminPesertaHelper->qrcode_img($arrData["type"], $arrData["key"]);

        $arrData["qrcode_url"] = $arrQrcode["img"];
        $arrData["idcard_url"] = $arrQrcode["url"];
      }

      $return = [
        "status" => true,
        "data" => $arrData
      ];
    }

    return $this->respond($return, 200);
  }

  public function create()
  {
    $regHelper = new RegistrationHelper();
    $arrPost = $this->request->getPost();

    $arrPost["status_lunas"] = 1;

    $arrRet = $regHelper->insert_data($arrPost);

    $redir = base_url("/admin/panitia/form");
    if ($arrRet["status"]) {
      $redir = base_url("/admin/panitia");
    }

    header("Location: $redir");
    exit;
  }

  public function update($id)
  {
    $arrJSON = $this->request->getJSON();

    $status = false;
    $msg = "Maaf Terjadi Kesalahan, silahkan coba lagi";
    try {
      $status = $this->regModel->update($id, $arrJSON);
      if ($status) {
        $msg = "Data telah terupdate";
      }
    } catch (\Exception $e) {
      $arrJSON = $e;
    }

    $return = [
      "status" => $status,
      "msg" => $msg,
      "arrPost" => $arrJSON
    ];

    return $this->respond($return, 200);
  }

  public function delete($id)
  {
    $arrData = $this->regModel->delete($id);

    return $this->respond($arrData, 200);
  }
}
