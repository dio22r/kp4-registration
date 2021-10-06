<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KP4 - Amplop - Print Code </title>
  <style>
    .container {
      display: flex;
      justify-content: center;
    }

    .warper-amplop {
      position: relative;
    }

    .qrcode-img {
      position: absolute;
      top: 122px;
      left: 246px;
      width: 117px;
      /* border: 2px solid #000; */
      transform: rotate(-90deg);
    }

    .logo-img {
      position: absolute;
      width: 12px;
      transform: rotate(-90deg);
      top: 172px;
      left: 301px;
    }

    .amplop-label {
      position: absolute;
      transform: rotate(-90deg);
      top: 172px;
      left: 355px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <!-- onload="window.print()" -->
  <?php foreach ($arrCode as $key => $val) { ?>
    <div class="container">
      <div class="warper-amplop">
        <img class="amplop-img" width="400px" src="<?= base_url("/assets/images/amplop-kp4-rev1.png"); ?>" />
        <img class="qrcode-img" width="120px" src="<?= $qrcode->render($val) ?>" alt="QR Code" />
        <img class="logo-img" width="120px" src="<?= base_url("/assets/images/logo-gpdi.png"); ?>" alt="QR Code" />
        <div class="amplop-label"><?= $arrInsert[$key]["nama"] ?></div>
      </div>
    </div>

    <div style="break-after:page"></div>
  <?php } ?>
</body>

</html>