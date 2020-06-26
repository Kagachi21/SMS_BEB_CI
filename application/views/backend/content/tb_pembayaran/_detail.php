<div class="container-fluid">

<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-3">
  <span class="h3 mb-0 text-gray-800">Detail Pembayaran</span>

  <!-- button tambah -->

</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
    Detail Pembayaran <?= $data['nama'] ?></h6>

  </div>
  <div class="card-body">
  <table class="table table-bordered dataTable" id="dataTable">
     <thead>
        <tr>
            <th>Tanggal Pembayaran</th>
            <th>Jumlah Tagihan</th>
            <th>Status</th>
            <th>Jenis</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>

     </thead>
     <tbody>

      <?php

        $jenis = ['', 'spp', 'study tour'];
        foreach ($ql as $data) {

      ?>
      <tr>
          <td><?= $data["tanggal"] ?></td>
          <td><?= "Rp ".number_format($data["jml_tagihan"]) ?></td>
          <td><?= "Lunas" ?></td>
          <td><?= $jenis[$data["jenis_pembayaran"]] ?></td>
          <td><?= $data["deskripsi"] ?></td>
          <td><a href="<?= base_url('dashboard/pembayaran/edit/'.$data['id']) ?>">Edit</a></td>
          <td>
          <a href="<?= base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/delete/".$data['id'] ?>"
                onclick="return confirm('Anda yakin ingin menghapus data?');"><button
                  class="btn btn-danger btn-sm" type="button" name="delete">Delete</button></a>
          </td>
      </tr>
      <?php } ?>
      </tbody>
  </table>

  </div>
</div>

</div>
