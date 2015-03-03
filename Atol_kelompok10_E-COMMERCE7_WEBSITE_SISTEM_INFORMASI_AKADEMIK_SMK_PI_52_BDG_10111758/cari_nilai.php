<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Hasil Pencarian Nilai | SMK Prakarya Internasional 52 Bandung</title>
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
            <li><a href="index.php">HOME</a></li>
            <li><a href="nilai_utama.php">NILAI</a></li>
            <li><a href="kurikulum.php">BeLAJAR - Mengajar</a></li>
            <li><a href="kenaikan.php">kenaikan</a></li>
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
              <h2 class="pad_bot1">DATA NILAI</h2>
              <p class="pad_top2 pad_bot1"><strong>Hasil dari pencarian <?php echo "$_POST[txt_cari]";?></strong></p><table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
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
	$query = mysql_query("select * from nilai where no_induk like'%".$_POST['txt_cari']."%'");
	
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
        	<td colspan="2"><a href="ediit_nilai.php?id=<?php echo $data['id']; ?>">Edit</a> || <a href="delete_kelas.php?id=<?php echo $data['no_induk']; ?>">Hapus</a></td>
            </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table>
              <p>
              </p>
<p><a href="nilai_utama.php">kembali ke data nilai &gt;&gt;</a></p>
            </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1">
              <h2>&nbsp;</h2>
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