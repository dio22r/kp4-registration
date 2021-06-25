<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Kodinger">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>KP4 - Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <link rel="stylesheet" type="text/css" href="<?= base_url("/assets/css/login_view.css"); ?>">


  <script src="https://www.google.com/recaptcha/api.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
  <script src="<?= base_url("/assets/js/admin-controller/login.js"); ?>" defer></script>

</head>

<body class="my-login-page">
  <div id="data-vue">
    <section class="h-100">
      <div class="container h-100">
        <div class="row justify-content-md-center h-100">
          <div class="card-wrapper">
            <div class="text-center m-5">
              <img src="/assets/images/logo-gpdi.png" alt="logo" height="100px">
            </div>
            <div class="card fat">
              <div class="card-body">
                <h4 class="card-title">Login</h4>
                <p>Selamat Datang di web portal Panitia KP4 100 tahun GPdI.</p>

                <div v-if="alert_show" class="alert alert-danger" role="alert">
                  <ul class="m-0">
                    {{msg}}
                  </ul>
                </div>

                <form method="POST" id="form" class="my-login-validation" v-on:submit="submit($event)">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" value="" required autofocus>

                  </div>

                  <div class="form-group">
                    <label for="password">Password
                    </label>
                    <input id="password" type="password" class="form-control" name="password" required data-eye>
                  </div>

                  <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6Ldn_T0bAAAAAJ91SqDahIiePHe9a-K_DD4Yvx2j"></div>
                  </div>

                  <div class="form-group m-0">
                    <button type="submit" class="btn btn-primary btn-block">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="footer">
              Copyright &copy; 2021 &mdash; Panitia 100 Tahun GPdI - KP4
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>

</html>