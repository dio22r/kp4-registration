<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>

<div id="data-vue">
  <section>
    <div class="container">
      <h1 class="display-4 text-center mt-2">Pembayaran</h1>

      <div class="card">
        <div class="card-header">
          Detail Pembayaran
        </div>

        <div class="card-body">

          <div class="row">
            <div class="col-12">
              <div>
                <a href="<?= base_url("/admin/pembayaran"); ?>" class="btn btn-sm btn-info">
                  <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
                <a href="<?= base_url("/admin/pembayaran/nota/" . $arrBayar["id_pembayaran"]); ?>" target="_blank" class="btn btn-sm btn-light">
                  <i class="bi bi-printer-fill"></i> Print
                </a>
              </div>

              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-7 mt-3 mb-3">

                  <table class="table table-sm table-borderless">
                    <tr>
                      <th width="35%">Tanggal Konfirmasi:</th>
                      <td><?= $arrBayar["created_at"]; ?></td>
                    </tr>
                    <tr>
                      <th>Tipe Pembayaran:</th>
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
                <div class="col-sm-5 mt-3 mb-3">
                  <img width="100%" src="<?= base_url("/assets/images/bukti/" . $arrBayar["bukti_transaksi"]); ?>" ; </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>

<?= $this->endSection() ?>