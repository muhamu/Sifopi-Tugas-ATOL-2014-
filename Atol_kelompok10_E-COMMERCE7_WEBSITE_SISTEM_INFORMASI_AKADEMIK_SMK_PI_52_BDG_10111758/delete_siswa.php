<title>Untitled Document</title><?php 
include('config.php');

$id = $_GET['id'];

$query = mysql_query("delete from murid where id='$id'") or die(mysql_error());

if ($query) {
	header('location:siswa.php?message=delete');
}
?>