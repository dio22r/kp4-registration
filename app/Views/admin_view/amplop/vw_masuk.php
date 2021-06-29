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
      <h1 class="display-4 text-center mt-2">Amplop Masuk</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url("/admin/amplop"); ?>">Daftar Amplop</a></li>
          <li class="breadcrumb-item active" aria-current="page">Amplop Masuk</li>
        </ol>
      </nav>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              Scan Barcode <i class="bi bi-upc-scan"></i>
            </div>
            <div class="card-body">
              <video id="preview" width="100%"></video>
              <div class="alert" v-bind:class="alertclass">
                {{alertinfo}}
              </div>

              <ul>
                <li v-for="(itemCam, index) in cameras">
                  <button v-on:click="click_camera(index)" type="button" class="btn btn-light btn-sm">{{itemCam.name}}</button>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              Data Amplop
            </div>
            <div class="card-body">

              <table class="table table-sm table-bordered">
                <tr>
                  <th width="40%">Penangung Jawab :</th>
                  <td>{{dataAmplop.nama}}</td>
                </tr>
                <tr>
                  <th>Keterangan</th>
                  <td>
                    {{dataAmplop.keterangan}}
                  </td>
                </tr>
              </table>

              <div class="form-group">
                <input v-model="jumlah" type="text" class="form-control" placeholder="Jumlah (Contoh: 500000)">
              </div>
              <div class="form-group">
                <textarea v-model="ket_kembali" type="text" class="form-control" placeholder="Keterangan"></textarea>
              </div>
              <div class="form-group">
                <button v-on:click="submit_data()" type="button" class="btn btn-sm btn btn-primary" v-bind:class="{ disabled: !submitStatus }">
                  <i class="bi bi-envelope-fill"></i> Simpan
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>


</div>

<?= $this->endSection() ?>