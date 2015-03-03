<!DOCTYPE html>
<?php 
include('cek-login.php');
include('config.php');
?>
<html lang="en">
<head>
<title>Perpustakaan | SMK Prakarya Internasional 52 Bandung</title>
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
            <li><a href="perpustakaan.php">PERPUSTAKAAN</a></li>
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
              <h2 class="pad_bot1">DATA PERPUSTAKAAN</h2>
              <p class="pad_bot1 pad_top2"><strong>Cari data Perpustakaan:</strong>              </p>
              <form method="post" action="cari_kelas.php">
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
        	<td>Id Buku</td>
        	<td>Judul Buku</td>
        	<td>Kode Buku</td>
        	<td>Author</td>
        	<td>Isbn</td>
        	<td>Tgl Masuk Buku</td>
        	<td>Opsi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
	$query = mysql_query("select * from buku_perpustakaan");
	
	$no = 1;
	while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['id_buku']; ?></td>
        	<td><?php echo $data['jdl_buku']; ?></td>
        	<td><?php echo $data['kode_buku']; ?></td>
        	<td><?php echo $data['author']; ?></td>
        	<td><?php echo $data['isbn']; ?></td>
        	<td><?php echo $data['tgl_buku']; ?></td>
            <td>
            	<a href="edit_perpus.php?id=<?php echo $data['id_buku']; ?>">Edit</a> || 
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
              <p class="pad_top2"><form name="input_data_kelas" action="insert_perpus.php" method="post">
                <p>&nbsp;</p>
                <table border="0" cellpadding="5" cellspacing="0">
                  <tbody>
                    <tr>
                      <td>Id Buku</td>
                      <td>:</td>
                      <td><input id="input1" type="text" name="id_buku" maxlength="20" required="required" /></td>
                    </tr>
                    <tr>
                      <td>Judul Buku</td>
                      <td>:</td>
                      <td><label>
                        <input id="input2" type="text" name="jdl_buku" maxlength="20" required="required" />
                      </label></td>
                    </tr>
                    <tr>
                      <td>Kode Buku</td>
                      <td>:</td>
                      <td><input id="input3" type="text" name="kode_buku" maxlength="20" required="required" /></td>
                    </tr>
                    <tr>
                      <td>Author</td>
                      <td>:</td>
                      <td><input id="input4" type="text" name="author" maxlength="20" required="required" /></td>
                    </tr>
                    <tr>
                      <td>Isbn</td>
                      <td>:</td>
                      <td><input id="input5" type="text" name="isbn" maxlength="20" required="required" /></td>
                    </tr>
                    <tr>
                      <td>Tgl Masuk Buku</td>
                      <td>:</td>
                      <td><input id="input1" type="text" name="tgl_masuk" required="required" /></td>
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