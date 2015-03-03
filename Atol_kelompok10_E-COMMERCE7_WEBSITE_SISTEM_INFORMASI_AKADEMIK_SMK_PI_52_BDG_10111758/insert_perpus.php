\<?php
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
$query = mysql_query("insert into buku_perpustakaan (id_buku, jdl_buku, kode_buku, author, isbn, tgl_buku) values('$id_buku', '$jdl_buku', '$kode_buku', '$author', '$isbn', '$tgl_masuk')") or die(mysql_error());

if ($query) {
	header('location:perpustakaan.php?message=success');
}
?>