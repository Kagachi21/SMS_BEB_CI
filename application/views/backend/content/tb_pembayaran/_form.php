<div class="container-fluid">
          <!-- Page Heading -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary datatable">Pembayaran</h6>
            </div>
            <div class="card-body">
            <div class="container" style="margin-top:12px;">
          <!-- DataTales Example -->
              <form method="post" action="" enctype="multipart/form-data">
                      <div class="row">
                      <?php 
                      if($type != "Ubah"){?>
                          <div class="form-group col-md-6">
                              <label for="">kelas</label>
                              <?php 
                              $kl = Input_Helper::postOrOr('id_kelas');
                              ?>
                              <select id="kelas" class="form-control">
                                  <option value="">Pilih Kelas</option>
                                  <?php
                                  foreach ($kelas as $key) {
                                  ?>
                                  <option <?= ($kl == $key['id'] ? 'selected' : '') ?> value="<?= $key['id'] ?>"><?= $key['nama'] ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                          <div class="form-group col-md-6">
                              <label for="">Siswa</label>
                              <?php 
                              $si = Input_Helper::postOrOr('nis', $data['nis']);
                              ?>
                              <select name="nis" id="siswa" class="form-control" required>
                                  <option value="">Pilih Siswa</option>
                                  <?php
                                  foreach ($siswa as $key) {
                                  ?>
                                  <option <?= ($si == $key['nis'] ? 'selected' : '') ?> value="<?= $key['nis'] ?>"><?= $key['nama'] ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                                  <?php } ?>
                          <div class="form-group col-md-6">
                              <label for="">Jenis</label>
                              <?php 
                              $jn = Input_Helper::postOrOr('jenis_pembayaran', $data['jenis_pembayaran']);
                              ?>
                              <select name="jenis_pembayaran" id="" class="form-control">
                                  <option value="">Pilih Jenis</option>
                                  <option <?= ($jn == 1 ? "selected" : "") ?> value="1">Spp</option>
                                  <option <?= ($jn == 2 ? "selected" : "") ?> value="2">Study Tour</option>
                                  <option <?= ($jn == 3 ? "selected" : "") ?> value="3">Lain Lain</option>
                              </select>
                          </div>
                          
                          <div class="form-group col-md-6">
                              <label for="">Jumlah Tagihan</label>
                              <input type="number" min="1" name="jml_tagihan" placeholder="Masukkan Tagihan" class="form-control" value="<?= Input_Helper::postOrOr('jml_tagihan', $data['jml_tagihan']) ?>">
                          </div>
                          <div class="form-group col-md-6">
                              <label for="">Deskripsi</label>
                              <textarea name="deskripsi" class="form-control" id="" cols="30" rows="6"><?= Input_Helper::postOrOr('deskripsi', $data['deskripsi']) ?></textarea>
                          </div>
                          <div class="form-group col-md-12">
                              <input type="submit"  value="<?= $type ?>" class="btn btn-primary btn-block">
                          </div>
                      </div>
                  </form>
                </div>
            </div>
          </div>

        </div>