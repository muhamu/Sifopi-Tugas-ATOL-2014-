<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$nis = $_POST['nis'];
$sakit = $_POST['sakit'];
$izin = $_POST['izin'];	
$alpha = $_POST['alpha'];
$keterangan = $_POST['keterangan'];



//simpan data ke database
$query = mysql_query("update absen set nis='$nis', sakit='$sakit', izin='$izin', alpha='$alpha', keterangan='$keterangan' where nis='$nis'") or die(mysql_error());

if ($query) {
	header('location:kurikulum.php?message=success');
}
?>