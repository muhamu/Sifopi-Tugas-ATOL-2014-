<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$no_induk = $_POST['no_induk'];
$deskripsi = $_POST['deskripsi'];
$total = $_POST['total'];
$tgl_start = $_POST['tgl_start'];
$tgl_berakhir = $_POST['tgl_berakhir'];
$denda = $_POST['denda'];
$pembayaran = $_POST['pembayaran'];
if ($pembayaran == "SPP")
{
  $kelas = "SPP";
}
else if ($kelas == "Uang Bangunan")
{
  $kelas = "Uang Bangunan";
}
else if ($kelas == "Kesiswaan")
{
  $kelas = "Kesiswaan";
}
else if ($kelas == "Kegiatan Keagamaan")
{
  $kelas = "Kegiatan Keagamaan";
}





//simpan data ke database
$query = mysql_query("insert into pembayaran_lain (no_induk, pembayaran, deskripsi, total, tgl_start, tgl_berakhir, denda) values('$no_induk', '$pembayaran', '$deskripsi', '$total', '$tgl_start', '$tgl_berakhir', 'denda')") or die(mysql_error());

if ($query) {
	header('location:pembayaran_lain.php?message=success');
}
?>