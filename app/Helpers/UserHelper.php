<?php

namespace App\Helpers;

use \App\Entities\UserEntity;

class UserHelper
{
  public function __construct()
  {
    $this->session = \Config\Services::session();
  }

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

  public function insert_data($arrData)
  {
    $this->userModel = new \App\Models\UserModel();

    try {
      // set key;

      $status = $this->userModel->save($arrData);
      $regId = $this->userModel->getInsertID();

      if ($status) {
        $arrJson = [
          'status' => true,
          'msg' => 'Data telah tersimpan',
        ];
      } else {
        $arrJson = [
          'status' => false,
          'msg' => 'Periksa kembali data anda',
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

  public function set_login_info($arrUser)
  {

    $this->session->set("id", $arrUser["id"]);
    $this->session->set("nama", $arrUser["nama"]);
    $this->session->set("role", $arrUser["role"]);

    return TRUE;
  }

  public function check_login()
  {
    if (empty($this->session->get('id'))) {
      return false;
    } else {
      return $this->session->get('id');
    }
  }

  public function get_login_info()
  {
    $arrData = [
      'id' => $this->session->get("id"),
      'nama' => $this->session->get("nama"),
      'role' => $this->session->get("role"),
    ];

    return $arrData;
  }
}
