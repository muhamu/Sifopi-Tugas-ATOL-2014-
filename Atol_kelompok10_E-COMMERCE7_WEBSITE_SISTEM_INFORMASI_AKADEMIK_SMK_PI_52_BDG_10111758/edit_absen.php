<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Edit Absen | SMK Prakarya Internasional 52 Bandung</title>
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
.style2 {font-size: 16px}
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
          <article class="col1">
            <div class="pad_left1">
              <h2 class="pad_bot1">EDIT AKADEMIK</h2>
              <p class="pad_bot1 pad_top2">&nbsp;</p>
              <div align="justify">
                <p><strong> <img src="images/logo.png" width="272" height="84"></strong></p>
                <p>&nbsp;</p>
              </div>
              <div align="justify"><form name="update_data" action="proses_edit_absen.php" method="post">
                <p><div class="wrapper">
                  <p class="pad_top2"><strong>Data Absen</strong>
                  <p class="pad_top2">
                <?php 
$id = $_GET['id'];

$query = mysql_query("select * from absen where id='$id'") or die(mysql_error());

$data = mysql_fetch_array($query);
?>
              
                <input type="hidden" name="id2" value="<?php echo $id; ?>" />
              
              <table border="0" cellpadding="5" cellspacing="0">
                <tbody>
                  <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td><select name="nis" id="nis">
                      <?php 
	$query = mysql_query("select * from murid");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['no_induk'].">".$data['no_induk']."<br>";
	}
	?>
                    </select></td>
                  </tr>
                  <tr>
                    <td>Id Pel. Kelas</td>
                    <td>:</td>
                    <td><label>
                    <select name="id_pljrn_kelas" id="id_pljrn_kelas">
                      <?php 
	$query = mysql_query("select * from pelajaran_kelas");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['id_pljrn_kelas'].">".$data['id_pljrn_kelas']."<br>";
	}
	?>
                                        </select>
                    </label></td>
                  </tr>
                  <tr>
                    <td>Sakit</td>
                    <td>:</td>
                    <td><input name="sakit" type="text" id="input6" maxlength="20" required="required" /></td>
                  </tr>
                  <tr>
                    <td>Izin</td>
                    <td>:</td>
                    <td><input id="input7" type="text" name="izin" maxlength="20" required="required" /></td>
                  </tr>
                  <tr>
                    <td>Alpa</td>
                    <td>:</td>
                    <td><input id="input8" type="text" name="alpha" maxlength="20" required="required" /></td>
                  </tr>
                  <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><input id="input9" type="text" name="keterangan" maxlength="20" required="required" /></td>
                  </tr>
                  <tr>
                    <td align="right" colspan="3"><input type="submit" name="submit4" value="tambah" id="submit4" /></td>
                  </tr>
                </tbody>
              </table>    <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              </p>
              </p>
            </div></p>
              <tr>
	 	  	    <td align="right" colspan="3">&nbsp;</td>
              </tr>
		
		      <p><br>
              </p>
		      <p><br>
	                <br>
		        
              </p>
</form>
<a href="menu_utama.php">Kembali ke Home</a>
<br>
<br>
<br>

<a href="../../../belajar/view.php">Lihat Data</a>
<br>
<br>
<br><br>
          </div>
              <div align="justify"></div>
              <div align="justify"></div>
              <div align="justify"><br>
              </div>
            </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1">
              <h2>NAVIGASI</h2>
              <p><strong>Klik menu ini untuk navigasi sesuai kebutuhan anda!</strong></p>
            </div>
            <table width="289" height="514" border="1" id="table-tampil2">
              <tr>
                <td width="279" height="80"><a href="daftar.php" class="style2">Penerimaan Siswa Baru</a></td>
              </tr>
              <tr>
                <td height="77"><span class="style2">Cetak Raport</span></td>
              </tr>
              <tr>
                <td height="99"><a href="nilai.php" class="style2">Data Penilaian Akademik</a></td>
              </tr>
              <tr>
                <td height="85"><span class="style2"><a href="iuran.php">Keuangan</a></span></td>
              </tr>
              <tr>
                <td height="98"><span class="style2"><a href="perpustakaan.php">Perpustakaan</a></span></td>
              </tr>
            </table>
            <p class="style1">&nbsp;</p>
            <div class="wrapper"></div>
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