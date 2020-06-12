<table class="table table-bordered dataTable" id="dataTable">
               <thead>
                <tr>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>
                          Status Kehadiran
                      </th>
                  </tr>

               </thead>
               <tbody>

               <?php
                    foreach($ql as $data){
                ?>
                <tr>
                    <td><?= $data["nis"] ?></td>
                    <td><?= $data["nama"] ?></td>
                    <input type="text" name="kelas" hidden value="<?= $data["id_kelas"] ?>">
                    <input type="text" name="nis[]" hidden value="<?= $data["nis"] ?>">
                    <input type="hidden" name="type" value="1">
                    <?php
                    $now = date('Y-m-d');
                    $ci=& get_instance();
                    $ci->load->database();
                    // $qs = mysqli_query($koneksi, "SELECT * FROM tb_absen_harian WHERE id_kelas='$data[id_kelas]'");
                    $d = $ci->db->query("SELECT * FROM tb_absen_harian WHERE id_kelas='$data[id_kelas]'")->row_array();
                    // $d = mysqli_fetch_array($qs);
                    // $qcek = mysqli_query($koneksi, "SELECT * FROM tb_absen_harian WHERE tanggal like '%$now%' and nis='$data[nis]' and type='1'");
                    // $dd = mysqli_fetch_array($qcek);
                    $dd = $ci->db->query("SELECT * FROM tb_absen_harian WHERE tanggal like '%$now%' and nis='$data[nis]' and type='1'")->row_array();
                    ?>
                    <td>
                    <select name="status_absen[]" id="status_absen" class="form-control">
                            <option value="">Pilih Status</option>
                            <option value="Hadir" <?= $dd['status_absen'] == "Hadir" ? 'selected' : '' ?>>Hadir</option>
                            <option value="Hadir(Telat)" <?= $dd['status_absen'] == "Hadir(Telat)" ? 'selected' : '' ?>>Hadir(Telat)</option>
                            <option value="Tidak Hadir" <?= $dd['status_absen'] == "Tidak Hadir" ? 'selected' : '' ?>>Tidak Hadir</option>
                        </select>
                    </td>
                </tr>
                    <?php } ?>
                    </tbody>
            </table>
