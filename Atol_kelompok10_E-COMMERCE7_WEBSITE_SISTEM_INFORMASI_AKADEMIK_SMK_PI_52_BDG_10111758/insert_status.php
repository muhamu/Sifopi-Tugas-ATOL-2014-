<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$tgl_daftar = $_POST['tgl_daftar'];
$status = $_POST['status'];
if ($status == "LULUS")
{
  $agama = "LULUS";
}
else if ($agama == "TIDAK LULUS")
{
  $agama = "TIDAK LULUS";
}
$tgl_masuk = $_POST['tgl_masuk'];



//simpan data ke database
$query = mysql_query("insert into seleksi (id, nama, tgl_daftar, status, tgl_masuk) values('$id', '$nama', '$tgl_daftar', '$status', '$tgl_masuk')") or die(mysql_error());

if ($query) {
	header('location:status_daftar.php?message=success');
}
?>