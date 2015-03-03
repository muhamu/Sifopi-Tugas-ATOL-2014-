<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Kurikulum | SMK Prakarya Internasional 52 Bandung</title>
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
            <li><a href="nilai_utama.php">NILAI</a></li>
            <li><a href="kelas.php">BELAJAR - MENGAJAR</a></li>
            <li><a href="cari_kenaikan.php">kenaikan</a></li>
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
              <h2 class="pad_bot1">DATA KESEKrETARIATAN</h2>
              <p class="pad_bot1">
              <p class="pad_bot1 pad_top2"><strong>Cari kurikulum:</strong>              </p>
              <form method="post" action="cari_kurikulum.php">
                <input type="text" class="textbox" name="txt_cari">
                <input type="submit" value="cari" class="cari">
              </form></p>
              <p class="pad_bot1 pad_top2"><strong>Menampilkan data kurikulum di SMK Prakarya Internasional 52 Bandung</strong></p>
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
        	<td>Kelas</td>
        	<td>Kurikulum</td>
        	<td>Id Pelajaran</td>
        	<td>Opsi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from kurikulum");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['id']; ?></td>
        	<td><?php echo $data['kelas']; ?></td>
        	<td><?php echo $data['kurikulum']; ?></td>
        	<td><?php echo $data['id_pelajaran']; ?></img></td>
        	<td colspan="2"><a href="edit_kurikulum.php?id=<?php echo $data['id']; ?>">Edit</a> || <a href="delete_kelas.php?id=<?php echo $data['no_induk']; ?>">Hapus</a></td>
            </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table> 
              <p>&nbsp;</p>
              <p class="pad_bot1 pad_top2"><strong>Cari penggunaan ruangan:</strong> </p>
              <form method="post" action="cari_peng_ruangan.php">
                <input type="text" class="textbox" name="txt_cari2">
                <input type="submit" value="cari" class="cari">
              </form>
              </p>
              <p class="pad_bot1 pad_top2"><strong>Menampilkan data penggunaan ruangan di SMK Prakarya Internasional 52 Bandung</strong></p>
              <table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
        	<td>Id</td>
        	<td>Id Pel. Kelas</td>
        	<td>Id Kelas</td>
        	<td>Nama Guru</td>
        	<td>Id Pelajaran</td>
        	<td>Opsi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from pelajaran_kelas");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['id']; ?></td>
        	<td><?php echo $data['id_pljrn_kelas']; ?></td>
        	<td><?php echo $data['id_kelas']; ?></td>
        	<td><?php echo $data['nama_guru']; ?></td>
        	<td><?php echo $data['id_pelajaran']; ?></img></td>
        	<td colspan="2"><a href="edit_pengru.php?id=<?php echo $data['id']; ?>">Edit</a> || <a href="delete_kelas.php?id=<?php echo $data['no_induk']; ?>">Hapus</a></td>
            </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table></p>
              <p><strong>Cari jadwal pelajaran:</strong> </strong></p>
              <form method="post" action="cari_jadwal.php">
                <input type="text" class="textbox" name="txt_cari4">
                <input type="submit" value="cari" class="cari">
              </form>
              </p>
              <p class="pad_bot1 pad_top2"><strong>Menampilkan data jadwal pelajaran di SMK Prakarya Internasional 52 Bandung</strong></p>
              <table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
        	<td>Id Jadwal</td>
        	<td>Id Pel. Kelas</td>
        	<td>Hari</td>
        	<td>Jam</td>
        	<td>Opsi</td>
        	</tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from jadwal");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['id_jadwal']; ?></td>
        	<td><?php echo $data['id_pljrn_kelas']; ?></td>
        	<td><?php echo $data['hari']; ?></td>
        	<td><?php echo $data['jam']; ?></td>
        	<td><a href="edit_jadwal.php?id=<?php echo $data['id_jadwal']; ?>">Edit</a> || <a href="delete_kelas.php?id=<?php echo $data['id_jadwal']; ?>">Hapus</a></td>
            </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table>
              </p>
              <p><strong>Cari Absen:</strong> </strong></strong></p>
              <form method="post" action="cari_absen.php">
                <input type="text" class="textbox" name="txt_cari3">
                <input type="submit" value="cari" class="cari">
              </form>
              </p>
              <p class="pad_bot1 pad_top2"><strong>Menampilkan data absen pelajaran di SMK Prakarya Internasional 52 Bandung</strong></p>
              <table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
        	<td>NIS</td>
        	<td>Id</td>
        	<td>Sakit</td>
        	<td>Izin</td>
        	<td>Alpa</td>
        	<td>Keterangan</td>
        	<td>Opsi</td>
        	</tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from absen");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['nis']; ?></td>
        	<td><?php echo $data['id']; ?></td>
        	<td><?php echo $data['sakit']; ?></td>
        	<td><?php echo $data['izin']; ?></td>
        	<td><?php echo $data['alpha']; ?></img></td>
        	<td><?php echo $data['keterangan']; ?></td>
        	<td><a href="edit_absen.php?id=<?php echo $data['id']; ?>">Edit</a> || <a href="delete_kelas.php?id=<?php echo $data['no_induk']; ?>">Hapus</a></td>
            </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table>
              </p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
            </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1">
              <h2>TAMBAH DATA</h2>
              <p>Tambah data kurikulum</p>
            </div>
            <div class="wrapper">
              </p><form name="input_data_kelas" action="insert_kurikulum.php" method="post">
