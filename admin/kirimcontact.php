<?php
include "../koneksi.php";
session_start();
//proteksi middleware
if(!isset($_SESSION['email'])){
  header("location:../login.php");
}
$id =$_GET['idPesan'];
$selectContat=mysqli_query($a, "SELECT * FROM contact WHERE id=$id");
$row = mysqli_fetch_assoc($selectContat);

if(isset($_POST['kirim'])){
  $id= $_GET['idPesan'];
  $email =$_POST['email'];
  $subjek=$_POST['subjek'];
  $pesan=$_POST['pesan'];

  $headers ="FROM: cindagaargya@gmail.com" . "\r\n".
            "Reply-To :cindagaargya@gmail.com" . "\r\n".
            "Content-type: text/plain; charset=UTF-8" . "\r\n".
            "MINE-Version: 1.0" . "\r\n";
  //kirim
  if (mail($email, $subjek, $pesan, $headers)) {
    echo "<scrip>alert('pesan sudah dibalas!')</scrip>";
    $del =mysqli_query($a,"DELETE FROM contact WHERE id=$id");
    header("Location: contact.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
<?php include "../inc/navbar.php"?>
  <!-- ======= Sidebar ======= -->
<?php include "../inc/sidebar.php"?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Blank Page</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">PESAN BALASAN</h5>

<!-- enctype=multipart/form-date bergungsi untuk mengambil gambar $_FILES -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="row mb-3">
      <div class="col-8">
        <pre> nama : <?php echo $row['nama']?></pre>
        <pre> nama : <?php echo $row['email']?></pre>
        <pre> nama : <?php echo $row['subjek']?></pre>
        <pre> nama : <?php echo $row['pesan']?></pre>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-sm-8">
        <label for="" class="form-label">Subjek</label>
        <input type="hidenn" name="email" value="<?php echo $row['email']?>">
        <input type="text" class="form-control   " name="subjek">
      </div>
    </div>

    <!-- untuk button -->
    <div class="mb-3">
        <div class="col-sm-8">
          <label for="" class="form-label">Pesan Balasan</label>
          <textarea name="pesan" id="" class="form-control" cols="30" rows="3"></textarea>
        </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-2 offset-md-2">
        <button name="kirim" class="btn btn-primary" type="submit">kirim</button>
      </div>
    </div>
</form>

<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>