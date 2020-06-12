
<!DOCTYPE html>
<html>
  <head>
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/') ?>daftar.css">
    <script src="<?= base_url('assets/') ?>lib/jquery/jquery.min.js"></script>
  </head>
  <body>
    <div class="header">
      <h2>Daftar</h2>
    </div>
    <form action="<?=  base_url('site/doRegister') ?>" method="post">
    <?php Response_Helper::part("alert")?>
    <div class="input-group">
      <label>Nik</label>
      <input type="text" name="nik" id="nik" placeholder="NIK" value="<?= Input_Helper::postOrOr('nik') ?>" required>
    </div>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" value="<?= Input_Helper::postOrOr('username') ?>" placeholder="Nama"required>
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password" placeholder="Password"required>
    </div>
    <div class="input-group">
      <label>Nis</label>
      <input type="text" name="nis" id="nis" value="<?= Input_Helper::postOrOr('nis') ?>" placeholder="NIS"required>
      <div class="msg"></div>
    </div>

    <div class="input-group">
      <input type="hidden" name="kode" value="user">
    <div class="input-group">
  		<button type="submit" class="btn">DAFTAR</button>
  	</div>
    <p>
			Sudah Punya Akun? <a href="<?= base_url() ?>">Login</a>
		</p>
  </form>
  <script>
  var base_url = '<?= base_url() ?>';
    $(function(){
        $("#nis").keyup(function(){
        var val = $(this).val();
        $.ajax({
                type: "GET",
                url: base_url+ "site/cekNisOrtu/"+val,
                cache: false,
                success: function(data){
                if(data != ""){
                    $(".msg").addClass("alert alert-danger");
                    $(".msg").text(data);
                    $(".btn").hide();
                }else{
                    $(".btn").show();
                    $(".msg").removeClass("alert alert-danger");
                    $(".msg").text("");
                }
                },
                error(res){
                    console.log("errrror")
                    console.log("res");
                }
            });
        });
        $("#nik").keyup(function(){
        var val = $(this).val();
        $.ajax({
                type: "GET",
                url: base_url+ "site/cekNik/"+val,
                cache: false,
                success: function(data){
                if(data != ""){
                    $(".msg").addClass("alert alert-danger");
                    $(".msg").text(data);
                    $(".btn").hide();
                }else{
                    $(".btn").show();
                    $(".msg").removeClass("alert alert-danger");
                    $(".msg").text("");
                }
                },
                error(res){
                    console.log("errrror")
                    console.log("res");
                }
            });
        });
    })
  </script>
</body>
</html>
