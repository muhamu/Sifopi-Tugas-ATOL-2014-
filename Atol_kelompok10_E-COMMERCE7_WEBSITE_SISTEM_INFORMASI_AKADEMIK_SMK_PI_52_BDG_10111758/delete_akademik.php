<title>Untitled Document</title><?php 
include('config.php');

$id = $_GET['id'];

$query = mysql_query("delete from akademi where id='$id'") or die(mysql_error());

if ($query) {
	header('location:akademik.php?message=delete');
}
?>