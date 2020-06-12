<!-- tampilan Profil -->
<div class="container-fluid p-0">

<section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="biodata">
  <div class="w-100">
    <h1 class="mb-0">BIODATA</h1>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <table width="100%" border="0">
            <body>
              <tr>
                <td width="25%" valign="top" class="text">Nama</td>
                  <td width="2%">:</td>
                    <td style="color: rgb(200, 84, 19); font-weight:bold"><?php echo $nama; ?></td>
              </tr>

              <tr>
                <td class="text">Jenis Kelamin</td>
                    <td>:</td>
                    <td><?php echo $jk[$jenis]; ?></td>
              </tr>
              <tr>
                <td class="text">Tempat Lahir</td>
                    <td>:</td>
                    <td><?php echo $tempat; ?></td>
              </tr>

              <tr>
                <td class="text">Tanggal Lahir</td>
                    <td>:</td>
                    <td><?php echo $lahir; ?></td>
              </tr>

              <tr>
                <td class="text">Nis</td>
                    <td>:</td>
                    <td><?php echo $nis; ?></td>
              </tr>


              <tr>
                <td class="text">Kelas</td>
                    <td>:</td>
                    <td><?php echo $kelas; ?></td>
              </tr>

              <tr>
                <td class="text">Alamat</td>
                    <td>:</td>
                    <td><?php echo $alamat; ?></td>
              </tr>

              <tr>
                <td class="text">E-Mail</td>
                    <td>:</td>
                    <td><a href="mailto:didigg74@gmail.com"><?php echo $email; ?></a></td>
              </tr>
            </body>
          </table>
        </div>
        <div class="col-md-6">
          <a href="<?= base_url('dashboard/siswa/generate/'.$nis) ?>" class="image-link">
            <img style="width:200px" src="<?= base_url('dashboard/siswa/generate/'.$nis) ?>" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<!-- tampilan Profil -->
