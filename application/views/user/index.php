<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Monitoring</title>

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url('assets/User') ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
  <link href="<?= base_url('assets/User') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>/css/magnific-popup.css">
  <link href="<?= base_url('assets/User') ?>/css/resume.min.css" rel="stylesheet">

  <style>

    .accordion {
      background-color: #eee;
      color: #444;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
      transition: 0.4s;
      }

    .accordion input {
      display: none;
    }

    .active, .accordion:hover {
      background-color: #ccc;
      }

    .panel {
      padding: 0 18px;
      background-color: white;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.2s ease-out;
      }

    .accordion:after {
      content: '\02795'; /* Unicode character for "plus" sign (+) */
      font-size: 13px;
      color: #777;
      float: right;
      margin-left: 5px;
      }

    .accordion.active:after {
      content: "\2796"; /* Unicode character for "minus" sign (-) */
      }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      margin: auto;
    }

    .tabel td, th {

      text-align: Center;
      padding: 2px;
    }
  </style>


</head>

<body id="page-top">
    
    <?php
    $nis = $_SESSION['nis'];
      // Auth_Helper::secure();
      $data = $this->db->query("SELECT ts.*, tk.nama as nama_kelas FROM tb_siswa ts INNER JOIN tb_kelas tk ON tk.id = ts.id_kelas WHERE ts.nis = '$nis'")->row_array();
        $foto = $data["foto"];
      include str_replace("system", "application/views/user/", BASEPATH)."/layout/navbar.php";
      include str_replace("system", "application/views/user/", BASEPATH)."/layout/content.php";
     ?>

  <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url('assets/') ?>User/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/') ?>User/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="<?= base_url('assets/') ?>User/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="<?= base_url('assets/') ?>User/js/resume.min.js"></script>
  <script src="<?= base_url('assets/') ?>js/jquery.magnific-popup.js"></script>

  <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        }
      });
    }
    $('.image-link').magnificPopup({type:'image'});
    </script>
</body>

</html>
