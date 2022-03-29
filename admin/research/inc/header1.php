<?php
session_start();
include "/xampp/htdocs/CustomLandingPage/admin/research/inc/db.php";
include "/xampp/htdocs/CustomLandingPage/admin/research/functions/DB.func.php";
include "/xampp/htdocs/CustomLandingPage/admin/research/functions/Message.func.php";
include "/xampp/htdocs/CustomLandingPage/admin/research/functions/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Arellano University</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <!-- Favicons -->
  <link href="../../../resource/img/favicon.png" rel="icon">
  <link href="../../../resource/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Bootstrap CSS File -->
  <link rel="stylesheet" href="../../../resource/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../../resource/css/mdb.min.css">

   <!-- Datatables -->
   <link href="../../../resource/ts/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="../../../resource/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../../resource/lib/animate/animate.min.css" rel="stylesheet">
  <link href="../../../resource/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="../../../resource/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../../../resource/lib/lightbox/css/lightbox.min.css" rel="stylesheet">


  
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>



  <!-- Main Stylesheet File -->
  <link href="../../../resource/css/style.css" rel="stylesheet">
  <link href="../../../resource/css/addons.css" rel="stylesheet">
  <style type="text/css">
   .modal-dialog{
    max-width: 75%!important;
  }
</style>
</head>
<body>
  <!--==========================
  Header
  ============================-->
  
  <header id="header" class="fixed-top">
    <div class="container">
      <div class="logo float-left">
       <a href="/CustomLandingPage/index.php" class="scrollto"><img src="../../../resource/img/logo.png" alt="" class="img-fluid" >&nbsp;<strong>AURESPOR</strong></a>
      </div>
      <div class="col-<?php 
      if(isset($_SESSION['id']))
      {
        if($_SESSION['role'] == "Administrator") 
        { 
          echo"6";
        }
      }
      else
      {
        echo"10";
      }
      ?>"></div>
      <nav class="main-nav float-right d-none d-lg-block" >
        <ul>
        <?php 
          if (isset($_SESSION['id'])) 
          { 
            if ($_SESSION['role']=="Administrator")
            { ?>
              <li><a><?php echo $_SESSION['name'];?></a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#"id="navbarDropdown" role="button"data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">Management</a>
              <?php 
            }
            ?>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="../account/account.php">Account Management</a>
                  <a class="dropdown-item" href="../research/research.php">Research Management</a>
                  <a class="dropdown-item" href="../author/author.php">Author Management</a>
                  <a class="dropdown-item" href="../journal/journal.php">Journal Management</a>
                  <a class="dropdown-item" href="../article/article.php">Article Management</a>
                  <a class="dropdown-item" href="../news//index.php">News Management</a>
                  <a class="dropdown-item" href="../events/index.php">Events Management</a>
                </li>
                  <li class="nav-item dropdown" >
                  <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i>&nbsp;</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#profile">Profile</a>
                    <a class="dropdown-item" href="#aboutus">About Us</a>
                    <a class="dropdown-item" href="../../signup/logout.php">Signout</a>
                  </div>
                  </li>
                  <?php
          } 
          else 
          { 
            header("Location: ../../login/login.php");
          }?>
        </ul>
      </nav><!-- .main-nav -->
    </div>
  </header><!-- #header -->

<!-- #footer -->
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->
  <!-- Tables CDN -->

  <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <!-- JavaScript Libraries -->
  <script src="./../resource/lib/jquery/jquery.min.js"></script>  <script src="./../resource/lib/jquery/jquery-migrat.min.js"></script>
  <script src="../../../resource/lib/bootstrap/js/bootstrap.bunle.min.js"></script>
  <script src="../../../resource/lib/easing/easing.min.js"></script <script src="./../resource/lib/mobile-nav/mobile-nav.js></script>
  <script src="../../../resource/lib/wow/wow.min.js"></script>  <script src="./../resource/lib/waypoints/waypoints.minjs"></script>
  <script src="../../../resource/lib/counterup/counterup.minjs"></script>
  <script src="../../../resource/lib/owlcarousel/owl.carousel.min.s"></script>
  <script src="../../../resource/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="../../../resource/lib/lightbox/js/lightbox.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script>
  $(document).ready( function () {
    $('#table_id').DataTable();
    } );
  </script>
  <script src="../../../resource/js/main.js"></script>
  </body>
</html>
