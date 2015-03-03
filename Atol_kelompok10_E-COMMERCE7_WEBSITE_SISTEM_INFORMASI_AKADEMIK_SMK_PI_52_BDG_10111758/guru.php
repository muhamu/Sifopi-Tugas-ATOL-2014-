<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Guru | SMK Prakarya Internasional 52 Bandung</title>
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
          <article class="col1">
            <div class="pad_left1">
              <h2 class="pad_bot1">DATA GURU</h2>
              <p class="pad_bot1">
              <p class="pad_bot1 pad_top2"><strong>Cari Guru:</strong>              </p>
              <form method="post" action="cari_guru.php">
                <input type="text" class="textbox" name="txt_cari">
                <input type="submit" value="cari" class="cari">
              </form></p>
              <p class="pad_bot1 pad_top2"><strong>Menampilkan data guru yang mengajar di SMK Prakarya Internasional 52 Bandung</strong></p>
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
        	<td>Nama</td>
        	<td>Tgl Lahir</td>
        	<td>Tempat Lahir</td>
        	<td>Golongan</td>
        	<td>Gender</td>
        	<td>Foto</td>
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
        	<td><?php echo $data['tgl']; ?></td>
        	<td><?php echo $data['alamat']; ?></td>
        	<td><?php echo $data['golongan']; ?></td>
        	<td><?php echo $data['jenis_kelamin']; ?></td>
        	<td><?php echo "<img src='images/foto_guru/$data[foto]' width='80' height='80'>";?></img></td>
        	<td colspan="2"><a href="ediit_guru.php?id=<?php echo $data['id']; ?>">Edit</a> || <a href="delete_guru.php?id=<?php echo $data['no_induk']; ?>">Hapus</a></td>
            </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table> 
              <p>&nbsp;</p>
              <p><a href="guru_detail.php">lihat lebih lengkap data &gt;&gt;</a></p>
            </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1">
              <h2>TAMBAH GURU</h2>
            </div>
            <div class="wrapper">
              <form name="input_data_siswa" action="insert_guru.php" method="post">
              <p class="pad_top2"><strong>Data Pribadi Guru</strong><table border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td>Id</td>
      <td>:</td>
      <td><input id="input11" type="text" name="id" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>No. Induk</td>
      <td>:</td>
      <td><input id="input1" type="text" name="no_induk" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>Nama Guru</td>
      <td>:</td>
      <td><input id="input1" type="text" name="nama" maxlength="100" required="required" /></td>
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
      <td><input id="input1" type="text" name="tgl" required="required" /></td>
    </tr>
    <tr>
      <td>Tempat Lahir</td>
      <td>:</td>
      <td><input id="input7" type="text" name="lahir" required="required" /></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td>:</td>
      <td><select name="list_agama" id="list_agama">
        <option value="0">Pilih Agama</option>
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
          <option value="0">Pilih Kelas</option>
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
      <td><input id="input3" type="text" name="alamat" required="required" /></td>
    </tr>
    <tr>
      <td>No Telpon</td>
      <td>:</td>
      <td><input id="input4" type="text" name="no_telepon" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td>:</td>
      <td><input id="input10" type="email" name="email" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td>Golongan</td>
      <td>:</td>
      <td><select name="list_golongan" id="list_golongan">
        <option value="0">Pilih Golongan</option>
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
      <td><input id="input12" type="text" name="tgl_masuk" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" colspan="3"><div align="left">Upload Foto: 
        <input type="file" name="foto" id="foto">
      </div>
        <p><br>
              <input type="submit" name="submit1" value="tambah" id="submit1" />
          </p>        </td>
    </tr>
  </tbody>
</table>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              </p>
              </form>
              </p>
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