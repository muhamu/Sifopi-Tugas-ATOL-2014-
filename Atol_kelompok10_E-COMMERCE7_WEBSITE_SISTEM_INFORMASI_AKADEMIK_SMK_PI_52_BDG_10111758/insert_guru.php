<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$no_induk = $_POST['no_induk'];
$nama = $_POST['nama'];
$lahir = $_POST['lahir'];
$agama = $_POST['list_agama'];
if ($agama == "Islam")
{
  $agama = "Islam";
}
else if ($agama == "Kristen")
{
  $agama = "Kristen";
}
else if ($agama == "Hindu")
{
  $agama = "Hindu";
}
else if ($agama == "Buddha")
{
  $agama = "Buddha";
}
else if ($agama == "Konghucu")
{
  $agama = "Konghucu";
}

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

$tgl = $_POST['tgl'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$email = $_POST['email'];

$golongan = $_POST['list_golongan'];
if ($golongan == "IA")
{
  $golongan = "IA";
}
else if ($golongan == "IIA")
{
  $golongan = "IIA";
}
else if ($agama == "IIIA")
{
  $golongan = "IIIA";
}
else if ($agama == "Honorer")
{
  $golongan = "Honorer";
}


$jenis_kelamin = $_POST['rdo_jenis_kelamin'];
if ($jenis_kelamin == "Pria")
 {
	$jenis_kelamin = "Pria";
 }
 else
 {
 	$jenis_kelamin = "Wanita";
 }

$tgl_masuk = $_POST['tgl_masuk'];

		//upload foto
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file	 = $_FILES['foto']['type'];
		$nama_file = $_FILES['foto']['name'];
		$direktori ="images/foto_guru/$nama_file";
		$extensi = pathinfo($direktori, PATHINFO_EXTENSION);
		
		//upload file
		move_uploaded_file($lokasi_file,$direktori);


//simpan data ke database
$query = mysql_query("insert into guru (id, no_induk, nama, jenis_kelamin, tgl, golongan, lahir, agama, alamat, pelajaran, no_telepon, email, tgl_masuk, foto) values('$id', '$no_induk', '$nama', '$jenis_kelamin', '$tgl', '$golongan', '$lahir', '$agama', '$alamat', '$pelajaran', '$no_telepon', '$email', '$tgl_masuk', '$no_induk.$extensi')") or die(mysql_error());

if ($query) {
	header('location:guru.php?message=success');
}

	if(!empty($lokasi_file))
			{
				//merubah nama foto
				rename("images/foto_guru/$nama_file","images/foto_guru/$no_induk.$extensi");
			}
?>