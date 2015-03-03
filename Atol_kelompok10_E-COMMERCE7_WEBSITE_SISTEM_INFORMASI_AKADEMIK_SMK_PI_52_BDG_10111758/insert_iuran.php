<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$no_induk = $_POST['no_induk'];
$nama = $_POST['nama'];
$bulan = $_POST['bulan'];
$kelas = $_POST['list_kelas'];
if ($kelas == "1 TKJ")
{
  $kelas = "1 TKJ";
}
else if ($kelas == "2 TKJ")
{
  $kelas = "2 TKJ";
}
else if ($kelas == "3 TKJ")
{
  $kelas = "3 TKJ";
}
else if ($kelas == "1 TMO")
{
  $kelas = "1 TMO";
}
else if ($kelas == "2 TMO")
{
  $kelas = "2 TMO";
}
else if ($kelas == "3 TMO")
{
  $kelas = "3 TMO";
}
else if ($kelas == "1 TL")
{
  $kelas = "1 TL";
}
else if ($kelas == "2 TL")
{
  $kelas = "2 TL";
}
else if ($kelas == "3 TL")
{
  $kelas = "3 TL";
}

$bayar = $_POST['bayar'];
$tgl = $_POST['tgl'];




//simpan data ke database
$query = mysql_query("insert into spp (id, no_induk, nama, bulan, kelas, bayar, tgl) values('$id', '$no_induk', '$nama', '$bulan', '$kelas', '$bayar', '$tgl')") or die(mysql_error());

if ($query) {
	header('location:iuran.php?message=success');
}
?>