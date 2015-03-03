<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id_jadwal = $_POST['id_jadwal'];
$id_pljrn_kelas = $_POST['id_pljrn_kelas'];
$hari = $_POST['hari'];
if ($hari == "Minggu")
{
  $hari = "Minggu";
}
else if ($hari == "Senin")
{
  $hari = "Senin";
}
else if ($hari == "Selasa")
{
  $hari = "Selasa";
}
else if ($hari == "Rabu")
{
  $hari = "Rabu";
}
else if ($hari == "Kamis")
{
  $hari = "Kamis";
}
else if ($hari == "Jumat")
{
  $hari = "Jumat";
}
else if ($hari == "Sabtu")
{
  $hari = "Sabtu";
}
$jam = $_POST['jam'];	




//simpan data ke database
$query = mysql_query("update jadwal set id_jadwal='$id_jadwal', id_pljrn_kelas='$id_pljrn_kelas', hari='$hari', jam='$jam' where id_jadwal='$id_jadwal'") or die(mysql_error());

if ($query) {
	header('location:kurikulum.php?message=success');
}
?>