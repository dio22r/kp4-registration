<?= $this->extend('layout/admin',) ?>

<?= $this->section('content') ?>

<style>
  .hide {
    display: none;
  }
</style>

<div id="data-vue">

  <section id="content">

    <div class="container">
      <h1 class="display-4 text-center mt-2"> Daftar Panitia</h1>
      <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a class="nav-link" v-on:click="tab_click(1, $event)" v-bind:class="[type == 1 ? 'active' : '']" href="#">Panitia</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" v-on:click="tab_click(2, $event)" v-bind:class="[type == 2 ? 'active' : '']" href="#">Tamu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" v-on:click="tab_click(0, $event)" v-bind:class="[type == 0 ? 'active' : '']" href="#"><i class="bi bi-trash-fill"></i> Dihapus </a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="form-row">
            <div class="col-sm-9 text-left">
              <a class="btn btn-success btn-sm" href="<?= base_url("/admin/panitia/form"); ?>">Tambah Data</a>
            </div>

            <div class="col-sm-3">
              <div class="input-group input-group-sm mb-3">
                <input type="text" v-model="search" v-on:keyup.enter="on_search($event)" class="form-control" placeholder="Cari Data" aria-label="Cari Data" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" v-on:click="on_search($event)" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <table id="data-view" class="table table-sm table-bordered table-hover" data-url="<?= $api_url ?>">
            <tr>
              <th width="10%">No.</th>
              <th width="35%">Nama</th>
              <th width="25%">Ket.</th>
              <th width="20%">Kontak</th>
              <th width="10%">Tipe</th>
            </tr>
            <tr v-for="(item, index) in items" data-toggle="modal" data-target="#detail-modal" v-on:click="view_detail(item.id, $event)">
              <td>{{ count_start + index }}</td>
              <td class="text-left">{{ item.nama }}</td>
              <td class="text-left">{{ item.keterangan }}</td>
              <td>{{ item.kontak }}</td>
              <td>

                <span v-if="item.type == 1" class="badge badge-warning">Panitia</span>
                <span v-if="item.type == 2" class="badge badge-danger">Tamu</span>
                <span v-if="item.type == 3" class="badge badge-primary">Peserta</span>

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
                <th>Keterangan</th>
                <td>{{ data_peserta.keterangan }}</td>
              </tr>
              <tr>
                <th>QRCode</th>
                <td>
                  <img v-if="data_peserta.qrcode_url != false" v-bind:src="data_peserta.qrcode_url" width="250px" />
                  <span v-else>Belum ada data, Harap lakukan pelunasan!</span>
                  <p v-if="data_peserta.qrcode_url != false" class="center">
                    <a class="btn btn-outline-success btn-sm" target="_blank" v-bind:href="data_peserta.idcard_url">
                      <i class="bi bi-printer"></i> Print Kartu
                    </a>
                  </p>
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