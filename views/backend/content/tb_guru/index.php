      <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->




          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary datatable">Data Guru</h6>
              <a href="<?= base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/add/" ?>"><button class="btn btn-primary btn-sm float-right">+ Input Data</button></a>
            </div>
            <?php Response_Helper::part('alert');?>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">NIP</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Email</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Mapel</th>
                      <th scope="col">
                        <center><span>Action</span></center>
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $nomor = 1;
                    // perulangan untuk mencetak tiap" record dari hasil query
                    // hasil query tersimpan dalam bentuk array
                    // digunakan fungsi mysqli_fetch_array() untuk mengambil nilai dari tiap baris record dari array
                    foreach($query_mysql as $data) {
                  ?>
                    <tr>
                      <!-- mencetak nomor otomatis, secara increment -->
                      <td class="bold"><?php echo $nomor++; ?></td>
                      <!-- mencetak data record dari tb_siswa -->
                      <td><?php echo $data['nip']; ?></td>
                      <td><?php echo $data['nama']; ?></td>
                      <td><?php echo $data['email']; ?></td>
                      <td><?php echo $data['alamat']; ?></td>
                      <td>
                      <?php 
                      $d = $this->db->query("SELECT tm.nama FROM tb_jadwal tj JOIN tb_mapel tm ON tj.id_mapel=tm.id WHERE tj.nip='$data[nip]' GROUP BY tm.nama")->result_array();
                      foreach ($d as $k) {
                      ?>
                      <?= $k['nama'] ?>
                      <?php } ?>
                      </td>
                    
                      <td>
                        <div class="btn btn-group">
                        <a href="<?= base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/edit/".$data['id'] ?>"><button class="btn btn-success btn-sm" type="button">Edit</button></a>
                          <span>&nbsp</span>
                          <a href="<?= base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/delete/".$data['id'] ?>"
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