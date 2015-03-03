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
<style type="text/css">
<!--
.style2 {font-size: 24px}
.style3 {font-size: 36px}
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
            <li><a href="nilai_utama.php">NILAI</a></li>
            <li><a href="kurikulum.php">BeLAJAR - Mengajar</a></li>
            <li><a href="kenaikan.php">kenaikan</a></li>
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
              <h2 class="pad_bot1">DATA KENAIKAN</h2>
              <p class="pad_bot1">
              <p class="pad_bot1 pad_top2"><strong>Cari nilai anda:</strong>              </p>
              <form method="post" action="cari_siswa.php">
                <input type="text" class="textbox" name="txt_cari">
                <input type="submit" value="cari" class="cari">
              </form></p>
              <p class="pad_bot1 pad_top2"><strong>Menampilkan data kenaikan di SMK Prakarya Internasional 52 Bandung</strong></p>
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
        	<td>No Induk</td>
        	<td>Nama</td>
        	<td>Nama Kelas</td>
        	<td>Mata Pelajaran</td>
        	<td>Nilai Akhir</td>
        	<td>Semester</td>
        	<td>Status</td>
        	<td>Opsi</td>
        	</tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from view_kenaikan where no_induk like'%".$_POST['txt_cari']."%'");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['no_induk']; ?></td>
        	<td><?php echo $data['nama']; ?></td>
        	<td><?php echo $data['nama_kelas']; ?></td>
        	<td><?php echo $data['mata_pelajaran']; ?></td>
        	<td><?php echo $data['nilai_akhir']; ?></td>
        	<td><?php echo $data['semester']; ?></td>
        	<td><?php echo $data['status']; ?></img></td>
        	<td><a href="edit.php?id=<?php echo $data['no_induk']; ?>">Edit</a> || <a href="delete_kelas.php?id=<?php echo $data['no_induk']; ?>">Hapus</a></td>
            </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table> 
              <p>&nbsp;</p>
              <p><table width="559" height="165" border="1" cellpadding="5" cellspacing="0" id="newsletter">
	<thead>
    	<tr>
        	<td height="78" colspan="2"><div align="center"><span class="style2">Keterangan</span></div></td>
        	</tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from view_kenaikan where no_induk like'%".$_POST['txt_cari']."%'");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><div align="center" class="style3">
        	  <?php
			$query = mysql_query("SELECT view_kenaikan.`status` FROM `view_kenaikan` WHERE `status`='TIDAK LULUS' and no_induk like'%".$_POST['txt_cari']."%'");
		
			$num_rows = mysql_num_rows($query);
			?>        	  
        	  <?php
			if ($num_rows == 0)
			{
  			$num_rows = "NAIK";
			}
			else if ($num_rows <> 0)
			{
			$num_rows = "TIDAK NAIK";
			}
			
			echo $num_rows;
			 }
			 ?>      	  
      	  </div></td>
        	</tr>

    </tbody>
</table>
              </p>
            </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
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