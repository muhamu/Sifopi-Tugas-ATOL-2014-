<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$id_pelajaran = $_POST['id_pelajaran'];
$list_mapel = $_POST[''];
$pelajaran = $_POST['list_mapel'];
if ($pelajaran == "Elektronika Dasar")
{
  $pelajaran = "Elektronika Dasar";
}
else if ($pelajaran == "Matematika")
{
  $pelajaran = "Matematika";
}
else if ($pelajaran == "Bhs. Indonesia")
{
  $pelajaran = "Bhs. Indonesia";
}
else if ($pelajaran == "Bhs. Inggris")
{
  $pelajaran = "Bhs. Inggris";
}
else if ($pelajaran == "Kewarganegaraan")
{
  $pelajaran = "Kewarganegaraan";
}
else if ($pelajaran == "Praktikum")
{
  $pelajaran = "Praktikum";
}
else if ($pelajaran == "Agama")
{
  $pelajaran = "Agama";
}
else if ($pelajaran == "Fisika")
{
  $pelajaran = "Fisika";
}
else if ($pelajaran == "Kimia")
{
  $pelajaran = "Kimia";
}
else if ($pelajaran == "Pemrograman Web")
{
  $pelajaran = "Pemrograman Web";
}
else if ($pelajaran == "Troubleshooting")
{
  $pelajaran = "Troubleshooting";
}
else if ($pelajaran == "Jaringan Dasar")
{
  $pelajaran = "Jaringan Lanjut";
}
else if ($pelajaran == "Kendaraan Dasar")
{
  $pelajaran = "Kendaraan Dasar";
}
else if ($pelajaran == "Kendaraan Lanjut")
{
  $pelajaran = "Kendaraan Lanjut";
}
else if ($pelajaran == "PLC Programming")
{
  $pelajaran = "PLC Programming";
}
else if ($pelajaran == "Elektronika Lanjut")
{
  $pelajaran = "Elektronika Lanjut";
}


$kategori_pelajaran = $_POST['kategori_pelajaran'];
if ($kategori_pelajaran == "MPDU")
{
  $kategori_pelajaran = "MPDU";
}
else if ($kategori_pelajaran == "Ekstrakulikuler")
{
  $kategori_pelajaran = "Ekstrakulikuler";
}
else if ($kategori_pelajaran == "Kejuruan")
{
  $kategori_pelajaran = "Kejuruan";
}

$ajaran = $_POST['ajaran'];



//simpan data ke database
$query = mysql_query("insert into mapel (id, id_pelajaran, mata_pelajaran, kategori_pelajaran, ajaran) values('$id', '$id_pelajaran', '$pelajaran', '$kategori_pelajaran', '$ajaran')") or die(mysql_error());

if ($query) {
	header('location:mata_pelajaran.php?message=success');
}
?>