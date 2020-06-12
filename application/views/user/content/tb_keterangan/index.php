<div class="container-fluid p-0">

  <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="harian">
      <div class="w-100">
        <div class="container">
          <h2 class="mb-5">Keterangan</h2>
        <br>
        <br>
            <a href="<?= base_url($this->uri->segment(1)."/".$this->uri->segment(2)."/add") ?>">Tambah </a>
        <table class="table table-striped" class="tabel" id="expandTab">
          <tr>
            <th>Tanggal</th>
            <th>Jenis</th>
            <th>Foto</th>
            <th>Aksi</th>
          </tr>
          <?php 
            foreach ($queryKelas as $k) {
          ?>
          <tr style="text-align:center">
            <td><?= $k['tanggal']  ?></td>
            <td><?= $k['jenis']  ?></td>
            <td ><img src="../../foto/surat/<?= $k['foto']  ?>" style="width:100px" alt=""></td>
            <th><a class="hapus" href="<?= base_url('user/keterangan/delete/'.$k['id']) ?>"><button class="btn btn-danger">Hapus</button></a></th>
          </tr>
        <?php } ?>
        </table>
        <br>
      </div>
      </div>
    </section>
  </div>