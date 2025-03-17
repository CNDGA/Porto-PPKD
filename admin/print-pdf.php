<?php
    include "../koneksi.php";
    require_once __DIR__ . '/mpdf/vendor/autoload.php';

    $mpdf=new \Mpdf\Mpdf();
    $id=$_GET['idPrint'];


    $select =mysqli_query($a,"SELECT * FROM resume WHERE id=$id");
    $row=mysqli_fetch_assoc($select);



$html=
  '
  <body>
    <table border="1">
        <tr>
          <th>Tahun AWAL</th>
          <td>' .$row["tahun_awal"]. '</td>
        </tr>

        <tr>
          <th>Tahun AWAL</th>
          <td>' .$row["tahun_akhir"]. '</td>
        </tr>

        <tr>
          <th>Tahun AWAL</th>
          <td>' .$row["skill"]. '</td>
        </tr>

        <tr>
          <th>Tahun AWAL</th>
          <td>' .$row["instansi"]. '</td>
        </tr>

        <tr>
          <th>Tahun AWAL</th>
          <td>' .$row["deskripsi"]. '</td>
        </tr>
   </table>

  </body>
';

$mpdf->WriteHTML($html);

$mpdf->Output();

?>


