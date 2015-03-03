<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Detail Siswa | SMK Prakarya Internasional 52 Bandung</title>
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
              <h2 class="pad_bot1">DATA DETAIL SISWA</h2>
              <p class="pad_bot1 pad_top2"><strong>Data Pribadi Siswa</strong></p>
              <table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
    	  <td width="23">Id</td>
        	<td width="52">No. Induk</td>
        	<td width="33">Nama</td>
        	<td width="40">Gender</td>
        	<td width="39">Agama</td>
        	<td width="23">TTL</td>
        	<td width="23">Goldar</td>
        	<td width="46">Anak Ke</td>
        	<td width="36">Status</td>
        	<td width="49">Tgl Lahir</td>
        	<td width="40">Alamat</td>
        	<td width="32">Kelas</td>
        	<td width="53">Angkatan</td>
        	<td width="36">No Tel</td>
        	<td width="59">Opsi</td>
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
        	<td><?php echo $data['jenis_kelamin']; ?></td>
        	<td><?php echo $data['agama']; ?></td>
        	<td><?php echo $data['lahir']; ?></td>
        	<td><?php echo $data['golongan_darah']; ?></td>
        	<td><?php echo $data['anak_ke']; ?></td>
        	<td><?php echo $data['status_anak']; ?></td>
        	<td><?php echo $data['tgl']; ?></td>
        	<td><?php echo $data['alamat']; ?></td>
        	<td><?php echo $data['kelas']; ?></td>
        	<td><?php echo $data['angkatan']; ?></td>
        	<td><?php echo $data['no_telepon']; ?></td>
            <td>
            	<a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a> || 
                <a href="delete_kelas.php?id=<?php echo $data['id']; ?>">Hapus</a>            </td>
        </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table>
              </p>
              <p><strong>Data Orangtua</strong></p>
              <table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
    	  <td>Nama Anak</td>
        	<td>Nama Ayah</td>
        	<td>Pek. Ayah</td>
        	<td>Nama Ibu</td>
        	<td>Pek. Ibu</td>
        	<td>Nama Wali</td>
        	<td>Pek. Wali</td>
        	<td>No. Telpon Wali</td>
        	<td>Alamat Wali</td>
        	<td>Alamat Orang Tua</td>
        	<td>No Telpon Ortu</td>
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
    	  <td><?php echo $data['nama']; ?></td>
        	<td><?php echo $data['nama_ayah']; ?></td>
        	<td><?php echo $data['pekerjaan_ayah']; ?></td>
        	<td><?php echo $data['nama_ayah']; ?></td>
        	<td><?php echo $data['pekerjaan_ibu']; ?></td>
        	<td><?php echo $data['nama_wali']; ?></td>
        	<td><?php echo $data['pekerjaan_wali']; ?></td>
        	<td><?php echo $data['pekerjaan_wali']; ?></td>
        	<td><?php echo $data['alamat_wali']; ?></td>
        	<td><?php echo $data['alamat_orang_tua']; ?></td>
        	<td><?php echo $data['no_telepon_orang_tua']; ?></td>
            <td>
            	<a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a> || 
                <a href="delete_kelas.php?id=<?php echo $data['id']; ?>">Hapus</a>            </td>
        </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table>
              </p>
              <p><strong>Sekolah Asal</strong></p>
              <p><table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
    	  <td>Nama Anak</td>
        	<td>Di Kelas</td>
        	<td>Nama Sekolah Asal</td>
        	<td>Alamat Sekolah Asal</td>
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
    	  <td><?php echo $data['nama']; ?></td>
        	<td><?php echo $data['di_kelas']; ?></td>
        	<td><?php echo $data['nama_sekolah_asal']; ?></td>
        	<td><?php echo $data['alamat_sekolah_asal']; ?></td>
        	<td>
            	<a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a> || 
                <a href="delete_kelas.php?id=<?php echo $data['id']; ?>">Hapus</a>            </td>
        </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table>
              </p>
              <p><a href="siswa.php">Kembali ke data siswa &gt;&gt;</a></p>
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