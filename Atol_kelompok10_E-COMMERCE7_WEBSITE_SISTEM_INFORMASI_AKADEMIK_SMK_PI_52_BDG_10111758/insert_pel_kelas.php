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
$query = mysql_query("insert into pelajaran_kelas (id, id_pljrn_kelas, id_kelas, nama_guru, id_pelajaran) values('$id', '$id_pljrn_kelas', '$id_kelas', '$nama_guru', '$id_pelajaran')") or die(mysql_error());

if ($query) {
	header('location:kurikulum.php?message=success');
}
?>