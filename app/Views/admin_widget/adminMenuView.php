<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="#">KP4 - Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <?php foreach ($arrMenu as $key => $arrVal) { ?>
        <?php
        $activeClass = $currentTag = "";
        if ($key == $ctl_id) {
          $activeClass = "active";
          $currentTag = '<span class="sr-only">(current)</span>';
        }
        ?>
        <li class="nav-item <?= $activeClass ?>">
          <a class="nav-link" href="<?= $arrVal["href"] ?>"><?= $arrVal["menu"] ?><?= $currentTag ?></a>
        </li>
      <?php } ?>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bi bi-person-circle"></i> <?= $nama ?>
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