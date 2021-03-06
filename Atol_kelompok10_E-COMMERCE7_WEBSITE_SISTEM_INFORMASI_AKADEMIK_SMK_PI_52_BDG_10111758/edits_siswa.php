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
              <h2 class="pad_bot1">EDIT SISWA</h2>
              <p class="pad_bot1 pad_top2">&nbsp;</p>
              <div align="justify">
                <p><strong> <img src="images/logo.png" width="272" height="84"></strong></p>
                <p>&nbsp;</p>
              </div>
              <div align="justify"><?php 
$id = $_GET['id'];

$query = mysql_query("select * from murid where id='$id'") or die(mysql_error());

$data = mysql_fetch_array($query);
?>

<form name="update_data" action="proses_edit_siswa.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<table border="0" cellpadding="5" cellspacing="0">
    <tbody>
    	<tr>
        	<td>ID</td>
        	<td>:</td>
        	<td><input type="text" name="user" maxlength="20" required="required" value="<?php echo $data['id']; ?>" /></td>
        </tr>
    	
		<tr>
        	<td>no_induk</td>
        	<td>:</td>
        	<td><input type="text" name="no_induk" maxlength="20" required="required" value="<?php echo $data['no_induk']; ?>" /></td>
        </tr>
    	
		<tr>
        	<td>Nama Siswa</td>
        	<td>:</td>
        	<td><input type="text" name="nama" maxlength="100" required="required" value="<?php echo $data['nama']; ?>" /></td>
        </tr>
		
		<tr>
    		<td>Jenis Kelamin</td>
      		<td>:</td>
      		<td><label>
        		<input name="rdo_jenis_kelamin" type="radio" id="rdo_jenis_kelamin" value="Pria">Pria</label>
			</td>
    	</tr>
    	<tr>
      		<td>&nbsp;</td>
      		<td>&nbsp;</td>
      		<td><input name="rdo_jenis_kelamin" type="radio" id="rdo_jenis_kelamin2" value="Wanita">Wanita</td>
		</tr>
    	
		<tr>
        	<td>Tgl Lahir</td>
        	<td>:</td>
        	<td><input type="text" name="tgl_lahir" required="required" value="<?php echo $data['tgl']; ?>" /></td>
        </tr>
    	<tr>
        	<td>Tempat Lahir</td>
        	<td>:</td>
        	<td><input type="text" name="lahir" maxlength="14" required="required" value="<?php echo $data['lahir']; ?>" /></td>
        </tr>
        <tr>
		<tr>
      		<td>Goldar</td>
      		<td>:</td>
      		<td><select name="list_goldar" id="list_goldar">
				<option value="<?php echo $data['jenis_kelamin']; ?>"><?php echo $data['jenis_kelamin']; ?></option>
			  	<option value="0">Pilih Goldar</option>
			  	<option value="A">A</option>
          		<option value="B">B</option>
			  	<option value="AB">AB</option>
          		<option value="O">O</option>
      	  		</select>
	  		</td>
    	</tr>
	
	 	<tr>
      		<td>Agama</td>
      		<td>:</td>
      		<td><select name="list_agama" id="list_agama">
				<option value="<?php echo $data['agama']; ?>"><?php echo $data['agama']; ?></option>
        		<option value="0">Pilih Agama</option>
        		<option value="Islam">Islam</option>
        		<option value="Kristen (Katolik)">Kristen</option>
        		<option value="Hindu">Hindu</option>
        		<option value="Buddha">Buddha</option>
        		<option value="Konghucu">Konghucu</option>
        		</select>
			</td>
    	</tr>
		
		<tr>
        	<td>Status Anak</td>
        	<td>:</td>
        	<td><input type="text" name="status" maxlength="14" required="required" value="<?php echo $data['status_anak']; ?>" /></td>
        </tr>
		
		<tr>
        	<td>Anak Ke</td>
        	<td>:</td>
        	<td><input type="text" name="anak_ke" maxlength="14" required="required" value="<?php echo $data['anak_ke']; ?>" /></td>
        </tr>
		
		<tr>
        	<td>Alamat</td>
        	<td>:</td>
        	<td><input type="text" name="alamat" maxlength="14" required="required" value="<?php echo $data['alamat']; ?>" /></td>
        </tr>
		
		<tr>
      		<td>Kelas</td>
      		<td>:</td>
      		<td><label>
        		<select name="list_kelas" id="list_kelas">
				<option value="<?php echo $data['kelas']; ?>"><?php echo $data['kelas']; ?></option>
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
      			</label>
			</td>
   		</tr>
    	
		<tr>
        	<td>Angkatan</td>
        	<td>:</td>
        	<td><input type="text" name="angkatan" maxlength="14" required="required" value="<?php echo $data['angkatan']; ?>" /></td>
        </tr>
		
		<tr>
        	<td>No. Telepon</td>
        	<td>:</td>
        	<td><input type="text" name="no_telp" maxlength="14" required="required" value="<?php echo $data['no_telepon']; ?>" /></td>
        </tr>
		
		<tr>
        	<td>Tanggal Masuk</td>
        	<td>:</td>
        	<td><input type="text" name="tgl_masuk" maxlength="14" required="required" value="<?php echo $data['tgl_masuk']; ?>" /></td>
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
      <td><input type="text" name="nama_ayah" maxlength="20" required="required" value="<?php echo $data['nama_ayah']; ?>" /></td>
    </tr>
    <tr>
      <td>Nama Ibu</td>
      <td>:</td>
      <td><input type="text" name="nama_ibu" maxlength="20" required="required" value="<?php echo $data['nama_ibu']; ?>" /></td>
    </tr>
    <tr>
      <td>Pekerjaan Ayah</td>
      <td>:</td>
      <td><input type="text" name="pekerjaan_ayah" maxlength="100" required="required" value="<?php echo $data['pekerjaan_ayah']; ?>" /></td>
    </tr>
    <tr>
      <td>Pekerjaan Ibu</td>
      <td>:</td>
      <td><input id="input5" type="text" name="pekerjaan_ibu" maxlength="100" required="required" value="<?php echo $data['pekerjaan_ibu']; ?>" /></td>
    </tr>
    <tr>
      <td>No Telp Orangtua</td>
      <td>:</td>
      <td><input id="input1" type="text" name="no_telepon_orang_tua" required="required" value="<?php echo $data['no_telepon_orang_tua']; ?>" /></td>
    </tr>
    <tr>
      <td>Nama Wali</td>
      <td>:</td>
      <td><input id="input1" type="text" name="nama_wali" required="required" value="<?php echo $data['nama_wali']; ?>" /></td>
    </tr>
    <tr>
      <td>Pekerjaan Wali</td>
      <td>:</td>
      <td><input id="input2" type="text" name="pekerjaan_wali" required="required" value="<?php echo $data['pekerjaan_wali']; ?>" /></td>
    </tr>
    <tr>
      <td>No. Telp. Wali</td>
      <td>:</td>
      <td><input id="input3" type="text" name="no_telepon_wali" required="required" value="<?php echo $data['no_telepon_wali']; ?>" /></td>
    </tr>
    <tr>
      <td>Alamat OrangTua</td>
      <td>:</td>
      <td><input id="input4" type="text" name="alamat_orang_tua" maxlength="14" required="required" value="<?php echo $data['alamat_orang_tua']; ?>" /></td>
    </tr>
    <tr>
      <td>Alamat Wali</td>
      <td>:</td>
      <td><input id="input6" type="text" name="alamat_wali" maxlength="14" required="required" value="<?php echo $data['alamat_wali']; ?>" /></td>
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
      <td><input id="input1" type="text" name="di_kelas" maxlength="20" required="required" value="<?php echo $data['di_kelas']; ?>" /></td>
    </tr>
    <tr>
      <td>Nama Sekolah Asal</td>
      <td>:</td>
      <td><input id="input1" type="text" name="nama_sekolah_asal" maxlength="20" required="required" value="<?php echo $data['nama_sekolah_asal']; ?>" /></td>
    </tr>
    <tr>
      <td>Alamat Sekolah Asal</td>
      <td>:</td>
      <td><input id="input1" type="text" name="alamat_sekolah_asal" maxlength="100" required="required" value="<?php echo $data['alamat_sekolah_asal']; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" colspan="3"><p align="left">
        <label>Upload Foto:
		<input type="hidden" name="nama_foto_lama" value="<?php echo $data['foto']; ?>" />
        <input type="file" name="foto" id="foto">
        </label>
       </td>
    </tr>
  </tbody>
</table>
		<tr>
	 	  	<td align="right" colspan="3"><input type="submit" name="submit" value="Simpan" /></td>
        </tr>
		
		<br>
		<br>
		<br>

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