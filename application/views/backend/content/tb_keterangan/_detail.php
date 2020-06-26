        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <span class="h3 mb-0 text-gray-800">Detail Pelanggaran</span>

            <!-- button tambah -->

          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
              Detail Pelanggaran <?= $data['nama'] ?></h6>

            </div>
            <div class="card-body">
            <table class="table table-bordered dataTable" id="dataTable">
               <thead>
                  <tr>
                      <th>Tanggal Pelanggaran</th>
                      <th>Jenis</th>
                      <th>Deskripsi</th>
                      <th>Point</th>

               </thead>
               <tbody>

                <?php

                  $jenis = ['', 'sedang', 'berat', 'sangat berat'];
                        foreach ($ql as $data) {

                ?>
                <tr>
                    <td><?= $data["tanggal"] ?></td>
                    <td><?= $jenis[$data["jenis"]] ?></td>
                    <td><?= $data['deskripsi'] ?></td>
                    <td><?= $data["point"] ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>

            </div>
          </div>

        </div>
