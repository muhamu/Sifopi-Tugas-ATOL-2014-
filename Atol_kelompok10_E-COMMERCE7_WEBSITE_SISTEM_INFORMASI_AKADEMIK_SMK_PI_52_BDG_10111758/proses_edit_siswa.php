<?php
include('config.php');

//tangkap data dari form
$id = $_POST['id'];
$user = $_POST['user'];
$no_induk = $_POST['no_induk'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['rdo_jenis_kelamin'];
if($jenis_kelamin=="")
{
	echo "Maaf Jenis Kelamin Anda Belum di isi!!!";
	echo "<br>Kembali<br>
			<a href='edit_siswa.php'>Di Sini</a></center>";
}
else
{
$lahir = $_POST['lahir'];
$tgl_lahir = $_POST['tgl_lahir'];
$goldar = $_POST['list_goldar'];
$agama = $_POST['list_agama'];
$status = $_POST['status'];
$anak_ke = $_POST['anak_ke'];
$alamat = $_POST['alamat'];
$kelas = $_POST['list_kelas'];
$angkatan = $_POST['angkatan'];
$no_telp = $_POST['no_telp'];
$tgl_masuk = $_POST['tgl_masuk'];
$nama_ayah = $_POST['nama_ayah'];
$nama_ibu = $_POST['nama_ibu'];
$pekerjaan_ayah = $_POST['pekerjaan_ayah'];
$pekerjaan_ibu = $_POST['pekerjaan_ibu'];
$no_telepon_orang_tua = $_POST['no_telepon_orang_tua'];
$nama_wali = $_POST['nama_wali'];
$pekerjaan_wali = $_POST['pekerjaan_wali'];
$no_telepon_wali = $_POST['no_telepon_wali'];
$alamat_orang_tua = $_POST['alamat_orang_tua'];
$alamat_wali = $_POST['alamat_wali'];
$di_kelas = $_POST['di_kelas'];
$nama_sekolah_asal = $_POST['nama_sekolah_asal'];
$alamat_sekolah_asal = $_POST['alamat_sekolah_asal'];

	

//update data di database sesuai user_id
$query = mysql_query("update murid set no_induk='$no_induk', nama='$nama', jenis_kelamin='$jenis_kelamin', agama='$agama', lahir='$lahir',tgl='$tgl_lahir', 
golongan_darah='$goldar', agama='$agama', status_anak='$status', anak_ke='$anak_ke', alamat='$alamat', kelas='$kelas', angkatan='$angkatan', no_telepon='$no_telp', 
tgl_masuk='$tgl_masuk', nama_ayah='$nama_ayah', nama_ibu='$nama_ibu', pekerjaan_ayah='$pekerjaan_ayah', pekerjaan_ibu='$pekerjaan_ibu', no_telepon_orang_tua='$no_telepon_orang_tua', 
nama_wali='$nama_wali', pekerjaan_wali='$pekerjaan_wali', no_telepon_wali='$no_telepon_wali', alamat_orang_tua='$alamat_orang_tua', alamat_wali='$alamat_wali', di_kelas='$di_kelas', 
nama_sekolah_asal='$nama_sekolah_asal', alamat_sekolah_asal='$alamat_sekolah_asal', id='$user'
where id='$id'") or die(mysql_error());

if ($query) 
{
	echo "<center><h1>Data Berhasil DiUbah</h1><br>";
	echo "untuk melihatnya silakan klik<br>
			<a href='siswa.php'>Di Sini</a></center>";
}
else
{
	echo "<center><h1>Data Gagal DiUbah</h1><br>";
	echo "Error : ".mysql_error();
	echo "<br>Kembali<br>
			<a href='siswa.php'>Di Sini</a></center>";
}
}
?>