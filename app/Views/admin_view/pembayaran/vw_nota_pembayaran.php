<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KP4 | Nota</title>
  <!-- Tell the browser to be responsive to screen width -->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!-- Font Awesome -->

  <style>
    .table-custom {
      width: 100%;
      margin: 1px 0px 3px 0px;
    }

    .table-custom td,
    .table-custom th {
      vertical-align: top;
      padding: 1px;
    }
  </style>
  <!-- Google Font -->
</head>

<body onload="window.print();">
  <!--  -->
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="container">

        <div class="row border-bottom  mt-5">
          <div class="col-sm-2 text-center">
            <img class="mt-2" src="<?php echo base_url("/assets/images/logo-gpdi.png"); ?>" style="height: 70px;" />
          </div>
          <div class="col-sm-8">
            <h4 class="text-center m-0">Gereja Pantekosta di Indonesia</h4>
            <h4 class="text-center m-0">Komisi Pelayanan Penginjilan Pantekosta Pusat</h4>
            <h4 class="text-center m-0">PANITIA 1 ABAD GPdI</h4>
          </div>
          <div class="col-sm-2" style="text-align:center;">
            <img src="<?php echo base_url("/assets/images/maxresdefault.jpg"); ?>" style="height: 90px;" />
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-8 offset-2 mt-3 mb-3">
            <div class="table-responsive">
              <table class="table-custom">
                <tr>
                  <th width="30%">Tanggal Konfirmasi:</th>
                  <td><?= $arrBayar["created_at"]; ?></td>
                </tr>
                <tr>
                  <th width="30%">Tipe Pembayaran:</th>
                  <td><?= $arrBayar["str_tipe_pembayaran"]; ?></td>
                </tr>
                <tr>
                  <th>Keterangan:</th>
                  <td><?= $arrBayar["keterangan"]; ?></td>
                </tr>
                <tr>
                  <th>Jumlah Bayar: </th>
                  <td>Rp. <?= number_format($arrBayar["jumlah_bayar"]); ?></td>
                </tr>
                <tr>
              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="">
              <table class="table table-bordered table-sm">
                <tr>
                  <th width="10%">#</th>
                  <th width="40%">Nama / Alamat</th>
                  <th width="30%">Kontak</th>
                  <th width="20%">Tagihan</th>
                </tr>
                <?php $totalTagihan = 0; ?>
                <?php foreach ($arrDetail as $key => $arrVal) { ?>
                  <tr>
                    <th><?= $key + 1 ?></th>
                    <td><?= $arrVal["nama"]; ?> / <?= $arrVal["alamat"]; ?></td>
                    <td><?= $arrVal["kontak"]; ?></td>
                    <td class="text-right">Rp. <?= number_format($arrVal["total_tagihan"]); ?></td>
                  </tr>

                  <?php $totalTagihan += $arrVal["total_tagihan"]; ?>
                <?php } ?>
                <tr>
                  <th colspan="3" class="text-center">Total</th>
                  <th class="text-right">Rp. <?= number_format($totalTagihan); ?></th>
                </tr>
              </table>
              <table class="table table-bordered table-sm">
                <tr>
                  <th>Keterangan</th>
                </tr>
                <tr>
                  <td height="100px"></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
</body>

</html>