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

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbsensi" aria-expanded="true"
    aria-controls="collapseAbsensi">
    <i class="fas fa-fw fa-user-friends"></i>
    <span>Absensi</span></a>
    <div id="collapseAbsensi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!-- <a class="collapse-item" href="<?= base_url($this->uri->segment(1).'/absen/absensi_harian') ?>">Absensi Harian</a> -->
      <a class="collapse-item" href="<?= base_url($this->uri->segment(1).'/absen/absensi_mapel') ?>">Absensi Mapel</a>
    </div>
  </div>
</li>


<li class="nav-item">
  <a class="nav-link" href="<?= base_url($this->uri->segment(1).'/surat_keterangan') ?>">
    <i class="fas fa-fw fa-user-friends"></i>
    <span>Surat Keterangan</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="<?= base_url($this->uri->segment(1).'/jadwal') ?>">
    <i class="fas fa-fw fa-user-friends"></i>
    <span>Jadwal</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->