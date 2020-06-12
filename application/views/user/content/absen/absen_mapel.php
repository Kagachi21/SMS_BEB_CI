<!-- tampilan Profil -->
<div class="container-fluid p-0">

<section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="harian">
    <div class="w-100">
      <div class="container">
        <h2 class="mb-5">Absen Mapel</h2>
      <br>
      <br>
      <div class="form-group col-md-12">
      <form action="" method="POST">
          <div class="row">
              <div class="col-md-4">
                <input type="date" name="start_date" value="<?= date("Y-m-d") ?>" placeholder="tanggal awal" class="form-control">
              </div>
              <div class="col-md-4">
                <input type="date" name="end_date"  value="<?= date("Y-m-d", strtotime("+7days")) ?>" placeholder="tanggal akhir" class="form-control">
              </div>
              <div class="form-group col-md-3">
                    <input type="submit" name="cari" value="cari" class="btn btn-primary btn-block">
              </div>
          </div>
        </div>
      </form>
      <table width="100%" border="1" class="tabel" id="expandTab">
        <tr>
          <th>Mata Pelajaran</th>
          <?php
          for ($i=1; $i <=10 ; $i++) {
          ?>
          <th>Jam <?= $i ?></th>
          <?php } ?>
        </tr>
        <?php
        
      //   print_r($queryKelas);
      // echo "SELECT * FROM tb_absen_pelajaran tp where tp.nis='$nis'";
      foreach ($queryKelas as $k) {
        ?>
        <tr>
          <td><?= $k['mapel']  ?></td>
          <?php
          for ($i=1; $i <=10 ; $i++) {
            $d = $this->db->query("SELECT * FROM tb_absen_pelajaran  WHERE jam=$i AND nis='$k[nis]' and id_mapel='$k[id_mapel]'")->row_array();
          ?>
          <th><?= $d['status_absen'] ?></th>
          <?php } ?>
        </tr>
      <?php } ?>
      </table>
      <br>
    </div>
    </div>
  </section>
</div>
<!-- tampilan Profil -->
