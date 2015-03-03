<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Pembayaran Iuran | SMK Prakarya Internasional 52 Bandung</title>
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
.style1 {font-size: 12px}
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
            <li><a href="iuran.php">IURAN </a></li>
            <li><a href="pembayaran_lain.php">PEMBAYARAN LAIN</a></li>
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
              <h2 class="pad_bot1">DATA IURAN</h2>
              <p class="pad_bot1 pad_top2"><strong>Cari data Iuran:</strong>              </p>
              <form method="post" action="cari_iuran.php">
                <input type="text" class="textbox" name="txt_cari">
                <input type="submit" value="cari" class="cari">
              </form>
              </p>
              <p class="pad_bot1 pad_top2">
                <?php 
if (!empty($_GET['message']) && $_GET['message'] == 'success') {
	echo '<h3>Berhasil meng-update data!</h3>';
} else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
	echo '<h3>Berhasil menghapus data!</h3>';
}
?>
              </p>
              <table id="table-tampil" border="1" cellpadding="5" cellspacing="0">
	<thead>
    	<tr>
        	<td>Id.</td>
        	<td>Nama</td>
        	<td>No. Induk</td>
        	<td>Kelas</td>
        	<td>Bulan</td>
        	<td>Tgl Bayar</td>
        	<td>Opsi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from spp");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['id']; ?></td>
        	<td><?php echo $data['nama']; ?></td>
        	<td><?php echo $data['no_induk']; ?></td>
        	<td><?php echo $data['kelas']; ?></td>
        	<td><?php echo $data['bulan']; ?></td>
        	<td><?php echo $data['tgl']; ?></td>
            <td>
            	<a href="edit_iuran.php?id=<?php echo $data['id']; ?>">Edit</a> || 
                <a href="delete_kelas.php?id=<?php echo $data['id']; ?>">Hapus</a>            </td>
        </tr>
    <?php 
		$no++;
	} 
	?>
    </tbody>
</table> </div>
            <div class="pad_left1">
              <h2 class="pad_bot1">&nbsp;</h2>
            </div>
          </article>
          <article class="col2 pad_left2">
            <div class="pad_left1">
              <h2>TAMBAH IURAN</h2>
            </div>
            <div class="wrapper">
              <p class="pad_top2"><form name="input_data_kelas" action="insert_iuran.php" method="post">
                <p>&nbsp;</p>
                <table border="0" cellpadding="5" cellspacing="0">
                  <tbody>
                    <tr>
                      <td>Id</td>
                      <td>:</td>
                      <td><input id="input1" type="text" name="id" maxlength="20" required="required" /></td>
                    </tr>
                    <tr>
                      <td>No Induk</td>
                      <td>:</td>
                      <td><label>
                        <select name="no_induk" id="no_induk">
                          <?php 
	$query = mysql_query("select * from murid");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['no_induk'].">".$data['no_induk']."<br>";
	}
	?>
                        </select>
                      </label></td>
                    </tr>
                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td><select name="nama" id="nama">
                          <?php 
	$query = mysql_query("select * from murid");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) 
	{
	echo "<option value=".$data['nama'].">".$data['nama']."<br>";
	}
	?>
                                            </select></td>
                    </tr>
                    <tr>
                      <td>Bulan</td>
                      <td>:</td>
                      <td><select name="bulan" id="bulan">
                          <option value="0">Pilih Bulan</option>
                          <option value="Januari">Januari</option>
                          <option value="Februari">Februari</option>
                          <option value="Maret">Maret</option>
                          <option value="April">April</option>
                          <option value="Mei">Mei</option>
                          <option value="Juni">Juni</option>
                          <option value="Juli">Juli</option>
                          <option value="Agustus">Agustus</option>
                          <option value="September">September</option>
                          <option value="Oktober">Oktober</option>
                          <option value="November">November</option>
                          <option value="Desember">Desember</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td>Kelas</td>
                      <td>:</td>
                      <td><select name="list_kelas" id="list_kelas">
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
                      </select></td>
                    </tr>
                    <tr>
                      <td>Bayar</td>
                      <td>:</td>
                      <td><input id="input1" type="text" name="bayar" required="required" /></td>
                    </tr>
                    <tr>
                      <td>Tgl Bayar</td>
                      <td>:</td>
                      <td><input id="input1" type="text" name="tgl" maxlength="14" required="required" /></td>
                    </tr>
                    <tr>
                      <td align="right" colspan="3"><input type="submit" name="submit1" value="tambah" id="submit1" /></td>
                    </tr>
                  </tbody>
                </table>
                <p>Tambah data anda</p>
              </form></p>
              <p class="pad_top2">&nbsp;</p>
              <p class="pad_top2">&nbsp;</p>
              <p class="pad_top2">&nbsp;</p>
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