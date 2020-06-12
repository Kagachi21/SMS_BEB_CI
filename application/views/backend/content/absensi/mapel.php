
        <!-- Begin Page Content -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <span class="h3 mb-0 text-gray-800">Absensi Mapel</span>

            <!-- button tambah -->

          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
              Absensi Untuk Kelas : </h6>

            </div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="row">
                  <div class="form-group col-md-2">
                    <select name="kelas" id="kelas_change" class="form-control">
                    <option value="">PIlih Kelas</option>
                      <?php
                      foreach ($kelas as $kl) {
                      ?>
                      <option value="<?= $kl['id'] ?>" jurusan="<?= $kl['tipe_kelas'] ?>"><?= $kl['nama'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <select name="mapel" id="mapel" class="form-control">
                    <option value=" ">PIlih Mata Pelajaran</option>
                      <?php
                      foreach ($mapel as $km) {
                      ?>
                      <option value="<?= $km['id'] ?>" jurusan='<?= $km['jurusan'] ?>'><?= $km['nama'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                          <input type="date" name="start_date" placeholder="tanggal awal" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <input type="date" name="end_date"  placeholder="tanggal akhir" class="form-control">
                        </div>
                    </div>
                  </div>
                  <div class="form-group col-md-1">
                        <input type="submit" name="cari" value="cari" class="btn btn-primary btn-block">
                  </div>
                </div>
              </form>
              <?php Response_Helper::part('alert');?>
            <h3>Absensi Mapel untuk tanggal <?= date("d-M-Y") ?></h3>
            <!-- <a href="form-mapel.php?type=add"><button class="btn btn-primary">Absen</button></a> -->
            <table class="table table-bordered dataTable" id="dataTable">
                <thead>
                  <tr>
                      <th><input type="checkbox" name="all"  id="check-all"></th>
                      <th>  NIS</th>
                      <th>Nama</th>
                      <?php
                      for ($i=1; $i <=10 ; $i++) {
                      ?>
                      <th>Jam <?= $i ?></th>
                      <?php } ?>
                  </tr>

                </thead>
                <tbody>
                <?php
                $where = "";
                $d = $_POST;
                foreach ($ql as $data) {

                ?>
                <tr>
                    <td><input type="checkbox"  id="Check1"></td>
                    <td><?= $data["nis"] ?></td>
                    <td><?= $data["nama"] ?></td>
                    <!-- <input type="text" name="kelas" hidden value="<?= $data["id_kelas"] ?>">
                    <input type="text" name="nis" hidden value="<?= $data["nis"] ?>">
                    <td><input type="radio" name="status_hadir" value="hadir" <?= ($data['status_absen'] == 'Hadir' ? 'checked' : '') ?> disabled><?= ($data['status_absen'] == 'Hadir' ? $data['tanggal'] : '') ?></td>
                    <td><input type="radio" name="status_hadir" value="izin" <?= ($data['status_absen'] == 'Izin' ? 'checked' : '') ?> disabled><?= ($data['status_absen'] == 'Izin' ? $data['tanggal'] : '') ?></td>
                    <td><input type="radio" name="status_hadir" value="sakit" <?= ($data['status_absen'] == 'Sakit' ? 'checked' : '') ?> disabled><?= ($data['status_absen'] == 'Sakit' ? $data['tanggal'] : '') ?></td>
                    <td><input type="radio" name="status_hadir" value="alpa" <?= ($data['status_absen'] == 'Alpha' ? 'checked' : '') ?> disabled><?= ($data['status_absen'] == 'Alpha' ? $data['tanggal'] : '') ?></td> -->
                    <?php
                    $ci=& get_instance();
                    $ci->load->database();
                    for ($i=1; $i <=10 ; $i++) {
                      // $qur = mysqli_query($koneksi, "SELECT * FROM tb_absen_pelajaran  WHERE jam=$i AND nis='$data[nis]' and id_mapel='$data[id_mapel]'");
                      if (isset($_POST['mapel'])) {
                        if ("" != trim($_POST['mapel'])) {
                          $qur = $ci->db->query("SELECT * FROM tb_absen_pelajaran  WHERE jam=$i AND nis='$data[nis]' and id_mapel='$data[id_mapel]'")->row_array();
                          // $qur = mysqli_query($koneksi, "SELECT * FROM tb_absen_pelajaran  WHERE jam=$i AND nis='$data[nis]' and id_mapel='$data[id_mapel]'");
                        }else{
                          $qur = $ci->db->query("SELECT * FROM tb_absen_pelajaran  WHERE jam=$i AND nis='$data[nis]'")->row_array();
                          // $qur = mysqli_query($koneksi, "SELECT * FROM tb_absen_pelajaran  WHERE jam=$i AND nis='$data[nis]'");
                        }
                      }else{
                        $qur = $ci->db->query("SELECT * FROM tb_absen_pelajaran  WHERE jam=$i AND nis='$data[nis]'")->row_array();
                        // $qur = mysqli_query($koneksi, "SELECT * FROM tb_absen_pelajaran  WHERE jam=$i AND nis='$data[nis]'");
                      }
                      // $d = mysqli_fetch_array($qur);
                      $d = $qur;
                    ?>
                    <th><?= $d['status_absen'] ?></th>
                    <?php } ?>
                </tr>
                    <?php } ?>
                    </tbody>
            </table>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->