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
$query = mysql_query("update seleksi set id='$id', nama='$nama', tgl_daftar='$tgl_daftar', status='$status', tgl_masuk='$tgl_masuk' where id='$id'") or die(mysql_error());

if ($query) {
	header('location:status_daftar.php?message=success');
}
?>