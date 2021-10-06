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
      <h1 class="display-4 text-center mt-2">Daftar Amplop</h1>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Table Amplop <i class="bi bi-upc-scan"></i>
            </div>
            <div class="card-body">
              <div class="row  mb-3">
                <div class="col-md-6">
                  <a target="_blank" class="btn btn-sm btn-outline-secondary" href="<?= base_url("/admin/amplop/print-amplop") ?>">
                    <i class="bi bi-printer"></i> Print QRCode
                  </a>

                  <a class="btn btn-sm btn-outline-primary" href="<?= base_url("/admin/amplop/keluar") ?>">
                    <i class="bi bi-box-arrow-up-right"></i> Amplop Keluar
                  </a>
                  <a class="btn btn-sm btn-outline-success" href="<?= base_url("/admin/amplop/masuk") ?>">
                    <i class="bi bi-box-arrow-in-down-left"></i> Amplop Masuk
                  </a>

                </div>
                <div class="col-md-6">
                  <div class="form-row justify-content-end">
                    <div class="col-sm-6">
                      <div class="input-group input-group-sm">
                        <input type="text" v-model="search" v-on:keyup.enter="on_search($event)" class="form-control" placeholder="Cari Data" aria-label="Cari Data" aria-describedby="button-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-primary" v-on:click="on_search($event)" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <table class="table table-bordered table-hover table-sm">
                <tr>
                  <th width="10%">No.</th>
                  <th width="40%">Penanggung Jawab</th>
                  <th width="20%">Tanggal</th>
                  <th width="15%">Jumlah</th>
                  <th width="15%">Status</th>
                </tr>
                <tr v-if="items.length == 0">
                  <td class="text-center" colspan="5">
                    Belum ada data Amplop.
                  </td>
                </tr>
                <tr v-for="(item, index) in items">
                  <td>{{ count_start + index }}</td>
                  <td>
                    {{item.nama}}
                  </td>
                  <td>{{item.created_at}} / <br /> {{item.tgl_kembali}}</td>
                  <td>{{item.jumlah}}</td>
                  <td>
                    <span v-if="item.status_kembali == 1" class="badge badge-success">Masuk</span>
                    <span v-if="item.status_kembali == 0" class="badge badge-light">Belum</span>
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


</div>

<?= $this->endSection() ?>