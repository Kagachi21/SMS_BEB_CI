        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary datatable">Surat Keterangan</h6>

            </div>
            <div class="card-body">
            <form action="" method="POST">
                <div class="row">
                  <div class="form-group col-md-2">
                    <select name="kelas" id="" class="form-control">
                    <option value="">PIlih Kelas</option>
                      <?php
                      foreach ($kelas as $kl) {
                      ?>
                      <option value="<?= $kl['id'] ?>" jurusan="<?= $kl['tipe_kelas'] ?>"><?= $kl['nama'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-2">
                    <select name="jenis" id="" class="form-control">
                      <option value="">PIlih Jenis</option>
                      <option value="Ijin">Ijin</option>
                      <option value="Sakit">Sakit</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                          <input type="date" name="start_date" value="<?= date("Y-m-d") ?>" placeholder="tanggal awal" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <input type="date" name="end_date"  value="<?= date("Y-m-d", strtotime("+7days")) ?>" placeholder="tanggal akhir" class="form-control">
                        </div>
                    </div>
                  </div>
                  <div class="form-group col-md-1">
                        <input type="submit" name="cari" value="cari" class="btn btn-primary btn-block">
                  </div>
                </div>
              </form>
              <div class="table-responsive">
                  <table class="table table-striped" width="100%">
                     <thead>
                        <tr>
                              <th>Nama</th>
                              <th>Foto</th>
                              <th>Kelas</th>
                              <th>Tanggal</th>
                              <th>Keterangan</th>
                              <!-- <th >
                              <center><span>Action</span></center>
                            </th> -->
                        </tr>
                     </thead>
                     <tbody>
                  <?php
                  // Load file koneksi.php
                  foreach ($list as $data) {
                    ?>
                    <tr>
                      <td><?=$data['nama']?></td>
                      <td><a class="image-link" href='<?= base_url() ?>foto/surat/<?= $data['foto']?>'><img src='<?= base_url() ?>foto/surat/<?= $data['foto']?>' width='100' height='100'></a></td>
                      <td><?=$data['kelas']?>"</td>
                      <td><?=$data['tanggal']?>"</td>
                      <td><?=$data['jenis']?>"</td>
                      <td>
                      <!-- <a href="<?= base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/delete/".$data['id'] ?>"
                            onclick="return confirm('Anda yakin ingin menghapus data?');"><button
                              class="btn btn-danger btn-sm" type="button" name="delete">Delete</button></a> -->
                      </td>
                      </tr>
                      <?php
                  }
                  ?>
                  </tbody>
                  </table>
                </table>
              </div>
            </div>
          </div>

        </div>