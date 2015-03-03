<style>

#body{

    background-image:url(images/backback.jpg);   

}

#main {
	width: 700px;
	height: 700px;
	background:white;
	text-align: center;
	margin-top: 40px;
	border-radius: 30px;
	;
	margin-right: auto;
	margin-bottom: auto;
	margin-left: auto;
}

#head {
	width: 700px;
	height: 100px;
	background:#003399;
	margin-bottom: 30px;
	text-align: center;
	padding-top: 10px;
	border-top-left-radius: 30px;
	border-top-right-radius: 30px;
	font-family:Helvetica;
}

#isi {

    width: 700px;

    height: 600px;

    padding-left: 150px;  

    font-family:arial; 

    text-align: left;

    font-weight:bold;

    font-family:Helvetica;

}

#input1 {   

        padding: 6px;  

        border: solid 1px #E5E5E5;  

        outline: 0;  

        font: normal 13px/100% Verdana, Tahoma, sans-serif;  

        width: 300px;

        height: 40px;  

        background: #FFFFFF url('bg_form.png') left top repeat-x;  

        background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #EEEEEE), to(#FFFFFF));  

        background: -moz-linear-gradient(top, #FFFFFF, #EEEEEE 1px, #FFFFFF 25px);  

        box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;  

        -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;  

        -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;

        margin: 3px;  

        }  


#textarea {   

        width: 400px;  

        max-width: 400px;  

        height: 150px;  

        line-height: 150%;  

        }  

    input:hover, textarea:hover,  

    input:focus, textarea:focus {   

        border-color: #C9C9C9;   

        -webkit-box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 8px;  

        }  

#label {   

        color:#FF8040;

        margin-bottom: 10px;   

        }  

#submit1 {  

        width: 250px;  

        padding: 15px;  

        background: #617798;  

        border: 0;  

        font-size: 14px;  

        color: #FFFFFF;  

        -moz-border-radius: 5px;  

        -webkit-border-radius: 5px;

        margin-left: 80px;

        margin-top: 10px;

        border-radius: 10px;

        }  

.style1 {color: #FFFFFF}
</style>

<?php

session_start();

if (!empty($_SESSION['username'])) {

header('location:index.php');

}

?>

<html>

<title>Buat Akun | Sistem Akademik SMK PI 52 Bandung</title><head>

</head>

<body id="body">

<div id="main">

<div id="head">
  <h1 class="style1"><img src="images/headerlog.png" width="272" height="84"></h1>
</div>

<div id="isi">

<div align="left">
  <p>Daftar ke Sistem Informasi SMK PI 52 Bandung</p>
  <p><br>
  </p>
</div>
<form name="input_data" action="insert.php" method="post">
<table border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td>Username</td>
      <td>:</td>
      <td><input id="input1" type="text" name="username" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td>:</td>
      <td><input id="input1" type="password" name="password" maxlength="20" required="required" /></td>
    </tr>
    <tr>
      <td>Fullname</td>
      <td>:</td>
      <td><input id="input1" type="text" name="fullname" maxlength="100" required="required" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td>:</td>
      <td><input id="input1" type="email" name="email" required="required" /></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td>:</td>
      <td><input id="input1" type="text" name="agama" required="required" /></td>
    </tr>
    <tr>
      <td>Nomor HP</td>
      <td>:</td>
      <td><input id="input1" type="text" name="no_hp" maxlength="14" required="required" /></td>
    </tr>
    <tr>
      <td align="right" colspan="3"><input type="submit" name="submit1" value="Daftar" id="submit1" /></td>
    </tr>
  </tbody>
</table>
<p>Kembali ke halaman login <a href="index.php">di sini</a></p>
</form>
</div>
</div>
</body>
</html>