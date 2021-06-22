<?php

namespace App\Libraries;

class AdminWidget
{
  protected $isLogin;
  protected $sessionData;

  public function __construct()
  {
    $this->userModel = model('App\Models\UserModel');
    $this->userHelper = new \App\Helpers\UserHelper();
    $this->session = \Config\Services::session();
  }

  public function menu($params = [])
  {
    // 
    $arrUser = $this->userHelper->get_login_info();

    $result = [
      [
        "menu" => "Peserta",
        "href" => base_url("/admin")
      ],
      [
        "menu" => "Pembayaran",
        "href" => base_url("/admin/pembayaran")
      ],
      [
        "menu" => "Check-In",
        "href" => base_url("/admin/cek-tiket")
      ]
    ];

    if ($arrUser["role"] == 3) {
      $result = [
        2 => [
          "menu" => "Check-In",
          "href" => base_url("/admin/cek-tiket")
        ]
      ];
    }

    $data = [
      "arrMenu" => $result,
      "nama" => $arrUser["nama"]
    ];

    return view('admin_widget/adminMenuView', $data);
  }

  public function toolbar($data = [])
  {
    //
    $data = [
      "dataUser" => $this->userModel->find(1)
    ];
    return view('admin_widget/adminToolbarView', $data);
  }
}
