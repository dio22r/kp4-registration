<?= $this->extend('layout/admin',) ?>

<?= $this->section('content') ?>

<style>
  .hide {
    display: none;
  }
</style>

<div id="app-vue">

  <section id="content">

    <div class="container">
      <h1 class="display-4 text-center mt-2">Check Tiket</h1>

      <nav class="navbar navbar-expand navbar-light bg-light mb-3">

        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="<?= base_url("admin/kegiatan"); ?>">Kegiatan <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url("admin/cek-tiket"); ?>">Absensi</a>
          </li>
        </ul>
      </nav>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Daftar Kegiatan
            </div>
            <div class="card-body">

              <a href="<?= base_url("admin/kegiatan/form"); ?>" class="btn btn-primary btn-sm my-2">
                Input Kegiatan
              </a>

              <table class="table table-sm table-bordered">
                <tr>
                  <th class="text-center" width="10%">No.</th>
                  <th class="text-center" width="35%">Kegiatan</th>
                  <th class="text-center" width="20%">Tempat</th>
                  <th class="text-center" width="20%">Waktu</th>
                  <th class="text-center" width="15%">Action</th>
                </tr>
                <?php foreach ($arrData as $key => $arrVal) { ?>
                  <tr class="<?= $arrVal["status"] ? "bg-light" : "" ?>">
                    <td class="text-center"><?= $key + 1 ?></td>
                    <td>
                      <?= $arrVal["nama_kegiatan"]; ?>
                      <?php if ($arrVal["status"]) { ?>
                        <span class="text-success">(Aktif)</span>
                      <?php } ?>
                    </td>
                    <td><?= $arrVal["tempat"]; ?></td>
                    <td><?= $arrVal["date_start"]; ?> <?= $arrVal["time_start"]; ?></td>
                    <td>
                      <a href="<?= base_url("/admin/kegiatan/form/" . $arrVal["id"]); ?>" class="badge badge-success">
                        Edit
                      </a>
                      <a href="<?= base_url("/admin/kegiatan/form/" . $arrVal["id"]); ?>" class="badge badge-danger">
                        delete
                      </a>
                    </td>
                  </tr>
                <?php } ?>
                <?php if (!$arrData) { ?>
                  <tr>
                    <td class="text-center" colspan="5">Belum Ada Data</td>
                  </tr>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>


  <div class="modal fade" id="detail-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Peserta!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div v-if="retrieve_process">
          <div class="modal-body">


            <table class="table table-sm table-bordered">
              <tr>
                <th width="30%">Nama</th>
                <td width="70%">{{ data_peserta.nama }}</td>
              </tr>
              <tr>
                <th>Alamat</th>
                <td>{{ data_peserta.alamat }}</td>
              </tr>
              <tr>
                <th>Kontak</th>
                <td>{{ data_peserta.kontak }}</td>
              </tr>
              <tr>
                <th>Tanggal Daftar</th>
                <td>{{ data_peserta.created_at }}</td>
              </tr>
              <tr>
                <th>Total Tagihan</th>
                <td>{{ data_peserta.total_tagihan }}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  <span v-if="data_peserta.status_lunas == 1" class="badge badge-success">Lunas</span>
                  <span v-if="data_peserta.status_lunas == 0" class="badge badge-warning">Belum Lunas</span>
                  <span v-if="data_peserta.status_lunas == -1" class="badge badge-danger">Dihapus</span>
                  |
                  <a v-on:click="click_bayar(data_peserta.id, $event)" v-if="data_peserta.status_lunas == 0" class="badge badge-primary"><i class="bi bi-cart-check-fill"></i> Bayar!</a>
                  <a v-on:click="click_edit(data_peserta.id, $event)" v-else class="badge badge-warning"><i class="bi bi-pencil-square"></i> Edit!</a>
                </td>
              </tr>
              <tr>
                <th>QRCode</th>
                <td>
                  <img v-if="data_peserta.qrcode_url != false" v-bind:src="data_peserta.qrcode_url" width="250px" />
                  <span v-else>Belum ada data, Harap lakukan pelunasan!</span>
                </td>
              </tr>
            </table>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" v-on:click="action_delete(data_peserta.id, $event)">
              <i class="bi bi-trash"></i> Hapus
            </button>
            <button id="btn-close" type="button" class="btn btn-sm btn-primary btn-close" data-dismiss="modal">
              <i class="bi bi-check-circle"></i> Oke !
            </button>
          </div>

        </div>
        <div v-else>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>