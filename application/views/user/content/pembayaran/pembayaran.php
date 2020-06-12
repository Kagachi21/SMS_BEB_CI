
<!-- tampilan Profil -->
  <div class="container-fluid p-0">

  <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="harian">
      <div class="w-100">
        <h2 class="mb-5">Pembayaran</h2>
        <?php
        $no = 1;
        $jenis = ['', 'spp', 'study tour'];
        foreach ($querykasus as $datakasus) { ?>
        <button class="accordion">Pembayaran <?php echo $no; ?></button>
        <div class="panel">
          <br>
          <p>Tanggal : <?php echo $datakasus['tanggal']; ?></p>
          <p>Deskripsi : <?php echo $datakasus['deskripsi']; ?></p>
          <p>Jumlah : <?php echo number_format($datakasus['jml_tagihan']) ?></p>
          <p>Jenis : <?php echo $jenis[$datakasus['jenis_pembayaran']] ?></p>
        </div>
        <?php
        $no++ ;
        }
         ?>
      </div>
    </section>
  </div>