<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$no_induk = $_POST['no_induk'];
$nama = $_POST['nama'];
$lahir = $_POST['lahir'];

$golongan_darah = $_POST['list_goldar'];
if ($agama == "A")
{
  $agama = "A";
}
else if ($agama == "B")
{
  $agama = "B";
}
else if ($agama == "AB")
{
  $agama = "AB";
}
else if ($agama == "O")
{
  $agama = "O";
}

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

$tgl = $_POST['tgl'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$nama_ayah = $_POST['nama_ayah'];
$nama_ibu = $_POST['nama_ibu'];
$pekerjaan_ayah = $_POST['pekerjaan_ayah'];
$pekerjaan_ibu = $_POST['pekerjaan_ibu'];
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
  
$email = $_POST['email'];
$angkatan = $_POST['angkatan'];
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
$no_telepon_orang_tua = $_POST['no_telepon_orang_tua'];
$no_telepon_wali = $_POST['no_telepon_wali'];
$nama_wali = $_POST['nama_wali'];
$pekerjaan_wali = $_POST['pekerjaan_wali'];
$status_anak = $_POST['status_anak'];
$anak_ke = $_POST['anak_ke'];
$di_kelas = $_POST['di_kelas'];
$nama_sekolah_asal = $_POST['nama_sekolah_asal'];
$alamat_sekolah_asal = $_POST['alamat_sekolah_asal'];
$alamat_orang_tua = $_POST['alamat_orang_tua'];
$alamat_wali = $_POST['alamat_wali'];

		//upload foto
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file	 = $_FILES['foto']['type'];
		$nama_file = $_FILES['foto']['name'];
		$direktori ="images/foto_siswa/$nama_file";
		$extensi = pathinfo($direktori, PATHINFO_EXTENSION);
		
		//upload file
		move_uploaded_file($lokasi_file,$direktori);


//simpan data ke database
$query = mysql_query("insert into murid (id, no_induk, nama, jenis_kelamin, tgl, lahir, agama, golongan_darah, status_anak, anak_ke, alamat, kelas, angkatan, no_telepon, email, tgl_masuk, nama_ayah, nama_ibu, pekerjaan_ayah, pekerjaan_ibu, no_telepon_orang_tua, nama_wali, pekerjaan_wali, no_telepon_wali, alamat_orang_tua, alamat_wali, di_kelas, nama_sekolah_asal, alamat_sekolah_asal, foto) values('$id', '$no_induk', '$nama', '$jenis_kelamin', '$tgl', '$lahir', '$agama', '$golongan_darah', '$status_anak', '$anak_ke', '$alamat', '$kelas', '$angkatan', '$no_telepon', '$email', '$tgl_masuk', '$nama_ayah', '$nama_ibu', '$pekerjaan_ayah', '$pekerjaan_ibu', '$no_telepon_orang_tua', '$nama_wali', '$pekerjaan_wali', '$no_telepon_wali', '$alamat_orang_tua', '$alamat_wali', '$di_kelas', '$nama_sekolah_asal', '$alamat_sekolah_asal', '$no_induk.$extensi')") or die(mysql_error());

if ($query) {
	header('location:siswa.php?message=success');
}

	if(!empty($lokasi_file))
			{
				//merubah nama foto
				rename("images/foto_siswa/$nama_file","images/foto_siswa/$no_induk.$extensi");
			}
?>