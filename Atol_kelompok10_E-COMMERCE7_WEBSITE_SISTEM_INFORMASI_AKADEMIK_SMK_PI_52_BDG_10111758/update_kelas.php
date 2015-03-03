<?php
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$kelas = $_POST['nama_kelas'];
$no_ruangan = $_POST['no_ruangan'];
$id_kelas = $_POST['id_kelas'];
$wali = $_POST['wali'];
$ajaran = $_POST['ajaran'];

//update data di database sesuai user_id
$query = mysql_query("update kelas set nama_kelas='$kelas', no_ruangan='$no_ruangan', id_kelas='$id_kelas', wali='$wali', ajaran='$ajaran' where id='$id'") or die(mysql_error());

if ($query) {
	header('location:kelas.php?message=success');
}
?>