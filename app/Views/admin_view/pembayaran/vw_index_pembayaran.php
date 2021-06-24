<?= $this->extend('layout/admin',) ?>

<?= $this->section('content') ?>
<style>
  .hide {
    display: none;
  }
</style>
<div id="data-vue">
  <section>
    <div class="container">
      <h1 class="display-4 text-center mt-2">Pembayaran</h1>
      <div class="card">
        <div class="card-header">
          Daftar Transaksi
        </div>
        <div class="card-body">
          <div class="form-row ">
            <div class="col-sm-9">
              <a href="<?= base_url("/admin/pembayaran/form"); ?>" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> Tambah</a>
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
          <table class="table table-bordered table-condensed table-sm">
            <tr>
              <th width="10%">No.</th>
              <th width="20%">Tanggal</th>
              <th width="35%">Ket.</th>
              <th width="10%">Peserta</th>
              <th width="25%">Total Trf.</th>
            </tr>
            <tr v-for="(item, index) in items">
              <td>{{ count_start + index }}</td>
              <td>{{item.created_at}}</td>
              <td>{{item.keterangan}}</td>
              <td>{{item.jumlah_peserta}} org</td>
              <td>{{item.jumlah_bayar}}</td>
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
</div>


<?= $this->endSection() ?>