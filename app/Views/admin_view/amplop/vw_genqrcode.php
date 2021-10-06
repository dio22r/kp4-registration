<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KP4 - Amplop - Print Code </title>
</head>

<body onload="window.print()">

  <?php foreach ($arrCode as $key => $val) { ?>

    <img width="120px" src="<?= $qrcode->render($val) ?>" alt="QR Code" />

  <?php } ?>
</body>

</html>