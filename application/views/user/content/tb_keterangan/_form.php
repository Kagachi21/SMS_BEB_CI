<div class="container-fluid p-0">

<section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="harian">
    <div class="w-100">
      <div class="container">
        <h2 class="mb-5">Form Surat Keterangan</h2>
          <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="">Jenis</label>
                  <select name="jenis" id="" class="form-control" required>
                      <option value="">Pilih jenis surat</option>
                      <option value="Ijin">Ijin</option>
                      <option value="Sakit">Sakit</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="">Foto</label><br>
                  <input type="file" name="foto" required>
                  <input type="hidden" name="nis" value="<?=$nis?>">
              </div>
              <div class="form-group">
                  <input type="submit" value="simpan" class="btn btn-info btn-block">
              </div>
          </form>
      <br>
    </div>
    </div>
  </section>
</div>