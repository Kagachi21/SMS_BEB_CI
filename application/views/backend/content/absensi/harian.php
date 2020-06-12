
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
              Absensi Harian Untuk Kelas : </h6>
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
                  
                  <div class="form-group col-md-4">
                    <!-- <div class="row">
                        <div class="col-md-6"> -->
                          <input type="date" name="start_date" placeholder="tanggal awal" class="form-control">
                        <!-- </div> -->
                        <!-- <div class="col-md-6">
                          <input type="date" name="end_date"  placeholder="tanggal akhir" class="form-control">
                        </div> -->
                    <!-- </div> -->
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
                      <th>No</th>
                      <th>  NIS</th>
                      <th>Nama</th>
                     <th>Status</th>
                     <th>Tanggal</th>
                  </tr>

                </thead>
                <tbody>
                <?php
                $where = "";
                $d = $_POST;
                $no = 1;
                foreach ($ql as $data) {

                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data["nis"] ?></td>
                    <td><?= $data["nama"] ?></td>
                    
                    <td><?= $data['status_absen'] ?></td>
                    <td><?= $data['tanggal'] ?></td>
                </tr>
                    <?php $no++;} ?>
                    </tbody>
            </table>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->