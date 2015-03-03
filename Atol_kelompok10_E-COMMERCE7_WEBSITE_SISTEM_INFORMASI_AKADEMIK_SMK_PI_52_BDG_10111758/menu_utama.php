<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Menu Utama | SMK Prakarya Internasional 52 Bandung</title>
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
            <li><a href="menu_utama.php">HOME</a></li>
            <li><a href="siswa.php">SISWA</a></li>
            <li><a href="kelas.php">KELAS</a></li>
            <li><a href="guru.php">GURU</a></li>
            <li><a href="nilai.php">NILAI</a></li>
            <li><a href="mata_pelajaran.php">MAPEL</a></li>
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
              <h2 class="pad_bot1">HOME</h2>
              <p class="pad_bot1 pad_top2"><strong>Selamat datang di Sistem Informasi SMK Prakarya Internasional 52 Bandung</strong></p>
              <p class="pad_bot1 pad_top2"><img src="images/backlog.png" width="273" height="84"></p>
              <p><strong>Klik menu ini untuk navigasi sesuai kebutuhan anda!</strong></p>
              <p>&nbsp;</p>
              <p class="style1">Penerimaan Siswa Baru</p>
              <p class="style1"><hr></p>
              <p class="style1">Cetak Raport</p>
              <hr>
              <p class="style1">&nbsp;</p>
              <p class="style1">Data Kegiatan Akademik</p>
              <hr>
              <p class="style1">&nbsp;</p>
              <p class="style1">Alumni</p>
              <hr>
              <p class="style1">&nbsp;</p>
              <p class="style1">Perpustakaan</p>
              <hr>
              <p class="style1">&nbsp;</p>
            </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1">
              <h2>TANGGAL PENTING</h2>
            </div>
            <div class="wrapper"> <span class="date">27</span>
              <p class="pad_top2"><a href="#">April, 2011</a><br>
                Sed ut perspiciatis undmnis accusantium doloremq.</p>
            </div>
            <div class="wrapper"> <span class="date">25</span>
              <p class="pad_top2"><a href="#">April, 2011</a><br>
                Laudantium, totam remiam, tore veritatis et.</p>
            </div>
            <div class="wrapper"> <span class="date">19</span>
              <p class="pad_top2"><a href="#">April, 2011</a><br>
                Quasi architecto beatae vitae ipsam voluptatem.</p>
            </div>
            <div class="wrapper"> <span class="date">18</span>
              <p class="pad_top2"><a href="#">April, 2011</a><br>
                Voluptas sit aspernatur aut sequuntur magni.</p>
            </div>
            <div class="wrapper pad_bot2"> <span class="date">12</span>
              <p class="pad_top2"><a href="#">April, 2011</a><br>
                Sed ut perspiciatis undmnis accusantium dolorem.</p>
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