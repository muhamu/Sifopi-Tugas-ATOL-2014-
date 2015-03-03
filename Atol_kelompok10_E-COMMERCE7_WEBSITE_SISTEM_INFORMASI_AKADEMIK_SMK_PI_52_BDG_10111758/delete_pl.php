<title>Untitled Document</title><?php 
include('config.php');

$no_induk = $_GET['no_induk'];

$query = mysql_query("delete from pembayaran_lain where no_induk='$no_induk'") or die(mysql_error());

if ($query) {
	header('location:pembayaran_lain.php?message=delete');
}
else {
 echo "data gagal dimasukkan";
}
?>