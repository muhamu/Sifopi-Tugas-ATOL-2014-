<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Account Settings | SMK Prakarya Internasional 52 Bandung</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.5.2.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Molengo_400.font.js"></script>
<script type="text/javascript" src="js/Expletus_Sans_400.font.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<style type="text/css">.bg, .box2{behavior:url("js/PIE.htc");}</style>
<![endif]-->
<style type="text/css">
<!--
.style1 {font-size: 36px}
.style3 {font-size: 10}
-->
</style>
</head>
<body id="page5">
<div class="body1">
  <div class="main">
    <!-- header -->
    <header>
      <div class="wrapper">
        <nav>
          <ul id="menu">
            <li><a href="index.php">HOME</a></li>
            <li><a href="siswa.php">SISWA</a></li>
            <li><a href="kelas.php">KELAS</a></li>
            <li><a href="guru.php">GURU</a></li>
            <li><a href="guru.php">NILAI</a></li>
            <li><a href="settings.php">MAPEL</a></li>
            <li class="end"><a href="logout.php">LOGOUT</a></li>
          </ul>
        </nav>
        <ul id="icons">
          <li><a href="settings.php"><?php echo "<font color='white'>Selamat Datang, <strong>".$_SESSION['username']."</strong></font>"; ?></a></li>
          <li></li>
        </ul>
      </div>
      <div class="wrapper">
        <h1><a href="" id="logo">Learn Center</a></h1>
      </div>
      <div id="slogan"> Homepage<span>smk prakarya internasional 52 Bandung</span> </div>
    </header>
    <!-- / header -->
  </div>
</div>
<div class="body2">
  <div class="main">
    <!-- content -->
    <section id="content">
      <div class="box1">
        <div class="wrapper">
          <article class="col1">
            <div class="pad_left1">
              <h2 class="pad_bot1">ACCOUNT SETTINGS</h2>
              <p class="pad_bot1 pad_top2">&nbsp;</p>
              <?php 
if (!empty($_GET['message']) && $_GET['message'] == 'success') {
	echo '<h3>Berhasil meng-update data!</h3>';
} else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
	echo '<h3>Berhasil menghapus data!</h3>';
}
?>
              <p class="style1">&nbsp;</p>
              <p class="style1">Edit Account
              <form name="update_data" action="update.php" method="post">
<input type="hidden" name="user_id" value="<?php echo $id; ?>" />
<?php 

$query = mysql_query("select * from user") or die(mysql_error());

$data = mysql_fetch_array($query);
?>
<table border="0" cellpadding="5" cellspacing="0">
    <tbody>
    	<tr>
        	<td>Username</td>
        	<td>:</td>
        	<td><input type="text" name="username" maxlength="20" required="required" value="<?php echo $data['username']; ?>" /></td>
        </tr>
    	<tr>
        	<td>Password</td>
        	<td>:</td>
        	<td><input type="password" name="password" maxlength="20" required="required" value="<?php echo $data['password']; ?>" /></td>
        </tr>
    	<tr>
        	<td>Fullname</td>
        	<td>:</td>
        	<td><input type="text" name="fullname" maxlength="100" required="required" value="<?php echo $data['fullname']; ?>" /></td>
        </tr>
    	<tr>
        	<td>Email</td>
        	<td>:</td>
        	<td><input type="email" name="email" required="required" value="<?php echo $data['email']; ?>" /></td>
        </tr>
    	<tr>
        	<td>Agama</td>
        	<td>:</td>
        	<td><input type="text" name="agama" required="required" value="<?php echo $data['agama']; ?>" /></td>
        </tr>
    	<tr>
        	<td>Nomor HP</td>
        	<td>:</td>
        	<td><input type="text" name="no_hp" maxlength="14" required="required" value="<?php echo $data['no_hp']; ?>" /></td>
        </tr>
        <tr>
        	<td align="right" colspan="3"><input type="submit" name="submit" value="Simpan" /></td>
        </tr>
    </tbody>
</table>
</form>
&nbsp;</p>
              <hr>
              <p class="style1">&nbsp;</p>
            </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1"></div>
            </article>
        </div>
      </div>
    </section>
    <!-- content -->
    <!-- footer -->
    <footer></footer>
    <!-- / footer -->
  </div>
</div>
<script type="text/javascript">Cufon.now();</script>
<div align=center>Kelompok 10 - 2013/2014 ATOL<a href='http://all-free-download.com/free-website-templates/'></a></div>
</body>
</html>