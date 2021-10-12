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
      <div class="card">
        <div class="card-header">
          Form Panitia / Tamu
        </div>
        <div class="card-body">

          <form id="form-data" method="POST" action="<?= $actionUrl; ?>">

            <div class="form-group">
              <label for="exampleInputPassword1">Status</label>
              <select name="type" class="form-control">
                <?php foreach ([1 => "Panitia", 2 => "Tamu"] as $key => $val) { ?>
                  <?php if (isset($arrData["type"]) && $arrData["type"] == $key) { ?>
                    <option value="<?= $key ?>" selected><?= $val ?></option>
                  <?php } else { ?>
                    <option value="<?= $key ?>"><?= $val ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?= isset($arrData["nama"]) ? $arrData["nama"] : "" ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Alamat</label>
              <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?= isset($arrData["alamat"]) ? $arrData["alamat"] : "" ?>">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Kontak</label>
              <input type="text" class="form-control" name="kontak" placeholder="Kontak" value="<?= isset($arrData["kontak"]) ? $arrData["kontak"] : "" ?>">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Keterangan</label>
              <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="<?= isset($arrData["keterangan"]) ? $arrData["keterangan"] : "" ?>">
            </div>


            <div class="form-group">
              <a href="<?= base_url("admin/panitia"); ?>" class="btn btn-light">
                Kembali
              </a>

              <button type="submit" class="btn btn-primary"><i class="bi bi-envelope-fill"></i> Simpan</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </section>

</div>

<?= $this->endSection() ?>