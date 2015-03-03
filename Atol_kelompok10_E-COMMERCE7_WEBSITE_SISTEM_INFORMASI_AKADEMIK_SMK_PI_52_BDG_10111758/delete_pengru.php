<title>Untitled Document</title><?php 
include('config.php');

$id = $_GET['id'];

$query = mysql_query("delete from pelajaran_kelas where id='$id'") or die(mysql_error());

if ($query) {
	header('location:nilai_utama.php?message=delete');
}
?>