 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary datatable">Data Siswa</h6>
    <a href="<?= base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/add/" ?>"><button class="btn btn-primary btn-sm float-right">+ Input Data</button></a>
  </div>
  <?php Response_Helper::part('alert');?>
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
          <div class="form-group col-md-1">
                <input type="submit" name="cari" value="cari" class="btn btn-primary btn-block">
          </div>
        </div>
      </form>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">NIS</th>
            <th scope="col">Nama</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Kelas</th>
            <th scope="col">
              <center><span>Action</span></center>
            </th>
          </tr>
        </thead>

        <tbody>
          <?php

          // membuat variavel $nomor untuk penomoran baris otomatis tabel
          $nomor = 1;

          // perulangan untuk mencetak tiap" record dari hasil query
          // hasil query tersimpan dalam bentuk array
          // digunakan fungsi mysqli_fetch_array() untuk mengambil nilai dari tiap baris record dari array
          foreach ($query_mysql as $data) {
        ?>
          <tr>
            <!-- mencetak nomor otomatis, secara increment -->
            <td class="bold"><?php echo $nomor++; ?></td>
            <!-- mencetak data record dari tb_siswa -->
            <td><?php echo $data['nis']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo ($data['jenis_kelamin'] == '1' ? "Laki laki" : "Perempuan"); ?></td>
            <td><?php echo $data['id_kelas']; ?></td>
          
            <td>
              <div class="btn btn-group">
                <a href="<?= base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/edit/".$data['nis'] ?>"><button class="btn btn-success btn-sm" type="button">Edit</button></a>
                <span>&nbsp</span>
                <a href="<?= base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/detail/".$data['nis'] ?>"><button class="btn btn-success btn-sm" type="button">Detail</button></a>
                <span>&nbsp</span>
                <a href="<?= base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/delete/".$data['nis'] ?>"
                  onclick="return confirm('Anda yakin ingin menghapus data?');"><button
                    class="btn btn-danger btn-sm" type="button" name="delete">Delete</button></a>
              </div>
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>