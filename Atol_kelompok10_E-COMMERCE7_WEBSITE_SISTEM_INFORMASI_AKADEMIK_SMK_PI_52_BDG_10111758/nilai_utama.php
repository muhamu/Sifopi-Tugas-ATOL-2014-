<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Nilai | SMK Prakarya Internasional 52 Bandung</title>
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
            <li><a href="nilai_utama.php">NILAI</a></li>
            <li><a href="kurikulum.php">BeLAJAR - Mengajar</a></li>
            <li><a href="cari_kenaikan.php">kenaikan</a></li>
            <li class="end"><a href="logout.php">LOGOUT</a></li>
          </ul>
        </nav>
        <ul id="icons">
          <li><a href="settings.php"><?php echo "<font color='white'>Selamat Datang, <strong>".$_SESSION['username']."</strong></font>"; ?></a></li>
          <li></li>
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
              <h2 class="pad_bot1">DATA NILAI</h2>
              <p class="pad_bot1">Cari nilai anda:</strong>              </p>
              <form method="post" action="cari_nilai.php">
                <input type="text" class="textbox" name="txt_cari">
                <input type="submit" value="cari" class="cari">
              </form></p>
              <p class="pad_bot1 pad_top2"><strong>Menampilkan data nilai siswa di SMK Prakarya Internasional 52 Bandung</strong></p>
              <p class="pad_bot1 pad_top2"><?php 
if (!empty($_GET['message']) && $_GET['message'] == 'success') {
	echo '<h3>Berhasil meng-update data!</h3>';
} else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
	echo '<h3>Berhasil menghapus data!</h3>';
}
?></p>
              <table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
        	<td>Id</td>
        	<td>No Induk</td>
        	<td>Id Pelajaran</td>
        	<td>Tugas</td>
        	<td>UTS</td>
        	<td>UAS</td>
        	<td>Nilai Akhir</td>
        	<td>Id Kelas</td>
        	<td>Status</td>
        	<td>Semester</td>
        	<td>Opsi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from nilai");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['id']; ?></td>
        	<td><?php echo $data['no_induk']; ?></td>
        	<td><?php echo $data['id_pelajaran']; ?></td>
        	<td><?php echo $data['tugas']; ?></td>
        	<td><?php echo $data['uts']; ?></td>
        	<td><?php echo $data['uas']; ?></td>
        	<td><?php echo $data['nilai_akhir']; ?></td>
        	<td><?php echo $data['id_kelas']; ?></img></td>
        	<td><?php echo $data['status']; ?></td>
        	<td><?php echo $data['semester']; ?></td>
        	<td colspan="2"><a href="ediit_nilai.php?id=<?php echo $data['id']; ?>">Edit</a> || <a href="delete_nilai.php?id=<?php echo $data['id']; ?>">Hapus</a></td>
            </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table> 
              <p>&nbsp;</p>
              <p>
              
              <p class="pad_bot1 pad_top2">&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
            </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1">
              <h2>TAMBAH NILAI</h2>
            </div>
            <div class="wrapper">
              </p><form name="input_data_kelas" action="insert_nilai.php" method="post">
<table border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td>Id</td>
      <td>:</td>
      <td><input id="input1" type="text" name="id" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>No Induk</td>
      <td>:</td>
      <td><label>
        <select name="no_induk" id="no_induk">
        <?php 
	$query = mysql_query("select * from murid");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['no_induk'].">".$data['no_induk']."<br>";
	}
	?>
                </select>
      </label></td>
    </tr>
    <tr>
      <td>Id Pelajaran</td>
      <td>:</td>
      <td><select name="id_pelajaran" id="id_pelajaran">
        <?php 
	$query = mysql_query("select * from mapel");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['id_pelajaran'].">".$data['id_pelajaran']."<br>";
	}
	?>
                </select></td>
    </tr>
    <tr>
      <td>Tugas</td>
      <td>:</td>
      <td><input id="input1" type="text" name="tugas" required="required" /></td>
    </tr>
    <tr>
      <td>UTS</td>
      <td>:</td>
      <td><input id="input1" type="text" name="uts" required="required" /></td>
    </tr>
    <tr>
      <td>UAS</td>
      <td>:</td>
      <td><input id="input1" type="text" name="uas" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td>Semester</td>
      <td>:</td>
      <td><input id="input2" type="text" name="semester" maxlength="14" required="required" /></td>
    </tr>
    
    <tr>
      <td>Id Kelas</td>
      <td>:</td>
      <td><select name="id_kelas" id="id_kelas">
        <?php 
	$query = mysql_query("select * from kelas");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['id_kelas'].">".$data['id_kelas']."<br>";
	}
	?>
                </select></td>
    </tr>
    <tr>
      <td align="right" colspan="3"><input type="submit" name="submit1" value="tambah" id="submit1" /></td>
    </tr>
  </tbody>
</table>
<p>Tambah data anda</p>
</form>
            </div>
            
            <div class="wrapper pad_bot2"></div>
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