<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SMS Beb</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?= base_url('assets/')?>img/favicon.png" rel="icon">
  <link href="<?= base_url('assets/')?>img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="<?= base_url('assets/')?>https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?= base_url('assets/')?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?= base_url('assets/')?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/')?>lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/')?>lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/')?>lib/owlcarousel/assets//owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/')?>lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/')?>/css/styles.css">

  <!-- Main Stylesheet File -->
  <link href="<?= base_url('assets/')?>css/style.css" rel="stylesheet">

</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="https://ibb.co/2KTW7RX"><img src="<?= base_url('assets/img/') ?>smada.jpg" alt="Shinobu-Chan" border="" width="40" height="40" style="float:left;"/><a href="#intro" class="scrollto">SMS Beb</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#fasilitas">Fasiltas</a></li>
          <li><a href="#testimonials">Lulusan</a></li>
          <li><a href="#footer">Tentang</a></li>
          <li><a href="#popup" >Login</a></li></li>
        </ul>
        <div id="popup">
            <div class="window">
                <a href="#" class="close-button" title="Close">X</a>
                <img src="<?= base_url('assets/img/') ?>/sms2.png" alt="User" class="user">
                <form action="<?= base_url("site/doLogin") ?>" method="post">
                <?php Response_Helper::part("alert")?>
                  <i class="fa fa-user"></i>
                  <input type="text" name="username" class="form_login" placeholder="Username .." required>
                  <br>
                  <i class="fa fa-lock"></i>
                  <input type="password" name="password" class="form_login" placeholder="Password .." required>
                  <br>
                  <input type="submit" class="tombol_login" value="LOGIN">
                  <br>
                  <p>
              			Belum Punya akun ? <a href="<?= base_url('site/daftar') ?>">Daftar</a>
              		</p>

                  <?php
                  if(isset($_GET['pesan'])){
                    if($_GET['pesan']=="gagal"){
                      echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
                    }
                  }
                  ?>

                </form>
              </div>
            </div>
            <!-- popup -->

      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

          <div class="carousel-item active">
            <div class="carousel-container">
              <div class="carousel-content">
                <p>Aplikasi Berbasis Web yang berfungsi membantu orang tua dalam memonitoring perilaku anak.</p>
              </div>
            </div>
          </div>

      </div>
    </div>
  </section><!-- #intro -->
    <?php
   
      include str_replace("system", "application/views/frontend/", BASEPATH)."/layout/content.php";
     ?>
     
     <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h1>SMS BEB</h1>
            <p>Apa itu SMS BEB ?</p>
            <p>&nbsp;</p>
            <p>SMS BEB adalah Aplikasi berbasis WEB yang gunanya untuk mengamati atau memonitoring siswa melalui WEB. Untuk mencegah siswa berperilaku buruk yang menyebabkan jeleknya nama baik.</p>
          </div>


          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              Jl. Jawa No.16, Tegal Boto Lor, Sumbersari <br>
              Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121<br>
              Indonesia <br>
              <strong>Phone:</strong> (0331) 321375<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Location</h4>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.3302064384825!2d113.71165911438077!3d-8.169449484131805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695cd4a10f679%3A0x413e8c44fb9d2ff7!2sSMA%20Negeri%202%20Jember!5e0!3m2!1sid!2sid!4v1575434785939!5m2!1sid!2sid" width="250" height="275" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          </div>

        </div>
      </div>
    </div>
      </div>
    </div>
  </footer><!-- #footer -->
     <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- Uncomment below i you want to use a preloader -->
    <!-- <div id="preloader"></div> -->

    <!-- JavaScript Libraries -->
    <script src="<?= base_url('assets/') ?>lib/jquery/jquery.min.js"></script>
    <!-- <script src="lib/jquery/jquery-migrate.min.js"></script> -->
    <!-- <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="lib/easing/easing.min.js"></script> -->
    <!-- <script src="lib/wow/wow.min.js"></script>
    <script src="lib/superfish/superfish.min.js"></script> -->
    <script src="<?= base_url('assets/') ?>lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- <script src="lib/touchSwipe/jquery.touchSwipe.min.js"></script> -->
    <!-- Contact Form JavaScript File -->
    <!-- <script src="contactform/contactform.js"></script> -->

    <!-- Template Main Javascript File -->
    <script src="<?= base_url('assets/') ?>js/main.js"></script>

</body>
</html>
