<?= $this->extend('layout/default',) ?>

<?= $this->section('content') ?>

<div id="data-vue">
  <section id="section-registration-form">
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-8 border p-sm-5 p-2">
          <h1 class="text-center">K P 4</h1>
          <p class="text-center"><img src="<?= base_url('/assets/images/maxresdefault.jpg') ?>" style="width:200px;" /></p>

          <h3 class="text-center">AMPLOP</h3>
          <h6 class="text-center">Perayaan 100 Tahun GPdI</h6>

          <hr />

          <?php if ($arrRes["status"]) { ?>
            <table class="table table-bordered">
              <tr>
                <th width="40%">ID Amplop</th>
                <td><?= $arrRes["arrData"]["amplop_key"] ?></td>
              </tr>
              <tr>
                <th>Penanggung Jawab</th>
                <td><?= $arrRes["arrData"]["nama"] ?></td>
              </tr>
              <tr>
                <th>Tanggal dibuat</th>
                <td><?= $arrRes["arrData"]["created_at"] ?></td>
              </tr>
              <tr>
                <th>Keterangan</th>
                <td><?= $arrRes["arrData"]["keterangan"] ?></td>
              </tr>

              <?php if ($arrRes["arrData"]["status_kembali"]) { ?>
                <tr>
                  <th>Jumlah </th>
                  <td>
                    Rp. <?= number_format($arrRes["arrData"]["jumlah"]) ?>
                    ( <?= $arrRes["arrData"]["tgl_kembali"] ?> )
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <th>Status</th>
                <td>
                  <?php if ($arrRes["arrData"]["status_kembali"]) { ?>
                    <span class="badge badge-success">Sudah Masuk</span>
                  <?php } else { ?>
                    <span class="badge badge-light">Sedang dijalankan</span>
                  <?php } ?>
                </td>
              </tr>
            </table>
          <?php } else { ?>
            <div class="alert alert-danger">
              Maaf! Data tidak ditemukan. Amplop anda tidak valid.
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>

</div>
<?= $this->endSection() ?>