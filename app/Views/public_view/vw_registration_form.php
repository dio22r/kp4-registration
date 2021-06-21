<?= $this->extend('layout/default',) ?>

<?= $this->section('content') ?>

<div id="data-vue">
  <section id="section-registration-form">
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-8 border p-sm-5 p-2">
          <h1 class="text-center">K P 4</h1>
          <p class="text-center"><img src="<?= base_url('/assets/images/maxresdefault.jpg') ?>" style="width:200px;" /></p>

          <h3 class="text-center">PENDAFTARAN</h3>
          <h6 class="text-center">Perayaan 100 Tahun GPdI</h6>

          <hr />
          <div v-if="alert_show" class="alert alert-danger" role="alert">
            {{ alert_msg }}
          </div>

          <form id="form-data" method="POST" action="<?= base_url("/registration"); ?>" v-on:submit='save($event)'>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Peserta</label>
              <input type="text" class="form-control" name="form_nama" placeholder="Nama Sesuai KTP">
              <small id="emailHelp" class="form-text text-muted">Harap mengisi nama sesuai KTP untuk diverifikasi.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Alamat</label>
              <input type="text" class="form-control" name="form_alamat" placeholder="Alamat Anda">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Kontak</label>
              <input type="text" class="form-control" name="form_kontak" placeholder="Email / Telp. / WA">
            </div>

            <div class="form-group">
              <div class="g-recaptcha" data-sitekey="6Ldn_T0bAAAAAJ91SqDahIiePHe9a-K_DD4Yvx2j"></div>
            </div>

            <div class="form-group">
              <button type="button" v-on:click='save($event);' class="btn btn-primary"><i class="bi bi-envelope-fill"></i> Simpan</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>

  <div class="modal" tabindex="-1" style="display:none;background-color:rgba(0,0,0,0.5)">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Selamat!</h5>
        </div>
        <div class="modal-body">
          <p>{{ alert_msg }}</p>
          <ul>
            <li>Nama: {{ data_peserta.nama }}</li>
            <li>Alamat: {{ data_peserta.alamat }}</li>
            <li>Kontak: {{ data_peserta.kontak }}</li>
          </ul>
          <p>Mohon Lakukan Verifikasi Pembayaran dengan mengirim bukti struk Pembayaran Melalui pesan WA.</p>
        </div>
        <div class="modal-footer">
          <button type="button" v-on:click="document.location.reload(true)" class="btn btn-primary">
            <i class="bi bi-check-circle"></i> Oke !
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>