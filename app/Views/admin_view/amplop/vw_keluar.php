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
      <h1 class="display-4 text-center mt-2">Amplop Keluar</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url("/admin/amplop"); ?>">Daftar Amplop</a></li>
          <li class="breadcrumb-item active" aria-current="page">Amplop Keluar</li>
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
              | <span class="text-right">Total Amplop: <strong>{{amplop.length}} Amplop</strong></span>
            </div>
            <div class="card-body">
              <div class="form-group">
                <input v-model="nama" type="text" class="form-control" placeholder="Nama Panitia">
              </div>
              <div class="form-group">
                <textarea v-model="keterangan" type="text" class="form-control" placeholder="Keterangan"></textarea>
              </div>
              <table class="table table-sm table-bordered">
                <tr>
                  <th class="text-center" width="10%">No.</th>
                  <th class="text-center" width="70%">Amplop</th>
                  <th class="text-center" width="20%">Action</th>
                </tr>
                <tr v-if="amplop.length == 0">
                  <td colspan="3" class="text-center"> Belum Ada Data Amplop </td>
                </tr>
                <tr v-else v-for="(item, index) in amplop">
                  <td class="text-center">{{ count_start + index }}</td>
                  <td>
                    Amplop ke {{ count_start + index }}
                  </td>
                  <td class="text-center">
                    <button v-on:click="rmv_amplop(item)" type="button" class="btn btn-sm btn-outline-danger">&times;</button>
                  </td>
                </tr>
              </table>
              <div class="form-group">
                <button v-on:click="submit_data()" type="button" class="btn btn-sm btn btn-primary">
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