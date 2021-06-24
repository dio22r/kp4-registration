<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>

<div id="data-vue">
  <section>
    <div class="container">
      <h1 class="display-4 text-center mt-2">Pembayaran</h1>
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              Form Transaksi
            </div>
            <div class="card-body">
              <form id="form" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Tipe Pembayaran</label>
                  <div class="col-sm-3">
                    <select class="form-control" name="tipe_pembayaran">
                      <option value="1">Transfer</option>
                      <option value="2">Tunai</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Keterangan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="keterangan" v-model="m_keterangan">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label">Jumlah Bayar</label>
                  <div class="col-sm-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Rp. </span>
                      </div>
                      <input type="text" class="form-control" name="jumlah_bayar" v-model="m_jumlah_bayar">
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label">Bukti Pembayaran</label>
                  <div class="col-sm-6">
                    <input type="file" class="form-control-file" name="file_bukti_pembayaran">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label">Pilih Peserta</label>
                  <div class="col-sm-6">
                    <select class="form-control" v-model="m_peserta">
                      <option value="">-- Pilih Peserta --</option>
                      <option v-for="peserta in data_peserta" v-bind:value="peserta.id">{{peserta.nama}} / {{peserta.alamat}}</option>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <button type="button" class="btn btn-warning" v-on:click="add_peserta()">
                      <i class="bi bi-person-plus-fill"></i> Tambah
                    </button>
                  </div>

                </div>

                <table class="table table-sm table-bordered">
                  <tr>
                    <th width="7%" class="text-center">#</th>
                    <th width="35%">Nama/Alamat</th>
                    <th width="28%">Kontak</th>
                    <th width="25%">Tagihan</th>
                    <th width="5%" class="text-center">&times;</th>
                  </tr>
                  <tr v-for="(item, index) in table_peserta">
                    <td class="text-center">{{index + 1}}</td>
                    <td>{{item.nama}} / {{item.alamat}}</td>
                    <td width="28%">{{item.kontak}}</td>
                    <td width="25%">{{item.total_tagihan}}</td>
                    <td width="5%" class="text-center">
                      <button v-on:click="remove_data(item.id)" type="button" class="btn btn-sm btn-outline-danger"> &times; </button>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="3" class="text-right">Total Tagihan</th>
                    <th class="text-right">Rp. {{total_tagihan}}</th>
                    <th>,-</th>
                  </tr>
                </table>
                <div class="form-group row">
                  <div class="col-sm-9 offset-sm-3 text-right">
                    <button v-on:click="click_bayar($event)" type="submit" class="btn btn-primary">
                      <i class="bi bi-cart-check"></i> Bayar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  var base_config = <?= json_encode($arrJsConfig) ?>
</script>


<?= $this->endSection() ?>