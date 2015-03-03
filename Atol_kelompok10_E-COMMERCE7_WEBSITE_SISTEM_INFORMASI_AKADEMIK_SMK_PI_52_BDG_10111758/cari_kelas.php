<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Kelas | SMK Prakarya Internasional 52 Bandung</title>
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
<![endif]--></head>
<body id="page5">
<div class="body1">
  <div class="main">
    <!-- header -->
    <header>
      <div class="wrapper">
        <nav>
          <ul id="menu">
            <li><a href="menu_utama.php">HOME</a></li>
            <li><a href="siswa.php">SISWA</a></li>
            <li><a href="kelas.php">KELAS</a></li>
            <li><a href="teachers.html">GURU</a></li>
            <li><a href="admissions.html">NILAI</a></li>
            <li><a href="admissions.html">CETAK RAPORT</a></li>
            <li class="end"><a href="logout.php">LOGOUT</a></li>
          </ul>
        </nav>
        <ul id="icons">
          <li><?php echo "<font color='white'>Selamat Datang, <strong>".$_SESSION['username']."</strong></font>"; ?></li>
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
              <h2 class="pad_bot1">RUANGAN KELAS</h2>
              <p class="pad_top2 pad_bot1"><strong>Hasil dari pencarian <?php echo "$_POST[txt_cari]";?></strong></p>
              <table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
        	<td>Id.</td>
        	<td>Kelas</td>
        	<td>No. Ruangan</td>
        	<td>Id Kelas</td>
        	<td>Wali</td>
        	<td>Tahun Ajaran</td>
        	<td>Opsi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from kelas where nama_kelas like'%".$_POST['txt_cari']."%'");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['id']; ?></td>
        	<td><?php echo $data['nama_kelas']; ?></td>
        	<td><?php echo $data['no_ruangan']; ?></td>
        	<td><?php echo $data['id_kelas']; ?></td>
        	<td><?php echo $data['wali']; ?></td>
        	<td><?php echo $data['ajaran']; ?></td>
            <td>
            	<a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a> || 
                <a href="delete_kelas.php?id=<?php echo $data['id']; ?>">Hapus</a>
            </td>
        </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table> 
              <p>&nbsp;</p>
              <p><a href="kelas.php">kembali ke daftar kelas &gt;&gt;</a></p>
            </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1">
              <h2>TAMBAH KELAS</h2>
            </div>
            <div class="wrapper">
              <p class="pad_top2"><form name="input_data" action="insert_kelas.php" method="post">
<table border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td>Id</td>
      <td>:</td>
      <td><input id="input1" type="text" name="id" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td>:</td>
      <td><input id="input1" type="text" name="kelas" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>No. Ruangan</td>
      <td>:</td>
      <td><input id="input1" type="text" name="no_ruangan" maxlength="100" required="required" /></td>
    </tr>
    <tr>
      <td>Id Kelas</td>
      <td>:</td>
      <td><input id="input1" type="text" name="id_kelas" required="required" /></td>
    </tr>
    <tr>
      <td>Wali</td>
      <td>:</td>
      <td><input id="input1" type="text" name="wali" required="required" /></td>
    </tr>
    <tr>
      <td>Th. Ajaran</td>
      <td>:</td>
      <td><input id="input1" type="text" name="ajaran" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td align="right" colspan="3"><input type="submit" name="submit1" value="tambah" id="submit1" /></td>
    </tr>
  </tbody>
</table>
<p>Tambah data anda</p>
</form></p>
              <p class="pad_top2">&nbsp;</p>
              <p class="pad_top2">&nbsp;</p>
              <p class="pad_top2">&nbsp;</p>
            </div>
            <div class="wrapper"></div>
            <div class="wrapper pad_bot2">
              <p class="pad_top2">&nbsp;</p>
            </div>
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