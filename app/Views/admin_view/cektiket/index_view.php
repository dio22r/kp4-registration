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
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              Scan Barcode <i class="bi bi-upc-scan"></i>
            </div>
            <div class="card-body">
              <video id="preview" width="100%"></video>
              <div v-if="detail === false" class="alert alert-info">
                Silahkan Scan QRCode anda.
              </div>
              <div v-else-if="detail.status == 1" class="alert alert-success">
                {{detail.msg}} <strong>{{detail.arrData.nama}}</strong>
              </div>
              <div v-else class="alert alert-danger">
                <p v-if="detail.arrData !== false">
                  {{detail.msg}} (<strong>{{detail.arrData.nama}}</strong>)
                </p>
                <p v-else>
                  {{detail.msg}}
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              Daftar Hadir
              | <span class="text-right">Total Kehadiran: <strong>{{total_data}} Peserta</strong></span>
            </div>
            <div class="card-body">

              <table class="table table-sm table-bordered">
                <tr>
                  <th class="text-center" width="10%">No.</th>
                  <th class="text-center" width="70%">Nama / Alamat</th>
                  <th class="text-center" width="20%">Status</th>
                </tr>
                <tr v-for="(item, index) in items">
                  <td class="text-center">{{ count_start + index }}</td>
                  <td>
                    <strong>{{item.nama}}</strong> <br />
                    {{item.alamat}}
                  </td>
                  <td class="text-center">

                    <span v-if="item.status_lunas == 1" class="badge badge-success">Lunas</span>
                    <span v-if="item.status_lunas == 0" class="badge badge-warning">Belum Lunas</span>
                    <span v-if="item.status_lunas == -1" class="badge badge-danger">Dihapus</span>

                  </td>
                </tr>
              </table>

              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item" v-bind:class="[ current_page == 1 ? 'disabled' :'' ]"><a class="page-link prev" v-on:click="pagination(-1, $event)" href="#">Prev.</a></li>
                  <li class="page-item"><a class="page-link" v-on:click="pagination(-2, $event)" v-bind:class="[ current_page - 2 <= 0 ? 'hide' : '' ]" href="#">{{ current_page - 2 }}</a></li>
                  <li class="page-item"><a class="page-link" v-on:click="pagination(-1, $event)" v-bind:class="[ current_page - 1 <= 0 ? 'hide' : '' ]" href="#">{{ current_page - 1 }}</a></li>
                  <li class="page-item active"><a class="page-link" href="#">{{ current_page }}</a></li>
                  <li class="page-item"><a class="page-link" v-on:click="pagination(1, $event)" v-bind:class="[ current_page + 1 > total_page ? 'hide' : '' ]" href="#">{{ current_page + 1 }}</a></li>
                  <li class="page-item"><a class="page-link" v-on:click="pagination(2, $event)" v-bind:class="[ current_page + 2 > total_page ? 'hide' : '' ]" href="#">{{ current_page + 2 }}</a></li>
                  <li class="page-item" v-bind:class="[ current_page == total_page ? 'disabled' :'' ]"><a class="page-link next" v-on:click="pagination(1, $event)" href="#">Next</a></li>
                </ul>
              </nav>
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