<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="data-siswa.php">
  <div class="sidebar-brand-icon">
    <i class="fas fa-home"></i>
  </div>
  <div class="sidebar-brand-text mx-3">SMS-BEB</div>
</a>

<!-- Divider -->


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Menu
</div>

<!-- Nav Item - Pages Collapse Menu -->

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Siswa" aria-expanded="true"
    aria-controls="Siswa">
    <i class="fas fa-fw fa-user-friends"></i>
    <span>Siswa</span></a>
    <div id="Siswa" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?= base_url($this->uri->segment(1).'/siswa') ?>">Data Siswa</a>
      <a class="collapse-item" href="<?= base_url($this->uri->segment(1).'/siswa/qrcode') ?>">Qr Code</a>
      <a class="collapse-item" href="<?= base_url($this->uri->segment(1).'/siswa/scan') ?>">Scan</a>
    </div>
  </div>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbsensi" aria-expanded="true"
    aria-controls="collapseAbsensi">
    <i class="fas fa-fw fa-user-friends"></i>
    <span>Absensi</span></a>
    <div id="collapseAbsensi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?= base_url($this->uri->segment(1).'/absen/absensi_harian') ?>">Absensi Harian</a>
      <a class="collapse-item" href="<?= base_url($this->uri->segment(1).'/absen/absensi_mapel') ?>">Absensi Mapel</a>
    </div>
  </div>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#guru" aria-expanded="true"
    aria-controls="collapseAbsensi">
    <i class="fas fa-fw fa-user-friends"></i>
    <span>Guru</span></a>
    <div id="guru" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?= base_url($this->uri->segment(1).'/guru') ?>">Guru</a>
      <a class="collapse-item" href="<?= base_url($this->uri->segment(1).'/jadwal') ?>">Jadwal Guru</a>
    </div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?= base_url($this->uri->segment(1).'/surat_keterangan') ?>">
    <i class="fas fa-fw fa-user-friends"></i>
    <span>Surat Keterangan</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?= base_url($this->uri->segment(1).'/surat_keterangan/bk') ?>">
    <i class="fas fa-fw fa-user-friends"></i>
    <span>Catatan BK</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?= base_url($this->uri->segment(1).'/pembayaran') ?>">
    <i class="fas fa-fw fa-user-friends"></i>
    <span>Pembayaran</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->