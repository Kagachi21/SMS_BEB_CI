
<div class="container-fluid">

<!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                
                    <h6 class="m-0 font-weight-bold text-primary datatable">Dapatkan Qrcode</h6>
                </div>
                <div class="container" style="margin-top:12px;">
                        <!-- <div class="form-group">
                            <label for="">Nis</label>
                            <input type="text" onChange="redy()" name="nis" id="" placeholder="Masukkan nis" class="form-control" value="<?= Input_Helper::postOrOr('nis', $data['nis']) ?>">
                        </div> -->
                        <div class="form-group col-md-6">
                            <label for="">kelas</label>
                            <?php
                            $kl = Input_Helper::postOrOr('id_kelas', $data['id_kelas']);
                            ?>
                            <select  id="kelas" class="form-control">
                                <option value="">Pilih Kelas</option>
                                <?php

                                foreach ($kelas as $key) {
                                ?>
                                <option <?= ($kl == $key['id'] ? 'selected' : '') ?> value="<?= $key['id'] ?>"><?= $key['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Siswa</label>
                            <?php
                            $si = Input_Helper::postOrOr('nis', $data['nis']);
                            ?>
                            <select name="nis" onChange="redy()" name="nis" id="nis" class="form-control">
                                <option value="">Pilih Siswa</option>
                                <?php
                                foreach ($siswa as $key) {
                                ?>
                                <option <?= ($si == $key['nis'] ? 'selected' : '') ?> value="<?= $key['nis'] ?>"><?= $key['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <input type="button" onClick="redy()" onFocus="redy()"  value="Generate" class="btn btn-primary btn-block">
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                
                    <h6 class="m-0 font-weight-bold text-primary datatable">Informasi qrcode anda</h6>
                </div>
                <div class="container result_qrcode" style="margin-top:12px;">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        function pindah(){
          $('#id').focus();
          };
        function redy(){
          var id= $('#nis').val();
          console.log(id);
          $.ajax({
                      type: 'GET',
                      url : '<?php echo base_url('/dashboard/siswa/showQr/')?>'+id,
                      beforeSend : function(msg){
                      $('#result_qrcode').html('<h1><i class="fa fa-spin fa-refresh" /></h1>');
                  },
                  success: function(msg){
                  $('.result_qrcode').html(msg);
                  $('#nis').focus();
                    },
                    error(res){
                        console.log(res);
                console.log("errrror")
                console.log("res");
            }
                    
              });
          }
      </script>