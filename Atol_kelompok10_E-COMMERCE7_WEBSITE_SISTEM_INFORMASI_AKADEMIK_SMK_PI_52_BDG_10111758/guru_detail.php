<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Detail Guru | SMK Prakarya Internasional 52 Bandung</title>
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
            <li><a href="siswa.php">SISWA</a></li>
            <li><a href="kelas.php">KELAS</a></li>
            <li><a href="guru.php">GURU</a></li>
            <li><a href="akademik.php">AKADEMIK</a></li>
            <li><a href="mata_pelajaran.php">MAPEL</a></li>
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
          <article class="col1_det">
            <div class="pad_left1">
              <h2 class="pad_bot1">DATA DETAIL GURU</h2>
              <p class="pad_bot1 pad_top2"><strong>Data Pribadi Siswa</strong></p>
              <table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
    	  <td>Id</td>
        	<td>No. Induk</td>
        	<td>Nama</td>
        	<td>J. Kelamin</td>
        	<td>Tpt Lahir</td>
        	<td>Tgl Lahir</td>
        	<td>Status</td>
        	<td>Golongan</td>
        	<td>Alamat</td>
        	<td>Pelajaran</td>
        	<td>Agama</td>
        	<td>No Telpon</td>
        	<td>Opsi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from guru");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
    	  <td><?php echo $data['id']; ?></td>
        	<td><?php echo $data['no_induk']; ?></td>
        	<td><?php echo $data['nama']; ?></td>
        	<td><?php echo $data['jenis_kelamin']; ?></td>
        	<td><?php echo $data['lahir']; ?></td>
        	<td><?php echo $data['tgl']; ?></td>
        	<td><?php echo $data['status']; ?></td>
        	<td><?php echo $data['golongan']; ?></td>
        	<td><?php echo $data['alamat']; ?></td>
        	<td><?php echo $data['pelajaran']; ?></td>
        	<td><?php echo $data['agama']; ?></td>
        	<td><?php echo $data['no_telepon']; ?></td>
            <td>
            	<a href="ediit_guru.php?id=<?php echo $data['id']; ?>">Edit</a> || 
                <a href="delete_guru.php?id=<?php echo $data['id']; ?>">Hapus</a>            </td>
        </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table>
              <p></p>
</p>
              <p><a href="guru.php">Kembali ke data guru &gt;&gt;</a></p>
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