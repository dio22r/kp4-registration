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
      top: 380px;
      left: 127px;
      width: 147px;
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
      bottom: 40px;
      font-size: 20px;
      font-weight: bold;
      width: 100%;
      text-align: center;
    }
  </style>
</head>

<body>
  <!-- onload="window.print()" -->

  <div class="container">
    <div class="warper-amplop">
      <img class="amplop-img" width="400px" src="<?= base_url("/assets/images/$background"); ?>" />
      <img class="qrcode-img" width="147px" src="<?= $qrcode->render($url) ?>" alt="QR Code" />
      <p class="amplop-label"><?= $nama ?></p>
    </div>
  </div>

</body>

</html>