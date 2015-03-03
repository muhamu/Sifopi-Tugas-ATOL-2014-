<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$id_pljrn_kelas = $_POST['id_pljrn_kelas'];
$id_kelas = $_POST['id_kelas'];
$nama_guru = $_POST['nama_guru'];	
$id_pelajaran = $_POST['id_pelajaran'];



//simpan data ke database
$query = mysql_query("update pelajaran_kelas set id='$id', id_pljrn_kelas='$id_pljrn_kelas', id_kelas='$id_kelas', nama_guru='$nama_guru', id_pelajaran='$id_pelajaran' where id='$id'") or die(mysql_error());

if ($query) {
	header('location:kurikulum.php?message=success');
}
?>