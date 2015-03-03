<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$tgl_daftar = $_POST['tgl_daftar'];




//simpan data ke database
$query = mysql_query("insert into daftar (id, nama, tgl_daftar) values('$id', '$nama', '$tgl_daftar')") or die(mysql_error());

if ($query) {
	header('location:daftar.php?message=success');
}
?>