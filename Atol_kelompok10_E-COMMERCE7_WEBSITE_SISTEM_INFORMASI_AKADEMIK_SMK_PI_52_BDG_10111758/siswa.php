<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Siswa | SMK Prakarya Internasional 52 Bandung</title>
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
              <h2 class="pad_bot1">DATA SISWA</h2>
              <p class="pad_bot1"><p class="pad_bot1 pad_top2"><strong>Cari siswa anda:</strong>              </p>
              <form method="post" action="cari_siswa.php">
                <input type="text" class="textbox" name="txt_cari">
                <input type="submit" value="cari" class="cari">
              </form></p>
              <p class="pad_bot1 pad_top2"><strong>Menampilkan data siswa yang bersekolah di SMK Prakarya Internasional 52 Bandung</strong></p>
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
        	<td>No. Induk</td>
        	<td>Nama</td>
        	<td>Tgl Lahir</td>
        	<td>Alamat</td>
        	<td>Kelas</td>
        	<td>Angkatan</td>
        	<td>Foto</td>
        	<td>Opsi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from murid");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
    	  <td><?php echo $data['id']; ?></td>
        	<td><?php echo $data['no_induk']; ?></td>
        	<td><?php echo $data['nama']; ?></td>
        	<td><?php echo $data['tgl']; ?></td>
        	<td><?php echo $data['alamat']; ?></td>
        	<td><?php echo $data['kelas']; ?></td>
        	<td><?php echo $data['angkatan']; ?></td>
        	<td><?php echo "<img src='images/foto_siswa/$data[foto]' width='80' height='80'>";?></img></td>
            <td>
            	<a href="edits_siswa.php?id=<?php echo $data['id']; ?>">Edit</a> || 
                <a href="delete_siswa.php?id=<?php echo $data['id']; ?>">Hapus</a>            </td>
        </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table> 
              <p>&nbsp;</p>
              <p><a href="siswa_detail.php">lihat lebih lengkap data &gt;&gt;</a></p>
            </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1">
              <h2>TAMBAH SISWA</h2>
            </div>
            <div class="wrapper">
              <form action="insert_siswaii.php" method="post" enctype="multipart/form-data" name="input_data_siswa">
              <p class="pad_top2"><strong>Data Pribadi </strong>
              <table border="0" cellpadding="5" cellspacing="0">
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
      <td>Nama Siswa</td>
      <td>:</td>
      <td><input id="input1" type="text" name="nama" maxlength="100" required="required" /></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td><label>
        <input name="rdo_jenis_kelamin" type="radio" id="rdo_jenis_kelamin" value="Pria">
      Pria 
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="rdo_jenis_kelamin" type="radio" id="rdo_jenis_kelamin2" value="Wanita">
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
      <td>Goldar</td>
      <td>:</td>
      <td><select name="list_goldar" id="list_goldar">
          <option value="0">Pilih Goldar</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="AB">AB</option>
          <option value="O">O</option>
      </select></td>
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
      <td>Status Anak</td>
      <td>:</td>
      <td><input id="input8" type="text" name="status_anak" required="required" /></td>
    </tr>
    <tr>
      <td>Anak Ke</td>
      <td>:</td>
      <td><input id="input9" type="text" name="anak_ke" required="required" /></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td><input id="input1" type="text" name="alamat" required="required" /></td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td>:</td>
      <td><label>
        <select name="list_kelas" id="list_kelas">
          <option value="0">Pilih Kelas</option>
          <option value="1 TKJ">1 TKJ</option>
          <option value="2 TKJ">2 TKJ</option>
          <option value="3 TKJ">3 TKJ</option>
          <option value="1 TMO">1 TMO</option>
          <option value="2 TMO">2 TMO</option>
          <option value="3 TMO">3 TMO</option>
          <option value="1 TL">1 TL</option>
          <option value="2 TL">2 TL</option>
          <option value="3 TL">3 TL</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Angkatan</td>
      <td>:</td>
      <td><input id="input3" type="text" name="angkatan" required="required" /></td>
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
      <td>Tgl Masuk</td>
      <td>:</td>
      <td><input id="input12" type="text" name="tgl_masuk" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td align="right" colspan="3">&nbsp;</td>
    </tr>
  </tbody>
</table>
              <p><strong>Data Orangtua Siswa</strong></p>
              <table border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td>Nama Ayah</td>
      <td>:</td>
      <td><input id="input1" type="text" name="nama_ayah" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>Nama Ibu</td>
      <td>:</td>
      <td><input id="input1" type="text" name="nama_ibu" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>Pekerjaan Ayah</td>
      <td>:</td>
      <td><input id="input1" type="text" name="pekerjaan_ayah" maxlength="100" required="required" /></td>
    </tr>
    <tr>
      <td>Pekerjaan Ibu</td>
      <td>:</td>
      <td><input id="input5" type="text" name="pekerjaan_ibu" maxlength="100" required="required" /></td>
    </tr>
    <tr>
      <td>No Telp Orangtua</td>
      <td>:</td>
      <td><input id="input1" type="text" name="no_telepon_orang_tua" required="required" /></td>
    </tr>
    <tr>
      <td>Nama Wali</td>
      <td>:</td>
      <td><input id="input1" type="text" name="nama_wali" required="required" /></td>
    </tr>
    <tr>
      <td>Pekerjaan Wali</td>
      <td>:</td>
      <td><input id="input2" type="text" name="pekerjaan_wali" required="required" /></td>
    </tr>
    <tr>
      <td>No. Telp. Wali</td>
      <td>:</td>
      <td><input id="input3" type="text" name="no_telepon_wali" required="required" /></td>
    </tr>
    <tr>
      <td>Alamat OrangTua</td>
      <td>:</td>
      <td><input id="input4" type="text" name="alamat_orang_tua" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td>Alamat Wali</td>
      <td>:</td>
      <td><input id="input6" type="text" name="alamat_wali" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td align="right" colspan="3">&nbsp;</td>
    </tr>
  </tbody>
</table>
              <p><strong>Data Sekolah Asal</strong></p>
              <table border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td> Kelas Asal</td>
      <td>:</td>
      <td><input id="input1" type="text" name="di_kelas" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>Nama Sekolah Asal</td>
      <td>:</td>
      <td><input id="input1" type="text" name="nama_sekolah_asal" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>Alamat Sekolah Asal</td>
      <td>:</td>
      <td><input id="input1" type="text" name="alamat_sekolah_asal" maxlength="100" required="required" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" colspan="3"><p align="left">
        <label>Upload Foto:
        <input type="file" name="foto" id="foto">
        </label>
        </p>
        <p>
          <input type="submit" name="submit1" value="tambah" id="submit1" />
          </p></td>
    </tr>
  </tbody>
</table>
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