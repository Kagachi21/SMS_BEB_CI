
<!-- tampilan Profil -->
  <div class="container-fluid p-0">

  <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="harian">
      <div class="w-100">
        <h2 class="mb-5">Catatan Pelanggaran</h2>
        <?php
        
        $no = 1;
        $jenis = ['', 'sedang', 'berat', 'sangat berat'];
        foreach ($querykasus as $datakasus) { ?>
        <button class="accordion">Kasus <?php echo $no; ?></button>
        <div class="panel">
          <br>
          <p>Tanggal : <?php echo $datakasus['tanggal']; ?></p>
          <p>Kasus : <?php echo $jenis[$datakasus['jenis']]; ?></p>
          <p>Deskripsi : <?php echo $datakasus['deskripsi']; ?></p>
          <p>Poin : <?php echo $datakasus['point']; ?></p>
        </div>
        <?php
        $no++ ;
        }
         ?>
      </div>
    </section>
  </div>
  <!-- tampilan Profil -->
  