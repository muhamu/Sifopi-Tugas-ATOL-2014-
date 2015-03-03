<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
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

$kurikulum = $_POST['kurikulum'];
if ($kurikulum == "KTSP")
{
	$kurikulum = "KTSP";
}
else if ($kurikulum == "2010")
{
	$kurikulum = "2010";
}
else if ($kurikulum == "2009")
{
	$kurikulum = "2009";
}	
	
$id_pelajaran = $_POST['id_pelajaran'];




//simpan data ke database
$query = mysql_query("update kurikulum set id='$id', kelas='$kelas', kurikulum='$kurikulum', id_pelajaran='$id_pelajaran' where id='$id'") or die(mysql_error());

if ($query) {
	header('location:kurikulum.php?message=success');
}
?>