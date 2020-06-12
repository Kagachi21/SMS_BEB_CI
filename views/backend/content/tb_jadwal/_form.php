<div class="container-fluid">

<!-- Page Heading -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    
        <h6 class="m-0 font-weight-bold text-primary datatable">Form Jadwal</h6>
    </div>
    <div class="container" style="margin-top:12px;">
        <form method="post" action="" enctype="multipart/form-data">
        <div id="message"></div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Guru</label>
                    <?php 
                    $nip = Input_Helper::postOrOr('nip', $data['nip']);
                    if ($type == 'edit') {
                    ?>
                    <input type="hidden" name="id" placeholder="Masukkan id" class="form-control" value="<?= Input_Helper::postOrOr('id', $data['id']) ?>">
                    <?php } ?>
                    <select name="nip" id="" class="form-control">
                        <option value="">Pilih Guru</option>
                        <?php
                        foreach ($q as $k) {
                        ?>
                        <option <?= ($nip == $k['nip'] ? 'selected' : '') ?> value="<?= $k['nip'] ?>"><?= $k['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">kelas</label>
                    <?php 
                    $kl = Input_Helper::postOrOr('id_kelas', $data['id_kelas']);
                    ?>
                    <select name="id_kelas" id="kelas_change" class="form-control">
                        <option value="">Pilih Kelas</option>
                        <?php
                        foreach ($query_mysql as $key) {
                        ?>
                        <option <?= ($kl == $key['id'] ? 'selected' : '') ?> value="<?= $key['id'] ?>"><?= $key['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Mapel</label>
                    <?php 
                    $map = Input_Helper::postOrOr('id_mapel', $data['id_mapel']);
                    ?>
                    <select name="id_mapel" id="mapel" class="form-control">
                        <option value="">Pilih Mapel</option>
                        <?php
                        foreach ($qq as $m) {
                        ?>
                        <option <?= ($map == $m['id'] ? 'selected' : '') ?> value="<?= $m['id'] ?>"><?= $m['nama']."[".$m['jurusan']."]" ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Hari</label>
                    <?php 
                    $h = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    $hari = Input_Helper::postOrOr('hari', $data['hari']);
                    ?>
                    <select name="hari" id="hari" class="form-control">
                        <option value="">Pilih Hari</option>
                        <?php 
                        foreach ($h as $har) {
                        ?>
                        <option <?= ($hari == $har ? 'selected' : '') ?> value="<?= $har ?>"><?= $har ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Jam Ke</label>
                    <?php 
                    $jam = Input_Helper::postOrOr('jam', $data['jam']);
                    ?>
                    <select name="jam" id="jam" class="form-control">
                        <option value="">Pilih Jam</option>
                        <?php 
                        for($i = 1; $i < 11; $i++){
                        ?>
                        <option <?= ($jam == $i ? 'selected' : '') ?> value="<?= $i ?>"><?= $i ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
            <input type="submit" id="btn_jadwal" value="<?= $type ?>" class="btn btn-primary btn-block">
            </div>
        </form>
    </div>
</div>
</div>