<!doctype html>
<html>

<head>
  <title><?= $page_title ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>

  <?php if (isset($arrJs)) { ?>
    <?php foreach ($arrJs as $key => $val) { ?>
      <script src="<?= $val; ?>" defer></script>
    <?php } ?>
  <?php } ?>

</head>

<body>

  <section id="menu" class="bg-primary">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">KP4 - Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?= base_url('/admin/'); ?>">Peserta<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/admin/pembayaran'); ?>">Pembayaran</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/admin/cek-tiket'); ?>">Cek Tiket</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-person-circle"></i> Admin
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="<?= base_url('/admin/ganti_password'); ?>">
                  <i class="bi bi-shield-lock-fill"></i> Ganti Password
                </a>
                <a class="dropdown-item" href="<?= base_url('/admin/logout'); ?>">
                  <i class="bi bi-lock-fill"></i> Logout
                </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </section>

  <?= $this->renderSection('content') ?>
</body>

</html>