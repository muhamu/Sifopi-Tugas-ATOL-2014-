<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$tgl_daftar = $_POST['tgl_daftar'];




//simpan data ke database
$query = mysql_query("update daftar set id='$id', nama='$nama', tgl_daftar='$tgl_daftar' where id='$id'") or die(mysql_error());

if ($query) {
	header('location:daftar.php?message=success');
}
?>