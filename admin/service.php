<?php
include "../koneksi.php";
session_start();
//proteksi middleware
if(!isset($_SESSION['email'])){
  header("location:../login.php");
}

//untuk s
if (isset($_POST['simpan'])) {
    //$_FILES untuk mengambil sebah file
    //$_POST untuk memanggil sebuah data atau variabel yang sudah ada

    $nama_service = $_POST['nama_service'];
    $foto = $_FILES['foto']['name'];
    $size = $_FILES['foto']['size']; //untuk menampilkan ukuran file foto

    //pathinfo untuk me GET atau mengambil data dari ekstensi array
    $ekstensi = array('png', 'jpg', 'jpeg');
    $ext = pathinfo($foto, PATHINFO_EXTENSION);


    //jika didalam ext ada nilai ekstensi maka!!! 
    if (!in_array(strtolower($ext), $ekstensi)) {
        echo "mohon maaf ektensi tidak terdaftar";
    } else {

        move_uploaded_file($FILES['foto']['tmp_name'], '../assets/uploads/' . $foto);


        //memasukan ke dalam tabel barang (field yang akan di masukan)
        //values (inputan masing-masing kolom)
        $insert = mysqli_query($a, "INSERT INTO service (nama_service, foto) 
        VALUES ('$nama_service','$foto')");
        if (!$insert) {
            //echo "gagal";
            header("location:service.php?pesan=tambah-gagal");
        } else {
            //echo "duar";
            header("location:add_edit_service.php?pesan=tambah-berhasil");
        }
    }
}


// $_GET sebuah perintah untuk memanggil sebuah data atau variabel yang belum ada
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $edit = mysqli_query($a, "SELECT * FROM service WHERE id = '$id' ");
    $rowEdit = mysqli_fetch_assoc($edit);
}
//untuk edit 
if (isset($_POST["edit"])) {
    $nama_service = $_POST['nama_service'];
    $foto = $_FILES['foto']['name'];
    $size = $_FILES['foto']['size']; //untuk menampilkan ukuran file foto

    //pathinfo untuk me GET atau mengambil data dari ekstensi array
    $ekstensi = array('png', 'jpg', 'jpeg');
    $ext = pathinfo($foto, PATHINFO_EXTENSION);

    //variabel id untuk edit
    $id = $_GET['edit'];

    //jika didalam ext ada nilai ekstensi maka!!! 
    if (!in_array(strtolower($ext), $ekstensi)) {
        echo "mohon maaf ekstensi tidak terdaftar";
    } else {
        //unlink ini memunculkan postingan gambar lama
        unlink("../assets/uploads/" . $rowEdit['foto']);
        $fileNama=uniqid(). '_' . basename($foto);
        //lalu di edit untuk memunculkan gambar yang update atau baru
        move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/uploads/' . $fileNama);
        $update = mysqli_query($a, "UPDATE service SET 
        nama_service='$nama_service',foto='$fileNama' WHERE id='$id'");
        header("location:add_edit_service.php?update=berhasil");
    }

    // $update = mysqli_query($a, "UPDATE service SET nama_service='$nama_service', foto='$foto' WHERE id='$id' ");
    // header("location:add_edit_service.php?update=berhasil");
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
              <h5 class="card-title">Pengaturan Umum</h5>

<!-- enctype=multipart/form-date bergungsi untuk mengambil gambar $_FILES -->
<form action="" method="post" enctype="multipart/form-data">

    <!-- required itu tidak boleh kosong, jadi di sebuah website required ini sebagai peringatan, kolom harus di isi -->
    <div class="mb-3">
        <label for="">service</label>
        <input value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_service'] : '' ?>" type="text" class="form-control" placeholder="Masukan nama service" name="nama_service" required>
    </div>

    <!-- untuk type=file tidak memiliki class=form-control &placeholder -->
    <!-- required itu tidak boleh kosong, jadi di sebuah website required ini sebagai peringatan, kolom harus di isi -->
    <div class="mb-3">
        <label for="">Foto</label>
        <p>
        <img src="../assets/uploads/<?php echo $rowEdit['foto']?>" alt="" width="100"></p>
        <input value="" type="file" name="foto" required>
    </div>
    <!-- untuk button -->
    <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Simpan" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>"> <!--echo isset(GET), BUTTON MEMILIKI 2 KONDISI YAKNI EDIT DAN s -->
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