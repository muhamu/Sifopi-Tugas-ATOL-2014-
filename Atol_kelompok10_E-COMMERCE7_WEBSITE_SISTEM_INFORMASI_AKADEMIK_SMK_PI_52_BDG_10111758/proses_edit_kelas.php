<?php
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$no_ruangan = $_POST['no_ruangan'];
$id_kelas = $_POST['id_kelas'];
$wali = $_POST['wali'];
$ajaran = $_POST['ajaran'];
$kelas = $_POST['list_kelas'];
if ($kelas == "1 TKJ")
{
  $kelas = "1 TKJ";
}
else if ($kelas == "2 TKJ")
{
  $kelas = "2 TKJ";
}
else if ($kelas == "3 TKJ")
{
  $kelas = "3 TKJ";
}
else if ($kelas == "1 TMO")
{
  $kelas = "1 TMO";
}
else if ($kelas == "2 TMO")
{
  $kelas = "2 TMO";
}
else if ($kelas == "3 TMO")
{
  $kelas = "3 TMO";
}
else if ($kelas == "1 TL")
{
  $kelas = "1 TL";
}
else if ($kelas == "2 TL")
{
  $kelas = "2 TL";
}
else if ($kelas == "3 TL")
{
  $kelas = "3 TL";
}

	

//update data di database sesuai user_id
$query = mysql_query("update kelas set id='$id', no_ruangan='$no_ruangan', id_kelas='$id_kelas', wali='$wali', ajaran='$ajaran', nama_kelas='$kelas' where id='$id'") or die(mysql_error());

if ($query) {
	header('location:kelas.php?message=success');
}
?>