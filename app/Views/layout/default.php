<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <script src='https://www.google.com/recaptcha/api.js' defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>

    <?php if (isset($arrJs)) { ?>
        <?php foreach ($arrJs as $key => $val) { ?>
            <script src="<?= $val; ?>" defer></script>
        <?php } ?>
    <?php } ?>

</head>

<body>
    <?= $this->renderSection('content') ?>



</body>

</html>