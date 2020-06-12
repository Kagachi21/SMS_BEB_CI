
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/') ?>/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Magnific Popup core CSS file -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>/css/magnific-popup.css">



  <!-- Magnific Popup core JS file -->

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    
    <?php
      include str_replace("system", "application/views/guru/", BASEPATH)."/layout/sidebar.php";
      include str_replace("system", "application/views/guru/", BASEPATH)."/layout/navbar.php";
      include str_replace("system", "application/views/guru/", BASEPATH)."/layout/content.php";
     ?>
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script>var BASEURL = '<?= base_url() ?>';
  var datachart = <?php echo json_encode($line)?>
</script>
<!-- modal akhir -->
<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; SMS BEB 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('site/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/'); ?>/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/'); ?>/js/jquery.magnific-popup.js"></script>
  <script>
  $(document).ready(function() {
    $('.image-link').magnificPopup({type:'image'});
    $('#semua').click(function () {
        // var value = $('select[id^=status_absen]').map(function(i, el) {
        //   return $(el).val();
        // }).get();
        var jam = $("#status_absen").attr("jam");
        var value = $("#status_absen4").val();
        console.log(value);
        $(".status_absen"+jam+" option").filter(function() {
          //may want to use $.trim in here
          // console.log($("#status_absen").attr("jam"));
          return $(this).text() == "Hadir" && $("#status_absen").attr("jam") == jam;
        }).prop('selected', true);
    });
    $('#pilih-semua').click(function () {
      console.log("berhasil");
        $("#status_absen option").filter(function() {
          return $(this).text() == "Pulang" || $(this).text() == "Hadir";
        }).prop('selected', true);
    });
    $("#kelas").change(function(){
      // console.log("berhasil");
      var id_kelas = $(this).val();
      $.ajax({
            type: "GET",
            url: "../siswa/getsiswa.php?id_kelas="+id_kelas,
            cache: false,
            success: function(data){
                var obj = JSON.parse(data);
                // console.log(data)
                var appendElement = "<option value=' '>Pilih Siswa</option>";
                for (let index = 0; index < obj.length; index++) {
                    appendElement += "<option  value="+obj[index]['nis']+">"+
                                obj[index]['nama']+
                            "</option>";
                }
                $("#siswa").html(appendElement);
            },
            error(res){
                console.log("errrror")
                console.log("res");
            }
        });
    })
    $("#kelas_change").change(function(){
      // console.log("berhasil");
      var kelas = $(this).val();
      // console.log(kelas);
      $.ajax({
            type: "GET",
            url: "../getMapel.php?kelas="+kelas,
            cache: false,
            success: function(data){
                var obj = JSON.parse(data);
                // console.log(data)
                var appendElement = "<option value=' '>Pilih Mapel</option>";
                for (let index = 0; index < obj.length; index++) {
                    appendElement += "<option  value="+obj[index]['id']+">"+
                                obj[index]['nama']+
                            "</option>";
                }
                $("#mapel").html(appendElement);
            },
            error(res){
                console.log("errrror")
                console.log("res");
            }
        });
    })
    $("#hari").change(function(){
      // console.log("berhasil");
      var mapel = $("#mapel").val();
      var kelas = $("#kelas_change").val();
      var val = $(this).val();
      console.log("../getjam.php?hari="+val+"&mapel="+mapel+"&kelas="+kelas);
      $.ajax({
            type: "GET",
            url: "../getjam.php?hari="+val+"&mapel="+mapel+"&kelas="+kelas,
            cache: false,
            success: function(data){
                var obj = JSON.parse(data);
                console.log(data)
                var appendElement = "<option value=' '>Pilih Jam</option>";
                for (let index = 0; index < obj.length; index++) {
                    appendElement += "<option  value="+obj[index]+">"+
                                obj[index]+
                            "</option>";
                }
                $("#jam").html(appendElement);
            },
            error(res){
                console.log("errrror")
                console.log("res");
            }
        });
    })
  });
  </script>
  <script src="<?= base_url('assets/'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/'); ?>/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('assets/'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/'); ?>/js/demo/datatables-demo.js"></script>


</body>

</html>