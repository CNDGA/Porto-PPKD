<?php
$host ="localhost";
$user = "root";
$pass="";
$db="angkatan1_porto";

$a = mysqli_connect($host, $user, $pass, $db);
if (!$a) {
  die("koneksi gagal");
}
?>