
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            
                <h6 class="m-0 font-weight-bold text-primary datatable">Detail Siswa</h6>
            </div>
            <div class="container" style="margin-top:12px;">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Nis</label>
                            <input disabled type="text" name="nis" placeholder="Masukkan nis" class="form-control" value="<?= Input_Helper::postOrOr('nis', $data['nis']) ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">nama</label>
                            <input disabled type="text" name="nama" placeholder="Masukkan nama" class="form-control" value="<?= Input_Helper::postOrOr('nama', $data['nama']) ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">email</label>
                            <input disabled type="email" name="email" placeholder="Masukkan email" class="form-control" value="<?= Input_Helper::postOrOr('email', $data['email']) ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">password</label>
                            <input disabled type="text" name="password" placeholder="Masukkan password" class="form-control" value="<?= Input_Helper::postOrOr('email', $data['email']) ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">jenis kelamin</label>
                            <?php 
                            $jk = Input_Helper::postOrOr('jenis_kelamin', $data['jenis_kelamin']);
                            ?>
                            <select disabled name="jenis_kelamin" id="" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option <?= ($jk == 1 ? 'selected' : '') ?> value="1">Laki Laki</option>
                                <option <?= ($jk == 0 ? 'selected' : '') ?> value="0">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">id_kelas</label>
                            <?php 
                            $kl = Input_Helper::postOrOr('id_kelas', $data['id_kelas']);
                            ?>
                            <select disabled name="id_kelas" id="" class="form-control">
                                <option value="">Pilih Kelas</option>
                                <?php
                                foreach ($kelas as $key) {
                                ?>
                                <option <?= ($kl == $key['id'] ? 'selected' : '') ?> value="<?= $key['id'] ?>"><?= $key['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">no_hp</label>
                            <input disabled type="text" name="no_hp" placeholder="Masukkan no_hp" class="form-control" value="<?= Input_Helper::postOrOr('no_hp', $data['no_hp']) ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">tempat_lahir</label>
                                    <input disabled type="text" name="tempat_lahir" placeholder="Masukkan tempat_lahir" class="form-control" value="<?= Input_Helper::postOrOr('tempat_lahir', $data['tempat_lahir']) ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">tanggal_lahir</label>
                                    <input disabled type="date" name="tanggal_lahir" placeholder="Masukkan tanggal_lahir" class="form-control" value="<?= Input_Helper::postOrOr('tanggal_lahir', $data['tanggal_lahir']) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">foto</label><br>
                            <img src="../../foto/siswa/<?= $data['foto'] ?>" alt="" style="width:40%">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">alamat</label>
                            <textarea disabled name="alamat" id="" class="form-control" cols="30" rows="10"><?= Input_Helper::postOrOr('alamat', $data['alamat']) ?></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>