<table border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td>Id</td>
      <td>:</td>
      <td><input id="input1" type="text" name="id" maxlength="20" required="required" /></td>
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
      <td>Kurikulum</td>
      <td>:</td>
      <td><select name="kurikulum" id="kurikulum">
        <option value="0">Pilih Kurikulum</option>
        <option value="KTSP">KTSP</option>
        <option value="2010">2010</option>
        <option value="2009">2009</option>
            </select></td>
    </tr>
    <tr>
      <td>Id Pelajaran</td>
      <td>:</td>
      <td><select name="id_pelajaran" id="id_pelajaran">
        <?php 
	$query = mysql_query("select * from mapel");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['id_pelajaran'].">".$data['id_pelajaran']."<br>";
	}
	?>
                </select></td>
    </tr>
    <tr>
      <td align="right" colspan="3"><input type="submit" name="submit1" value="tambah" id="submit1" /></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
</form>
            </div>
            
            <div class="wrapper pad_bot2"></div>
          Tambah
          data penggunaan ruangan
          <div class="wrapper">
            </p>
            <form name="input_data_kelas" action="insert_pel_kelas.php" method="post">
              <table border="0" cellpadding="5" cellspacing="0">
                <tbody>
                  <tr>
                    <td>Id</td>
                    <td>:</td>
                    <td><input id="input2" type="text" name="id" maxlength="20" required="required" /></td>
                  </tr>
                  <tr>
                    <td>Id Pel. Kelas</td>
                    <td>:</td>
                    <td><label>
                    <input id="input3" type="text" name="id_pljrn_kelas" maxlength="20" required="required" />
                    </label></td>
                  </tr>
                  <tr>
                    <td>Id Kelas</td>
                    <td>:</td>
                    <td><select name="id_kelas" id="id_kelas">
                      <?php 
	$query = mysql_query("select * from kelas");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['id_kelas'].">".$data['id_kelas']."<br>";
	}
	?>
                                        </select></td>
                  </tr>
                  <tr>
                    <td>Nama Guru</td>
                    <td>:</td>
                    <td><select name="nama_guru" id="nama_guru">
                        <?php 
	$query = mysql_query("select * from guru");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['nama'].">".$data['nama']."<br>";
	}
	?>
                                        </select></td>
                  </tr>
                  <tr>
                    <td>Id Pelajaran</td>
                    <td>:</td>
                    <td><select name="id_pelajaran" id="id_pelajaran">
                      <?php 
	$query = mysql_query("select * from mapel");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['id_pelajaran'].">".$data['id_pelajaran']."<br>";
	}
	?>
                                        </select></td>
                  </tr>
                  <tr>
                    <td align="right" colspan="3"><input type="submit" name="submit2" value="tambah" id="submit2" /></td>
                  </tr>
                </tbody>
              </table>
              <p>&nbsp;</p>
            </form>
            <div class="wrapper">
              </p>
              Tambah
              data jadwal
              <form name="input_data_kelas" action="insert_jadwal.php" method="post">
                <table border="0" cellpadding="5" cellspacing="0">
                  <tbody>
                    <tr>
                      <td>Id jadwal</td>
                      <td>:</td>
                      <td><input id="input4" type="text" name="id_jadwal" maxlength="20" required="required" /></td>
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
                      <td>Hari</td>
                      <td>:</td>
                      <td><select name="hari" id="hari">
                        <option value="0">Pilih Hari</option>
                        <option value="Minggu">Minggu</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                                            </select></td>
                    </tr>
                    <tr>
                      <td>Jam</td>
                      <td>:</td>
                      <td><input id="input5" type="text" name="jam" maxlength="20" required="required" /></td>
                    </tr>
                    
                    <tr>
                      <td align="right" colspan="3"><input type="submit" name="submit3" value="tambah" id="submit3" /></td>
                    </tr>
                  </tbody>
                </table>
                <p>&nbsp;</p>
              </form>
            </div>
            <p>Tambah
              data absen</p>
            <form name="input_data_kelas" action="insert_absen.php" method="post">
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
                    <td>Sakit</td>
                    <td>:</td>
                    <td><input id="input6" type="text" name="sakit" maxlength="20" required="required" /></td>
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
              </table>
              <p>&nbsp;</p>
            </form>
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