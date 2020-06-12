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
                    <select name="kelas" id="" class="form-control">
                    <option value="">PIlih Kelas</option>
                      <?php
                      foreach ($kelas as $kl) {
                      ?>
                      <option value="<?= $kl['id'] ?>" jurusan="<?= $kl['tipe_kelas'] ?>"><?= $kl['nama'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <?php
                  if ($type == 'edit') {
                ?>
                <div class="form-group col-md-2">
                    <select name="mapel" id="" class="form-control">
                    <option value="">PIlih Mata Pelajaran</option>
                      <?php
                      foreach ($mapel as $m) {
                      ?>
                      <option value="<?= $m['id'] ?>"><?= $m['nama'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-4">
                        <input type="date" name="start_date" value="<?= date("Y-m-d") ?>" placeholder="tanggal awal" class="form-control">
                  </div>
                <?php
                  }
                  ?>
                  <div class="form-group col-md-1">
                        <input type="submit" name="cari" value="cari" class="btn btn-primary btn-block">
                  </div>
                </div>
              </form>
                <!-- <h3>Absensi Mapel untuk tanggal <?= date("d-M-Y") ?></h3> -->
                <?php
                if($type == 'add'){
                ?>
                <a href="<?= base_url('guru/absen/edit') ?>"><button class="btn btn-primary">Edit</button></a>
                <?php } ?>
            <?php
            $where = "";
            $d = $_POST;
              if (isset($_POST['cari'])) {
                $where = " WHERE ";
                $kelas = $d['kelas'];
                if ($kelas !='') {
                  $where .=" ts.id_kelas='$kelas' ";
                }
                if ($type == 'edit') {
                $mapel = $d['mapel'];
                    if ($mapel !='') {
                      if ($kelas !='') {
                        $where .=" AND ta.id_mapel='$mapel' ";
                      }else{
                        $where .=" ta.id_mapel='$mapel' ";
                      }
                    }
                $start_date = $d['start_date'];
                if ($kelas !='' || $mapel !='') {
                    $where .= " AND ta.tanggal like '%$start_date%' ";
                }else{
                    $where .= " ta.tanggal like '%$start_date%'  ";
                }
              }
            }

            ?>
            <form action="<?= base_url('guru/absen/'). ($type == 'add' ? 'simpan' : 'ubah') ?>" method="post">
            <div class="table-responsive">
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
                    if(isset($d['kelas'])){
                      //  echo "SELECT * FROM tb_siswa ts $where";
                      if($type == 'add'){
                          $ql = $this->db->query("SELECT * FROM tb_siswa ts $where")->result_array();
                      }else if($type == 'edit'){
                          $ql = $this->db->query("SELECT ts.nama, ts.nis, ta.tanggal,ta.status_absen, ta.id_kelas, tm.nama as mapel FROM tb_absen_pelajaran ta JOIN tb_siswa ts on ta.nis=ts.nis JOIN tb_mapel tm ON ta.id_mapel=tm.id $where GROUP BY ta.id_mapel")->result_array();
                      }
                      $no=1;
                      // echo "SELECT ts.nama, ts.nis, ta.tanggal,ta.status_absen FROM tb_absen_pelajaran ta JOIN tb_siswa ts on ta.nis=ts.nis $where";
                      foreach ($ql as $data) {

                  ?>
                  <tr>
                      <td><input type="checkbox"  id="Check1"></td>
                      <td><?= $data["nis"] ?></td>
                      <td><?= $data["nama"] ?></td>
                      <?php
                      for ($i=1; $i <=10 ; $i++) {
                        $d = $this->db->query("SELECT * FROM tb_absen_pelajaran  WHERE jam=$i AND nis='$data[nis]'")->row_array();
                      ?>
                      <th><?php
                      if ($d['status_absen'] == "") {
                          if ($type == 'add') {
                          ?>
                          <select name="status_absen[]" jam="<?=$i?>" id="status_absen" class="form-control status_absen<?= $i?>" style="width:150px!important">
                              <option value="">Pilih Status</option>
                              <option value="Hadir">Hadir</option>
                              <option value="Izin">Izin</option>
                              <option value="Sakit">Sakit</option>
                              <option value="Alpha">Alpha</option>
                          </select>
                          <input type="hidden" name="nis[]" value="<?= $data['nis'] ?>">
                          <input type="hidden" name="jam[]" value="<?= $i ?>">
                          <input type="hidden" name="id_kelas[]" value="<?= $data['id_kelas'] ?>">
                          <?php
                          }
                      }else{
                          if ($type == 'edit') {
                      ?>
                      <select name="status_absen[]" id="" class="form-control">
                              <option value="">Pilih Status</option>
                              <option value="Hadir" <?= $d['status_absen'] == 'Hadir' ? 'selected' :'' ?>>Hadir</option>
                              <option value="Izin" <?= $d['status_absen'] == 'Izin' ? 'selected' :'' ?>>Izin</option>
                              <option value="Sakit" <?= $d['status_absen'] == 'Sakit' ? 'selected' :'' ?>>Sakit</option>
                              <option value="Alpha" <?= $d['status_absen'] == 'Alpha' ? 'selected' :'' ?>>Alpha</option>
                          </select>
                          <input type="hidden" name="id[]" value="<?=$d['id']?>">
                          <input type="hidden" name="nis[]" value="<?= $data['nis'] ?>">
                          <input type="hidden" name="jam[]" value="<?= $i ?>">
                          <input type="hidden" name="id_kelas[]" value="<?= $data['id_kelas'] ?>">
                      <?php
                          }else{
                              echo $d['status_absen'];
                          }

                      }
                      ?></th>
                      <?php } ?>
                  </tr>
                      <?php }  }?>
                      </tbody>
              </table>
            </div>
            <div class="row">
              <div class="form-group col-md-2">
                  <?php
                  if($type == 'edit'){
                      ?>
                      <input type="hidden" name="mapel" value="<?= Input_Helper::postOrOr('mapel') ?>">
                      <?php
                  }else{
                  ?>
                  <select name="mapel" id="" class="form-control" required>
                      <option value="">PIlih Mata Pelajaran</option>
                      <?php
                      $q = $this->db->query("SELECT distinct(tm.nama), tm.id FROM tb_mapel tm JOIN tb_jadwal tj ON tm.id=tj.id_mapel WHERE tj.nip='$_SESSION[nip]'")->result_array();
                      foreach ($q as $kl) {
                      ?>
                      <option value="<?= $kl['id'] ?>"><?= $kl['nama'] ?></option>
                      <?php } ?>
                  </select>
                      <?php } ?>
              </div>
              <div class="form-group col-md-2">
                  <button id="semua" type="button" class="btn btn-success"> <i class="fa fa-check"></i> Hadir Semua</button>
              </div>
            </div>
            <button class="btn btn-primary" name="simpan"><?= ($type == 'add' ? 'simpan' : 'Ubah' ) ?></button>
            </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
