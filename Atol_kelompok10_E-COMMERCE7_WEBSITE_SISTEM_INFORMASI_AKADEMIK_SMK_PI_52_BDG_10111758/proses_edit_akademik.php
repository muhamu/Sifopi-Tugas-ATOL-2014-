<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$tgl = $_POST['tgl'];
$kegiatan = $_POST['kegiatan'];
$tgl_akhir = $_POST['tgl_akhir'];

//simpan data ke database
$query = mysql_query("update akademi set id='$id', nama='$nama', tgl='$tgl', kegiatan='$kegiatan', tgl_akhir='$tgl_akhir' where id='$id'") or die(mysql_error());

if ($query) {
	header('location:akademik.php?message=success');
}
?>