<title>Untitled Document</title><?php 
include('config.php');

$id = $_GET['id'];

$query = mysql_query("delete from guru where id='$id'") or die(mysql_error());

if ($query) {
	header('location:guru.php?message=delete');
}
?>