<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id_buku = $_POST['id_buku'];
$jdl_buku = $_POST['jdl_buku'];
$kode_buku = $_POST['kode_buku'];
$author = $_POST['author'];
$isbn = $_POST['isbn'];
$tgl_buku = $_POST['tgl_buku'];	




//simpan data ke database
$query = mysql_query("update buku_perpustakaan set jdl_buku='$jdl_buku', kode_buku='$kode_buku', author='$author', isbn='$isbn', tgl_buku='$tgl_buku' where id_buku='$id_buku'") or die(mysql_error());

if ($query) {
	header('location:perpustakaan.php?message=success');
}
?>