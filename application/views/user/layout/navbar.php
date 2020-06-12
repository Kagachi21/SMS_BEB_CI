<?php 
$jk = ['Perempuan', 'Laki Laki'];
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top"
 id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
      <span class="d-block d-lg-none">SMS BEB</span>
      <span class="d-none d-lg-block">
        <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="<?= base_url() ?>foto/siswa/<?php echo $foto; ?>" alt="">
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="<?= base_url('user/') ?>dashboard/">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="<?= base_url('user/') ?>absen/absen_mapel">Absen Mapel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="<?= base_url('user/') ?>absen/absen_sekolah">Absen Sekolah</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="<?= base_url('user/') ?>bk/bk">Catatan BK</a>
        </li>
        <?php 
        if ($_SESSION['level'] == 'ortu') {
        
        ?>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="<?= base_url('user/') ?>keterangan/keterangan">Surat Keterangan</a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="<?= base_url('user/') ?>pembayaran/pembayaran">Informasi Pembayaran</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="<?= base_url('site/') ?>logout">Keluar</a>
        </li>
      </ul>
    </div>
  </nav>