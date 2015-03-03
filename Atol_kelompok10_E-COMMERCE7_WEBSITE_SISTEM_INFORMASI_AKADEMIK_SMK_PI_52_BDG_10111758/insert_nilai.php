<?php
//panggil file config.php untuk menghubung ke server
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$no_induk = $_POST['no_induk'];
$id_pelajaran = $_POST['id_pelajaran'];
$id_kelas = $_POST['id_kelas'];
$tugas = $_POST['tugas'];
$uts = $_POST['uts'];
$uas = $_POST['uas'];
$semester = $_POST['semester'];

$rerata = $tugas + $uts + $uas;
$nilai_akhir = $rerata * 0.3;

if(($nilai_akhir>=80)&&($nilai_akhir<=100))
		{
			$status="LULUS";
		}
		else if(($nilai_akhir>=68)&&($nilai_akhir<=79))
		{
			$status="LULUS";
		}
		else if(($nilai_akhir>=56)&&($nilai_akhir<=67))
		{
			$status="LULUS";
		}
		else if(($nilai_akhir>=45)&&($nilai_akhir<=55))
		{
			$status="TIDAK LULUS";
		}
		else if(($nilai_akhir>=0)&&($nilai_akhir<=44))
		{
			$status=" TIDAK LULUS";
		}


//simpan data ke database
$query = mysql_query("insert into nilai (id, no_induk, id_pelajaran, tugas, uts, uas, nilai_akhir, id_kelas, status, semester) values('$id', '$no_induk', '$id_pelajaran', '$tugas', '$uts', '$uas', '$nilai_akhir', '$id_kelas', '$status', '$semester')") or die(mysql_error());

if ($query) {
	header('location:nilai_utama.php?message=success');
}
?>