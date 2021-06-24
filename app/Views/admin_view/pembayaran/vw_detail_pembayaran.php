<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>

<div id="data-vue">
  <section>
    <div class="container">
      <h1 class="display-4 text-center mt-2">Pembayaran</h1>

      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-12">
              <div>
                <a href="<?= base_url("/admin/pembayaran"); ?>" class="btn btn-sm btn-light">
                  <i class="bi bi-arrow-left-circle-fill"></i> Kembali
                </a>
              </div>

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
                        <td><?= $arrBayar["tipe_pembayaran"]; ?></td>
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?= $this->endSection() ?>