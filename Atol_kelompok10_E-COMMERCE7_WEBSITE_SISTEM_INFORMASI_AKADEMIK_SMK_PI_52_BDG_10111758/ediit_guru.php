<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Edit Siswa | SMK Prakarya Internasional 52 Bandung</title>
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
              <h2 class="pad_bot1">EDIT GURU</h2>
              <p class="pad_bot1 pad_top2">&nbsp;</p>
              <div align="justify">
                <p><strong> <img src="images/logo.png" width="272" height="84"></strong></p>
                <p>&nbsp;</p>
              </div>
              <div align="justify"><form name="update_data" action="proses_edit_guru.php" method="post">
                <p><div class="wrapper">
              <form name="input_data_siswa" action="insert_guru.php" method="post">
              <p class="pad_top2"><strong>Data Pribadi Guru</strong>
              <p class="pad_top2">
                <?php 
$id = $_GET['id'];

$query = mysql_query("select * from guru where id='$id'") or die(mysql_error());

$data = mysql_fetch_array($query);
?>
              
                <input type="hidden" name="id2" value="<?php echo $id; ?>" />
              <table border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td>Id</td>
      <td>:</td>
      <td><input name="id" type="text" id="input11" value="<?php echo $data['id']; ?>" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>No. Induk</td>
      <td>:</td>
      <td><input name="no_induk" type="text" id="input1" value="<?php echo $data['no_induk']; ?>" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>Nama Guru</td>
      <td>:</td>
      <td><input name="nama" type="text" id="input1" value="<?php echo $data['nama']; ?>" maxlength="100" required="required" /></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td><label>
        <input type="radio" name="rdo_jenis_kelamin" id="rdo_jenis_kelamin" value="Pria">
      Pria 
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="radio" name="rdo_jenis_kelamin" id="rdo_jenis_kelamin2" value="Wanita">
Wanita</td>
    </tr>
    <tr>
      <td>Tgl Lahir</td>
      <td>:</td>
      <td><input name="tgl" type="text" id="input1" value="<?php echo $data['tgl']; ?>" required="required" /></td>
    </tr>
    <tr>
      <td>Tempat Lahir</td>
      <td>:</td>
      <td><input name="lahir" type="text" id="input7" value="<?php echo $data['lahir']; ?>" required="required" /></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td>:</td>
      <td><select name="list_agama" id="list_agama">
        <option value="Field Ksg!!">Pilih Agama</option>
        <option value="Islam">Islam</option>
        <option value="Kristen (Katolik)">Kristen</option>
        <option value="Hindu">Hindu</option>
        <option value="Buddha">Buddha</option>
        <option value="Konghucu">Konghucu</option>
      </select></td>
    </tr>
    
    <tr>
      <td>Mata Pelajaran</td>
      <td>:</td>
      <td><label>
        <select name="list_mapel" id="list_mapel">
          <option value="Belum Mengajar">Pilih Kelas</option>
          <option value="Elektronika Dasar">Elektronika Dasar</option>
          <option value="Matematika">Matematika</option>
          <option value="Bhs. Indonesia">Bhs. Indonesia</option>
          <option value="Bhs. Inggris">Bhs. Inggris</option>
          <option value="Kewarganegaraan">Kewarganegaraan</option>
          <option value="Praktikum">Praktikum</option>
          <option value="Agama">Agama</option>
          <option value="Fisika">Fisika</option>
          <option value="Kimia">Kimia</option>
          <option value="Pemrograman Web">Pemrograman Web</option>
          <option value="Troubleshooting">Troubleshooting</option>
          <option value="Jaringan Dasar">Jaringan Dasar</option>
          <option value="Jaringan Lanjut">Jaringan Lanjut</option>
          <option value="Kendaraan Dasar">Kendaraan Dasar</option>
          <option value="Kendaraan Lanjut">Kendaraan Lanjut</option>
          <option value="PLC Programming">PLC Programming</option>
          <option value="Elektronika Lanjut">Elektronika Lanjut</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td><input name="alamat" type="text" id="input3" value="<?php echo $data['alamat']; ?>" required="required" /></td>
    </tr>
    <tr>
      <td>No Telpon</td>
      <td>:</td>
      <td><input name="no_telepon" type="text" id="input4" value="<?php echo $data['no_telepon']; ?>" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td>:</td>
      <td><input name="email" type="email" id="input10" value="<?php echo $data['email']; ?>" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td>Golongan</td>
      <td>:</td>
      <td><select name="list_golongan" id="list_golongan">
        <option value="Belum Ada Golongan">Pilih Golongan</option>
        <option value="IA">IA</option>
        <option value="IIA">IIA</option>
        <option value="IIIA">IIIA</option>
        <option value="Honorer">Honorer</option>
                  </select></td>
    </tr>
    <tr>
      <td>Status</td>
      <td>:</td>
      <td><input type="radio" name="rdo_status" id="rdo_status1" value="Lajang">
        Lajang
          <input type="radio" name="rdo_status" id="rdo_status2" value="Menikah">
          Menikah</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="radio" name="rdo_status" id="rdo_status3" value="Duda/Janda">
Duda/Janda</td>
    </tr>
    <tr>
      <td>Tgl Masuk</td>
      <td>:</td>
      <td><input name="tgl_masuk" type="text" id="input12" value="<?php echo $data['tgl_masuk']; ?>" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" colspan="3"><div align="left"></div>
        <p><br>
              <input type="submit" name="submit1" value="simpan" id="submit1" />
          </p>        </td>
    </tr>
  </tbody>
</table>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              </p>
              </form>
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